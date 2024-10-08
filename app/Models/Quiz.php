<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'access_token'];

    public function questions()
    {
        return $this->hasMany(QuestionsQuiz::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_join_user', 'quiz_id', 'user_id');
    }
}
