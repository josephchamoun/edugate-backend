<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGradeYear extends Model
{
    protected $table = 'student_grade_year';

    protected $fillable = [
        'student_id', 'grade_year_id', 'section_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}