<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeYearSubject extends Model
{
    protected $table = 'grade_year_subjects';

    protected $fillable = [
        'grade_year_id', 'subject_id', 'is_active', 'coefficient'
    ];

    public function gradeYear()
    {
        return $this->belongsTo(GradeYear::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}