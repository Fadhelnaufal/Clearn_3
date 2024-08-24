<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 'student_id', 'answers'
    ];

    protected $casts = [
        'answers' => 'array' // Assuming answers are stored in JSON format
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}
