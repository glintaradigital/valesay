<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['teacher_id', 'subject_id', 'title', 'description', 'duration', 'code', 'status'])]
class Test extends Model
{
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'test_classroom');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function usageLogs()
    {
        return $this->hasMany(UsageLog::class);
    }
}
