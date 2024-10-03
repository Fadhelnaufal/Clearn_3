<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'judul',
        // 'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo[Category::class];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function subMateris()
    {
        return $this->hasMany(SubMateri::class, 'materi_id');
    }

    public function soalTests()
    {
        return $this->hasMany(SoalTest::class, 'materi_id');
    }

    public function soal(){
        return $this->hasMany(Soal::class, 'materi_id');
    }
}
