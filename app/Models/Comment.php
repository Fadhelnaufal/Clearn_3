<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
        'user_id',
        'content'
    ];

    // Relationship to the Discussion model
    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    // Relationship to the User model (who made the comment)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
