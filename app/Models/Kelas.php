<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;


    protected $fillable = [
        'mapel', 'kelas', 'logo', 'user_id', 'token'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kelas) {
            $kelas->token = Str::random(64); 
        });
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
