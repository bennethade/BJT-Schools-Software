<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CbtExam extends Model
{
    use HasFactory, SoftDeletes;

    //CBT Exam has many CBT Questions
    public function questions()
    {
        return $this->hasMany(CbtQuestion::class);
    }

    ////CBT Exam has many CBT Attempts
    public function attempts()
    {
        return $this->hasMany(CbtAttempt::class);
    }
    
    ////CBT Exam Belongs to The User Model (Belongs to a User)
    //Using the "created_by" column in the cbt_exams table to point to the "id" column in the users table
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }


    ///CBT Exam Belongs to a Class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }


    ///CBT Exam Belongs to a Subject 
    // using the "subject_id" column in cbt_exams table to point to the "id" column in subjects table"
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }


    


}
