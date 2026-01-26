<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubjectSection extends Model
{
    protected $table = 'teacher_subject_sections';

    protected $fillable = [
        'teacher_id', 'grade_year_subject_id', 'section_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function gradeYearSubject()
    {
        return $this->belongsTo(GradeYearSubject::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}