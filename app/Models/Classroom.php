<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['major_id', 'name', 'grade', 'academic_year'])]
class Classroom extends Model
{
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_student', 'classroom_id', 'student_id')
            ->withPivot('enrolled_at', 'status')
            ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'classroom_teacher', 'classroom_id', 'teacher_id')
            ->withPivot('subject_id')
            ->withTimestamps();
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_classroom');
    }
}
