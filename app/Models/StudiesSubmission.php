<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudiesSubmission extends Model
{
    use HasFactory;

    protected $table = 'student_submissions';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'case_study_id',
        'student_id',
        'html',
        'css',
        'js'
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudies::class, 'case_study_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
