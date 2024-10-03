<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalPertanyaan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pertanyaan_id',
        'soal_id',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanSoal::class, 'pertanyaan_id');
    }
}
