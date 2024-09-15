<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'background', 'kelas_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
