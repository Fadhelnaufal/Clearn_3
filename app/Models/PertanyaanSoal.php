<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan',
        'gambar',
        'timestamp',
    ];

    public function opsiPertanyaan()
    {
        return $this->hasMany(OpsiPertanyaan::class, 'pertanyaan_id');
    }

    public function soals()
    {
        return $this->belongsToMany(Soal::class, 'soal_pertanyaans', 'pertanyaan_id', 'soal_id');
    }
}
