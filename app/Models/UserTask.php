<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'materi_id',
        'student_id',
        'task_id',
        'task_type',
        'user_type_id',
        'is_completed',
        'completed_at',
        'points',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function studiesSubmission()
    {
        return $this->belongsTo(StudiesSubmission::class, 'submission_id', 'id'); // Adjust as needed
    }

    public function task()
    {
        return $this->morphTo(null, 'task_type', 'task_id');
        // if ($this->task_type == 'sub_materi') {
        //     return $this->belongsTo(SubMateri::class, 'task_id');
        // } elseif ($this->task_type == 'case_study') {
        //     return $this->belongsTo(CaseStudies::class, 'task_id');
        // }
        // return null;
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'task_id'); // Adjust according to your foreign key
    }
}
