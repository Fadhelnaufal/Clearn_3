<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultQuiz extends Model
{
    use HasFactory;

    protected $table = 'result_quiz';

    protected $fillable = [
        'quiz_id',
        'user_id',
        'question_id',
        'option_id',
        'is_correct',
    ];

    public function question()
    {
        return $this->belongsTo(QuestionsQuiz::class, 'question_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
}
