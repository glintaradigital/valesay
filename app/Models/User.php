<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subjectsAsTeacher()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }

    public function classroomsAsStudent()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id')
            ->withPivot('enrolled_at', 'status')
            ->withTimestamps();
    }

    public function classroomsAsTeacher()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_teacher', 'teacher_id')
            ->withPivot('subject_id')
            ->withTimestamps();
    }

    public function testsCreated()
    {
        return $this->hasMany(Test::class, 'teacher_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function usageLogs()
    {
        return $this->hasMany(UsageLog::class);
    }
}
