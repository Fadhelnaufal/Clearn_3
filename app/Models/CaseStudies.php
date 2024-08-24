<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudies extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas_id', 'title', 'description'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function submissions()
    {
        return $this->hasMany(StudentSubmission::class, 'case_study_id');
    }
}
