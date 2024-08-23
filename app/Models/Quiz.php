<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas_id', 'judul', 'deskripsi'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class, 'quiz_id');
    }
}
