<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsQuiz extends Model
{
    use HasFactory;

    protected $table = 'questions_quiz';

    protected $fillable = ['quiz_id', 'question_text', 'question_image'];

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
}
