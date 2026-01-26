<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeYear extends Model
{
    protected $fillable = [
        'grade_id', 'academic_year_id', 'is_active'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function subjects()
    {
        return $this->hasMany(GradeYearSubject::class);
    }
}