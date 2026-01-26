<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamScore extends Model
{
    protected $fillable = [
        'student_id', 'exam_id', 'score'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}