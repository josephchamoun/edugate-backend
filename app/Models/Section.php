<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['grade_year_id', 'name'];

    public function gradeYear()
    {
        return $this->belongsTo(GradeYear::class);
    }
}