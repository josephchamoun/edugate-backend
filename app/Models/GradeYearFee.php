<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeYearFee extends Model
{
    protected $fillable = [
        'grade_year_id', 'total_amount'
    ];
}