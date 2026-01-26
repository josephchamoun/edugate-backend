<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'teacher_subject_section_id',
        'title', 'type', 'exam_date', 'total_marks'
    ];

    public function teacherSubjectSection()
    {
        return $this->belongsTo(TeacherSubjectSection::class);
    }
}