<?php

namespace App\Http\Controllers;

use App\Models\ExpPointQuiz;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\QuestionsQuiz;
use App\Models\ResultQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('guru.tambah-quiz', compact('quizzes'));
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('guru.detail-quiz', compact('quiz'));
    }
    // Menampilkan form untuk membuat quiz
    public function create()
    {
        return view('quiz.create');
    }

    // Menyimpan quiz, soal, dan jawaban
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan quiz dan buat token
        $quiz = Quiz::create([
            'nama' => $validated['nama'],
            'access_token' => Str::random(6), // Generate token unik

        ]);
        // dd($quiz);

        return redirect()->route('guru.detail-quiz', ['id' => $quiz->id])
                     ->with('success', 'Quiz berhasil disimpan dengan token: ' . $quiz->access_token);
    }

    public function showByToken($token)
    {
        // Cari quiz berdasarkan token
        $quiz = Quiz::where('access_token', $token)->with('questions.options')->firstOrFail();

        // Tampilkan kuis beserta soalnya
        return view('quiz.show', compact('quiz'));
    }

    public function CreateQuestion(Request $request, $id)
    {
        // dd($request->all(), $id);
        // dd($request);
        // Validasi input
        $this->validate($request,[
            'question_text' => 'required|string|max:255',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jawaban.*.opsi' => 'required', // Validate each answer option
            'jawaban.*.is_correct' => 'nullable', // Validate if correct
        ]);
        // dd($request->all());
        $quiz = Quiz::findOrFail($id);

        $filePath = null; // Initialize the variable for the file path
        // dd($filePath);
        if ($request->hasFile('question_image')) {
            $gambar = $request->file('question_image'); // Get the uploaded file
            // Generate a random file name
            $fileName = str()->random(10) . '.' . $gambar->getClientOriginalExtension();
            // Store the file in the specified path
            $gambar->move(public_path('quiz/assets/images/question'), $fileName);
            $filePath = $fileName;
        }

        // dd($filePath,$request->all());

        $questionQuiz = QuestionsQuiz::create([
            'quiz_id' => $id,
            'question_text' => $request['question_text'],
            'question_image' => $filePath, // Handle image upload
        ]);
        foreach ($request->jawaban as $jawaban) {
            $questionQuiz->options()->create([
                'question_id' => $questionQuiz->id,
                'option_text' => $jawaban['opsi'],
                'is_correct' => isset($jawaban['is_correct']) ? true : false,
            ]);
        }

        return redirect()->route('guru.detail-quiz', ['id' => $quiz->id])
                     ->with('success', 'Soal berhasil ditambahkan');

        // Simpan soal
    }

    public function destroyQuestion($id,$questionId)
    {
        $question = QuestionsQuiz::findOrFail($questionId);
        // dd($question);
        $question->delete();
        return redirect()->route('guru.detail-quiz', ['id' => $id])
                     ->with('success', 'Soal berhasil dihapus');
    }

    public function updateQuestion(Request $request, $id, $questionId)
    {
        // dd($request->all());
        // Validate incoming request data
        $request->validate([
            'question_text' => 'required|string|max:255',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'required|array', // Update to match new naming convention
            'options.*.option_text' => 'required|string|max:255', // Validate each option text
            'options.*.id' => 'nullable|exists:options,id', // Validate option ID if provided
            'options.*.is_correct' => 'nullable|boolean', // Validate if correct
        ]);

        $question = QuestionsQuiz::findOrFail($questionId);
        $filePath = $question->question_image; // Use existing image path
        // dd($filePath, $request->all(), $question);
        // Handle image upload if a new image is provided
        if ($request->hasFile('question_image')) {
            // Delete old image if exists
            if ($filePath && file_exists(public_path('quiz/assets/images/question/' . $filePath))) {
                unlink(public_path('quiz/assets/images/question/' . $filePath));
            }

            // Upload new image
            $gambar = $request->file('question_image');
            $fileName = str()->random(10) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('quiz/assets/images/question'), $fileName);
            $filePath = $fileName; // Update file path
        }

        // Update question text and image
        $question->update([
            'question_text' => $request['question_text'],
            'question_image' => $filePath,
        ]);

        // dd($question);

        // Get existing option IDs
        $existingOptions = $question->options()->get(); // Get existing options
        $existingOptionIds = $existingOptions->pluck('id')->toArray();

        // Prepare the IDs from the request
        $requestOptionIds = array_filter(array_column($request->options, 'id')); // Update to match new naming convention

        // Identify options to delete
        $idsToDelete = array_diff($existingOptionIds, $requestOptionIds);
        if (!empty($idsToDelete)) {
            // Delete options that are not present in the request
            $question->options()->whereIn('id', $idsToDelete)->delete();
        }

        // dd($idsToDelete);

        // Update or create options based on the options array
        // dd($request->options);
        foreach ($request->options as $option) {
            // Check if the option ID exists to determine whether to create or update
            if (isset($option['id'])) {
                // Update existing option
                $existingOption = $existingOptions->firstWhere('id', $option['id']);
                if ($existingOption) {
                    $existingOption->update([
                        'option_text' => $option['option_text'],
                        // Use the value from the request
                        'is_correct' => isset($option['is_correct']) && $option['is_correct'] == '1', // Check if is_correct is '1'
                    ]);
                }
            } else {
                // Create a new option if no ID is provided
                $question->options()->create([
                    'question_id' => $question->id, // Set question_id
                    'option_text' => $option['option_text'],
                    // Ensure it is correctly set
                    'is_correct' => isset($option['is_correct']) && $option['is_correct'] == '1',
                ]);
            }
        }
        Log::info('Request Data', $request->all());
        // dd($question, $question->options);

        return redirect()->route('guru.detail-quiz', ['id' => $id])
            ->with('success', 'Soal berhasil diedit');
    }

    public function joinQuiz(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|exists:quizzes,access_token',
        ]);

        $user = Auth::user();

        $quiz = Quiz::where('access_token', $request->token)->firstOrFail();

        if ($user->quizzes->contains($quiz)) {
            return redirect()->back()->with('error', 'Anda sudah bergabung dengan quiz ini.');
        }

        $user->quizzes()->attach($quiz->id);

        return redirect()->route('siswa.show-quiz')
            ->with('success', 'Berhasil bergabung dengan quiz.');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('guru.tambah-quiz')
            ->with('success', 'Quiz deleted successfully');
    }

    public function showQuiz()
    {
        $user = Auth::user();
        $quiz = $user->quizzes;

        return view('siswa.join-quiz', compact('quiz'));
    }

    public function previewQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $userId = Auth::id(); // Get the authenticated user's ID

        // Check if the user has already taken the quiz
        $hasTakenQuiz = ResultQuiz::where('quiz_id', $quiz->id)->where('user_id', $userId)->exists();
        return view('siswa.preview-quiz', compact('quiz', 'userId', 'hasTakenQuiz'));
    }

    public function takeQuiz($id)
    {
        $user = Auth::user();

        // Fetch quizzes for the authenticated user
        $quizzes = $user->quizzes;

        // Find the specific quiz by its ID
        $quiz = $quizzes->where('id', $id)->first();

        // Check if the quiz exists
        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found.');
        }

        // Pass both quizzes and the specific quiz to the view
        return view('siswa.study-quiz', compact('quizzes', 'quiz'));
    }


    public function submitQuiz(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string', // Assuming your answer values are strings
            'quiz_id' => 'required|exists:quizzes,id', // Validate quiz_id if you have a quizzes table
        ]);

        $answers = $request->input('answers');
        $quizId = $request->input('quiz_id'); // Get the quiz ID

        // Calculate total points
        $totalPoints = $this->calculateTotalPoints($answers);

        // Loop through answers and save them
        foreach ($answers as $questionKey => $answerId) {
            // Extract the question ID from the key
            preg_match('/question_(\d+)/', $questionKey, $matches);
            $questionId = $matches[1] ?? null;

            if ($questionId) {
                // Save the answer result to ResultQuiz
                ResultQuiz::create([
                    'question_id' => $questionId,
                    'option_id' => $answerId, // Assuming answerId corresponds to option_id
                    'user_id' => Auth::id(), // Save the ID of the authenticated user
                    'quiz_id' => $quizId, // Save the quiz ID to associate the answer with the quiz
                    'is_correct' => $this->checkAnswer($questionId, $answerId), // Check if the answer is correct
                ]);
            }
        }

        // Save the total points to the exp_point_quizzes table
        $this->savePointsToQuiz($quizId, $totalPoints);

        // Return a response
        return response()->json(['success' => true, 'message' => 'Quiz submitted successfully!']);
    }

    private function calculateTotalPoints($answers)
    {
        $totalPoints = 0;

        foreach ($answers as $questionKey => $answerId) {
            preg_match('/question_(\d+)/', $questionKey, $matches);
            $questionId = $matches[1] ?? null;

            if ($questionId && $this->checkAnswer($questionId, $answerId)) {
                $totalPoints += 50; // 50 points for each correct answer
            }
        }

        return $totalPoints;
    }

    // Example checkAnswer method
    private function checkAnswer($questionId, $answerId)
    {
        // Fetch the correct answer for the given question
        $correctAnswer = Option::where('question_id', $questionId)->where('is_correct', true)->first();
        
        // Check if the answer is correct
        return $correctAnswer && $correctAnswer->id == $answerId;
    }

    private function savePointsToQuiz($quizId, $points)
    {
        // Ensure quiz ID exists in the quizzes table
        if (!Quiz::find($quizId)) {
            throw new \Exception("Quiz with ID $quizId does not exist.");
        }

        // Get the authenticated user's ID
        $userId = Auth::id(); // Get the authenticated user's ID

        // Save the total points to the exp_point_quizzes table
        ExpPointQuiz::create([
            'quiz_id' => $quizId,
            'user_id' => $userId,
            'exp_point' => $points,
        ]);
    }

    public function showResultQuiz()
    {
        $topPlayers = ExpPointQuiz::select('user_id', DB::raw('SUM(exp_point) as total_points'))
        ->groupBy('user_id')
        ->orderBy('total_points', 'desc')
        ->limit(3)
        ->with('user') // Assuming you have a User model and relationship defined
        ->get();
        return view('siswa.leaderboard-quiz', compact('topPlayers'));
    }

    public function showLeaderboard()
    {
        $leaderboard = ExpPointQuiz::with('user', 'quiz') // assuming you have a User relationship defined in ExpPointQuiz
        ->orderBy('quiz_id', 'desc') // Order by quiz_id to get the latest quizzes completed
        ->orderBy('created_at', 'desc') // Then order by created_at for the latest completion
        ->distinct('user_id') // Ensures that you get unique users
        ->take(3) // Limit to the top 3 users, if needed
        ->get();

        return view('siswa.latest-leaderboard-quiz', compact('leaderboard'));
    }

}
