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
        'user_type_id',
        'kategori_id',
    ];

    // Relasi kebalikannya
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
