<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMateri extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'lampiran',
        'materi_id',
    ];

    // Relasi kebalikannya
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
