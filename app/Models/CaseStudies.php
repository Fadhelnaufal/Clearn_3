<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudies extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas_id',
        'title',
        'description',
        'image',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function submissions()
    {
        return $this->hasMany(StudiesSubmission::class, 'case_study_id');
    }

    public function userTasks()
    {
        return $this->morphMany(UserTask::class, 'task');
    }

    public function nilaiCaseStudy()
    {
        return $this->hasMany(NilaiCaseStudy::class, 'case_study_id');
    }
}
