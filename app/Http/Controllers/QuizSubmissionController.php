<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizSubmission;

class QuizSubmissionController extends Controller
{
    public function showQuiz($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('quizzes.take', compact('quiz'));
    }

    /**
     * Store a newly created quiz submission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $quizId
     * @return \Illuminate\Http\Response
     */
    public function submitAnswers(Request $request, $quizId)
    {
        $this->validate($request, [
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        $data = [
            'quiz_id' => $quizId,
            'student_id' => auth()->user()->id,
            'answers' => $request->input('answers'),
        ];

        QuizSubmission::create($data);

        return redirect()->route('quizzes.show', $quizId)
            ->with('success', 'Jawaban berhasil dikirim');
    }
}
