<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

    }
    public function show(){
        $questions = Question::all();
        // dd($question);
        return view('dashboard', compact('questions'));
    }

    public function storeAnswers(Request $request){

        $data = $request->validate([
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer_value' => 'required|integer',
        ]);


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
        $user->user_type_image = $userType['image']; // Assuming user_type_image is added to users table
        // $user->save();
        return response()->json([
            'success' => true,
            'user_type' => [
                'name' => $userType['name'],
                'image' => $userType['image']
            ]
        ]);
    }

    private function calculateUserType(){
        $userAnswers = UserAnswer::where('user_id',auth()->id())->with('question')->get();

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
}
