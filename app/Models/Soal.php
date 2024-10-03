<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'materi_id',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function pertanyaanSoals()
    {
        return $this->belongsToMany(PertanyaanSoal::class, 'soal_pertanyaans', 'soal_id', 'pertanyaan_id');
    }
}
