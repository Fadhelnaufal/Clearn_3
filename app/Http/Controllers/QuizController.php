<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizQuestion;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created quiz in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $quiz = Quiz::create($request->all());

        // Store quiz questions
        $questions = $request->input('questions');
        foreach ($questions as $question) {
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question' => $question['question'],
                'options' => $question['options'],
                'correct_option' => $question['correct_option'],
            ]);
        }

        return redirect()->route('quizzes.index')->with('success', 'Quiz berhasil dibuat');
    }
}
