<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtAttempt extends Model
{
    use HasFactory; 

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(CbtResponse::class);
    }


    public function cbtExam()
    {
        return $this->belongsTo(CbtExam::class);
    }


    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }


    public function term()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }



    public static function alreadyTaken($class_id, $exam_id, $student_id, $cbt_exam_id)
    {
        return self::where('class_id', $class_id)
                    ->where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    ->where('cbt_exam_id', $cbt_exam_id)
                    ->where('cbt_attempts.score', '>=', 0)
                    ->first();
    }



    public static function getStudentCBT($class_id, $exam_id, $student_id)
    {
        return self::select('cbt_attempts.*', 'exams.name as term_name', 'exams.session as term_session')
                    ->join('classes', 'classes.id', '=', 'cbt_attempts.class_id')
                    ->join('exams', 'exams.id', '=', 'cbt_attempts.exam_id')
                    ->where('class_id', $class_id)
                    ->where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    ->orderBy('cbt_attempts.score', 'desc')
                    ->get();
    }



    public static function getSingleCBTScores($class_id, $exam_id, $cbt_exam_id)
    {
        return self::select('cbt_attempts.*',
                    'classes.name as class_name',
                    'exams.name as exam_name',
                    'cbt_exams.exam_title as exam_title',
                    'users.id as student_id'           
        )
                    ->join('cbt_exams', 'cbt_exams.id', '=', 'cbt_attempts.cbt_exam_id')
                    ->join('classes', 'classes.id', '=', 'cbt_attempts.class_id')
                    ->join('exams', 'exams.id', '=', 'cbt_attempts.exam_id')
                    ->join('users', 'users.id', '=', 'cbt_attempts.student_id')
                    ->where('cbt_attempts.class_id', $class_id)
                    ->where('cbt_attempts.exam_id', $exam_id)
                    ->where('cbt_attempts.cbt_exam_id', $cbt_exam_id)
                    ->get();
    }



    public static function getCbtDetails($class_id, $exam_id, $cbt_exam_id)
    {
        return self::select('cbt_attempts.*')
                    ->join('exams', 'exams.id', '=', 'cbt_attempts.exam_id')
                    ->where('cbt_attempts.class_id', $class_id)
                    ->where('cbt_attempts.exam_id', $exam_id)
                    ->where('cbt_attempts.cbt_exam_id', $cbt_exam_id)
                    ->first();
    }



    
}
