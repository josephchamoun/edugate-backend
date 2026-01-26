<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'chapter_id', 'teacher_subject_section_id',
        'title', 'description', 'due_date', 'total_marks'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function teacherSubjectSection()
    {
        return $this->belongsTo(TeacherSubjectSection::class);
    }
}