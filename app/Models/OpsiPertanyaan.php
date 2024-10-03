<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpsiPertanyaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'opsi',
        'is_correct',
        'pertanyaan_id',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanSoal::class, 'pertanyaan_id');
    }
}
