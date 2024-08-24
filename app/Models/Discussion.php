<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'user_id',
        'title',
        'content'
    ];

    // Relationship to the Kelas model
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relationship to the User model (who started the discussion)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the Comment model
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
