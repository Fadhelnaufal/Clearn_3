<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'jawaban',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
