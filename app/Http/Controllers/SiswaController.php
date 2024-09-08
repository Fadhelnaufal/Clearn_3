<?php

namespace App\Http\Controllers;

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
        $kelas = Auth::user()->kelas;
        $user = Auth::user();
        $userType = $user->user_type_id ? UserType::find($user->user_type_id) : null;

        // Determine whether the user has a user_type_id
        $hasUserType = !is_null($user->user_type_id);

        // Pass the necessary variables to the view
        return view('siswa.dashboard', compact('questions', 'kelas', 'hasUserType'));
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
        $user->user_type = $userType['name']; // Assuming user_type is a string
        $user->user_type_image = $userType['image']; // Assuming user_type_image is a string
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

        $userType = [
            'name' => 'Nonachiever',
            'image' => 'default_image.png', // Default image if no match
        ];

        // Determine user type
        if (
            $scores['mastery_approach'] > $scores['mastery_avoidance'] &&
            $scores['performance_approach'] > $scores['performance_avoidance']
        ) {
            $userType = UserType::where('name', 'Overachiever')->first(['name', 'image'])->toArray();
        } elseif (
            $scores['mastery_approach'] > $scores['mastery_avoidance'] &&
            $scores['performance_approach'] <= $scores['performance_avoidance']
        ) {
            $userType = UserType::where('name', 'Mastery Expert')->first(['name', 'image'])->toArray();
        } elseif (
            $scores['mastery_avoidance'] > $scores['mastery_approach'] &&
            $scores['performance_approach'] > $scores['performance_avoidance']
        ) {
            $userType = UserType::where('name', 'Best Performance')->first(['name', 'image'])->toArray();
        } else {
            $userType = UserType::where('name', 'Nonachiever')->first(['name', 'image'])->toArray();
        }

        return $userType;
    }

    public function getUserTypeResult()
    {
        $userType = $this->calculateUserType(); // Calculate user type
        if (!$userType) {
            return response()->json(['error' => 'User type not found'], 404);
        }

        $imageUrl = asset('storage/images/' . $userType['image']);

        return response()->json([
            'name' => $userType['name'],
            'image' => $imageUrl
        ]);
    }

    public function saveUserType(Request $request)
    {
        try {
            $user = Auth::user(); // Mendapatkan instansi pengguna yang sedang login
            $userTypeId = $request->input('user_type_id');

            // Get the user type from the database
            $userType = UserType::find($userTypeId);

            if ($userType) {
                $user->user_type = $userType->name;
                $user->user_type_image = $userType->image;
                $user->save(); // Menggunakan save() untuk menyimpan perubahan
            } else {
                throw new \Exception('User type not found.');
            }

            return response()->json(['success' => true, 'message' => 'User type saved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
