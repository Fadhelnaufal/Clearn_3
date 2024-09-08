<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kelas extends Model
{
    use HasFactory;


    protected $fillable = [
        'mapel',
        'kelas',
        'logo',
        'user_id',
        'token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kelas) {
            $kelas->token = Str::random(5);
        });
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'class_user', 'kelas_id', 'user_id');
    }
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
}
