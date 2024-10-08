<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'selected_option_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(QuestionsQuiz::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }
}
