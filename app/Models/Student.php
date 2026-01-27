<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ParentModel;
use App\Models\StudentGradeYear;
use App\Models\StudentExamScore;
use App\Models\StudentAssignment;


class Student extends Model
{
protected $fillable = [
'user_id', // NEW: link to users table
'parent_id',
'student_code',
'full_name',
'birth_date',
'gender',
'status'
];


// Relation to user (auth info)
public function user()
{
return $this->belongsTo(User::class);
}


// Relation to parent profile
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