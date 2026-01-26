<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'parent_id', 'student_code', 'full_name',
        'birth_date', 'gender', 'status'
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    public function gradeYears()
    {
        return $this->hasMany(StudentGradeYear::class);
    }

    public function exams()
    {
        return $this->hasMany(StudentExamScore::class);
    }

    public function assignments()
    {
        return $this->hasMany(StudentAssignment::class);
    }
}