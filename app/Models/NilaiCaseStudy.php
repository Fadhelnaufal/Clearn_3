<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiCaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_study_id',
        'student_id',
        'kategori_1',
        'kategori_2',
        'kategori_3',
        'kategori_4',
        'kategori_5',
        'total',
        'timestamp',
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudies::class, 'case_study_id');
    }

    public function studiesSubmission()
    {
        return $this->belongsTo(StudiesSubmission::class, 'submission_id', 'id');
    }
}
