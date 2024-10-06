<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserType;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:siswa']); // Ensure only users with the 'siswa' role can access this controller
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $questions = Question::all();
    $user = Auth::user()->load('user_tasks');
    $userType = $user->user_type_id ? UserType::find($user->user_type_id) : null;
    $totalPoints = $user->user_tasks->sum('points');
    $kelasCollection = $user->kelas; // Get the collection of classes for the authenticated user

    // Gather all materi from all classes
    $materis = $kelasCollection->flatMap(function ($kelas) use ($user) {
        return $kelas->materi()->with(['subMateris' => function($query) use ($user) {
            $query->where('user_type_id', $user->user_type_id); // Filter for siswa
        }])->get(); // Get materi for each class
    });

    // Initialize total subMateris and completed tasks counters
    $totalSubMateris = 0;
    $completedSubMateris = 0;

    // Prepare completion status for all subMateris and count them
    foreach ($materis as $materi) {
        $subMateris = $materi->subMateris;

        // Count the total subMateris
        $totalSubMateris += $subMateris->count();

        // Check completion status for each subMateri
        foreach ($subMateris as $subMateri) {
            // Check if the task type for the subMateri is completed
            $subMateri->is_completed = $user->user_tasks()->where('task_type', 'sub_materi')->where('task_id', $subMateri->id)->exists();
            if ($subMateri->is_completed) {
                $completedSubMateris++;
            }
        }
    }

    // Retrieve case studies and soal tests related to all classes
    $caseStudies = $kelasCollection->flatMap(function ($kelas) {
        return $kelas->case_studies; // Collect all case studies from each class
    });

    $soalTests = $kelasCollection->flatMap(function ($kelas) {
        return $kelas->materi()->with('soal')->get(); // Collect all soal tests from each class
    });

    // Calculate total challenges (subMateris, case studies, soal tests)
    $totalCaseStudies = $caseStudies->count();
    $totalSoalTests = $soalTests->pluck('soal')->flatten()->count();
    $totalChallenges = $totalSubMateris + $totalCaseStudies + $totalSoalTests;

    // Count completed tasks for case studies and soal tests based on task_type
    $completedCaseStudies = $user->user_tasks()
        ->where('task_type', 'case_study')
        ->where('is_completed', true)
        ->count();

    $completedSoalTests = $user->user_tasks()
        ->where('task_type', 'soal')
        ->where('is_completed', true)
        ->count();

    // Sum up completed challenges
    $completedChallenges = $completedSubMateris + $completedCaseStudies + $completedSoalTests;

    // Determine whether the user has a user_type_id
    $hasUserType = !is_null($user->user_type_id);

    // Pass the necessary variables to the view
    return view('siswa.dashboard', compact(
        'user', 'materis', 'questions', 'kelasCollection', 'hasUserType',
        'userType', 'totalPoints', 'totalChallenges', 'completedChallenges'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeAnswers(Request $request)
    {
        $data = $request->validate([
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer_value' => 'required|integer',
        ]);

        // Store answers
        foreach ($data['answers'] as $answer) {
            UserAnswer::updateOrCreate(
                ['user_id' => auth()->id(), 'question_id' => $answer['question_id']],
                ['answer_value' => $answer['answer_value']]
            );
        }

        // Calculate user type
        $userType = $this->calculateUserType();
        $user = auth()->user();
        $user->user_type_id = $userType['id']; // Assuming user_type_image is a string
        $user->save();

        return redirect()->back()->with('success', 'Jawaban Anda telah disimpan dan tipe pengguna Anda telah diperbarui.');
    }

    private function calculateUserType()
    {
        $userAnswers = UserAnswer::where('user_id', auth()->id())->with('question')->get();

        $scores = [
            'mastery_approach' => 0,
            'mastery_avoidance' => 0,
            'performance_approach' => 0,
            'performance_avoidance' => 0,
        ];

        foreach ($userAnswers as $answer) {
            $question = $answer->question;
            switch ($question->category_id) {
                case 1:
                    $scores['mastery_approach'] += $answer->answer_value;
                    break;
                case 2:
                    $scores['mastery_avoidance'] += $answer->answer_value;
                    break;
                case 3:
                    $scores['performance_approach'] += $answer->answer_value;
                    break;
                case 4:
                    $scores['performance_avoidance'] += $answer->answer_value;
                    break;
            }
        }

        $userType = UserType::where('name', 'Nonachiever')->first(['id', 'name', 'image']);

        // Determine user type
        if (
            $scores['mastery_approach'] > $scores['mastery_avoidance'] &&
            $scores['performance_approach'] > $scores['performance_avoidance']
        ) {
            $userType = UserType::where('name', 'Overachiever')->first(['id', 'name', 'image']);
        } elseif (
            $scores['mastery_approach'] > $scores['mastery_avoidance'] &&
            $scores['performance_approach'] <= $scores['performance_avoidance']
        ) {
            $userType = UserType::where('name', 'Mastery Expert')->first(['id', 'name', 'image']);
        } elseif (
            $scores['mastery_avoidance'] > $scores['mastery_approach'] &&
            $scores['performance_approach'] > $scores['performance_avoidance']
        ) {
            $userType = UserType::where('name', 'Best Performance')->first(['id', 'name', 'image']);
        } else {
            $userType = UserType::where('name', 'Nonachiever')->first(['id', 'name', 'image']);
        }

        return $userType ? $userType->toArray() : [];
    }

    public function getUserTypeResult()
    {
        // Fetch the user
        $user = auth()->user();

        // Ensure the user has a user_type_id
        if (!$user->user_type_id) {
            return response()->json(['error' => 'User type not found'], 404);
        }

        // Get the UserType using user_type_id
        $userType = UserType::find($user->user_type_id);

        if (!$userType) {
            return response()->json(['error' => 'User type not found'], 404);
        }

        // Construct the image URL
        $imageUrl = $userType ? asset('assets/images/userType/' . $userType->image) : '';

        return response()->json([
            'id' => $userType ? $userType->id : null,
            'name' => $userType ? $userType->name : null,
            'image' => $imageUrl
        ]);
    }


    public function saveUserType(Request $request)
    {
        $user = Auth::user();
        $userTypeId = $request->input('user_type_id');

        // Validate the input
        $validated = $request->validate([
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        try {
            // Get the user type from the database
            $userType = UserType::find($userTypeId);

            if ($userType) {
                $user->user_type_id = $userType->id; // Set user_type_id
                $user->save();

                return response()->json(['success' => true, 'message' => 'User type saved successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'User type not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function compiler(){
        return view('compiler.compiler');
    }
    public function quiz(){
        return view('siswa.quiz');
    }
    public function join_quiz(){
        return view('siswa.join-quiz');
    }
    public function study_quiz(){
        return view('siswa.study-quiz');
    }
    public function preview_quiz(){
        return view('siswa.preview-quiz');
    }
    public function leaderboard_quiz(){
        return view('siswa.leaderboard-quiz');
    }

}
