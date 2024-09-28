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
        'js',
        'is_submitted',
        'completed_at',
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudies::class, 'case_study_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function user_tasks()
    {
        return $this->hasMany(UserTask::class, 'task_id', 'id'); // Adjust based on your actual column
    }

    public function nilai_case_studies()
    {
        return $this->hasOne(NilaiCaseStudy::class, 'student_id', 'student_id');
    }
    
}
