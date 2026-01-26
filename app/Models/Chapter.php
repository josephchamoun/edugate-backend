<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'grade_year_subject_id', 'title', 'description'
    ];

    public function gradeYearSubject()
    {
        return $this->belongsTo(GradeYearSubject::class);
    }

    public function materials()
    {
        return $this->hasMany(ChapterMaterial::class);
    }
}