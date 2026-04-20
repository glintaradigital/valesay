<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['major_id', 'teacher_id', 'name', 'code', 'description'])]
class Subject extends Model
{
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_teacher', 'subject_id', 'classroom_id')
            ->withPivot('teacher_id')
            ->withTimestamps();
    }
}
