<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSoalSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id', 
        'soal_id', 
        'pertanyaan_id', 
        'opsi_id', 
        'is_correct'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanSoal::class, 'pertanyaan_id');
    }

    public function opsi()  
    {
        return $this->belongsTo(OpsiPertanyaan::class, 'opsi_id');
    }
}
