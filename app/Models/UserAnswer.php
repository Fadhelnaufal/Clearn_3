<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'question_id', 'answer_value'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
