<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TeacherSubjectSection;
    

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjectSections()
    {
        return $this->hasMany(TeacherSubjectSection::class);
    }
}