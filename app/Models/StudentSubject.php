<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StudentSubject extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    static public function getRecord($class_id, $exam_id, $student_id)
    {
        return self::select('student_subjects.*', 'classes.name as class_name', 'classes.description as class_description', 'subjects.name as subject_name', 'subjects.description as subject_description', 'users.name as created_by_name', 'student.name as student_name')

                
                    ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                    ->join('classes', 'classes.id', '=', 'student_subjects.class_id')
                    ->join('users', 'users.id', '=', 'student_subjects.created_by')
                    ->join('users as student', 'student.id', '=', 'student_subjects.student_id')

                    ->where('student_subjects.class_id', $class_id)
                    ->where('student_subjects.exam_id', $exam_id)
                    ->where('student_subjects.student_id', $student_id)
                    ->orderBy('subjects.name', 'asc')
                    ->get();
                    
    }



    static public function getStudent($student_id)
    {
        return self::select('student_subjects.*', 'users.id as student_id', 'users.name as student_name', 'users.last_name as student_last_name', 'classes.id as class_id', 'classes.name as class_name', 'classes.description as class_description', 'exams.id as exam_id', 'exams.name as exam_name', 'exams.session as exam_session')
                    ->join('users', 'users.id', '=', 'student_subjects.student_id')
                    ->join('classes', 'classes.id', 'student_subjects.class_id')
                    ->join('exams', 'exams.id', 'student_subjects.exam_id')
                    ->where('student_subjects.student_id', $student_id)
                    ->first();
    }


    static public function checkAlreadyExistingSubject($class_id, $exam_id, $student_id)
    {
        return self::select('student_subjects.*')
                    ->join('class_subjects', 'class_subjects.subject_id', '=', 'student_subjects.subject_id')
                    ->where('student_subjects.class_id', $class_id)
                    ->where('student_subjects.exam_id', $exam_id)
                    ->where('student_subjects.student_id', $student_id)
                    ->first();
    }



    // static public function getSubject($exam_id, $class_id, $student_id)
    // {//MINE - NOT WORKING AS EXPECTED
    //     return ExamSchedule::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
    //             ->join('student_subjects.*', 'student_subjects.subject_id', '=', 'exam_schedules.subject_id')
    //             ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
    //             ->where('student_subjects.exam_id', '=', $exam_id)
    //             ->where('student_subjects.class_id', '=', $class_id)
    //             ->where('student_subjects.student_id', '=', $student_id)
    //             ->where('exam_schedules.exam_id', '=', $exam_id)
    //             ->where('exam_schedules.class_id', '=', $class_id)
    //             ->get();
    
    // }




    // static public function getExamSubject($exam_id, $student_id)
    // {
    //     return self::select('student_subjects.*', 'exams.name as exam_name', 'exams.session as exam_session', 'subjects.name as subject_name')
    //                 ->join('marks_registers', 'marks_registers.class_id', '=', 'student_subjects.class_id')
    //                 ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
    //                 ->join('exams', 'exams.id', '=', 'student_subjects.exam_id')

    //                 ->where('student_subjects.exam_id', '=', $exam_id)
    //                 ->where('student_subjects.student_id', '=', $student_id)
    //                 ->get();
                    
    // }



    static public function getExamSubject($exam_id, $student_id)
    {
        return self::select(
            'student_subjects.*',
            'exams.name as exam_name',
            'exams.session as exam_session',
            'subjects.name as subject_name',
            'subjects.id as subject_id',
            'marks_registers.*'
        )
            ->join('marks_registers', function ($join) {
                $join->on('marks_registers.class_id', '=', 'student_subjects.class_id')
                    ->on('marks_registers.exam_id', '=', 'student_subjects.exam_id')
                    ->on('marks_registers.student_id', '=', 'student_subjects.student_id')
                    ->on('marks_registers.subject_id', '=', 'student_subjects.subject_id'); // Adjust this based on your actual column names
            })
            ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
            ->join('exams', 'exams.id', '=', 'student_subjects.exam_id')
            ->where('student_subjects.exam_id', '=', $exam_id)
            ->where('student_subjects.student_id', '=', $student_id)
            // ->distinct()
            ->orderBy('subjects.name', 'asc')
            ->get();
    }


    //FOR CUMULATIVE SUBJECTS
    static public function getCumulativeExamSubject($class_id, $student_id)
    {
        return self::select(
            'student_subjects.*',
            // 'exams.name as exam_name',
            // 'exams.session as exam_session',
            'subjects.name as subject_name',
            'subjects.id as subject_id',
            'marks_registers.*'
        )
            ->join('marks_registers', function ($join) {
                $join->on('marks_registers.class_id', '=', 'student_subjects.class_id')
                    ->on('marks_registers.student_id', '=', 'student_subjects.student_id')
                    ->on('marks_registers.subject_id', '=', 'student_subjects.subject_id'); // Adjust this based on your actual column names
            })
            ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
            // ->join('exams', 'exams.id', '=', 'student_subjects.exam_id')
            ->where('student_subjects.class_id', '=', $class_id)
            ->where('student_subjects.student_id', '=', $student_id)
            // ->distinct()
            ->orderBy('subjects.name', 'asc')
            ->get();
    }






    // static public function getMark($student_id, $exam_id, $class_id, $subject_id)
    // {
    //     return MarksRegister::checkAlreadyMark($student_id, $exam_id, $class_id, $subject_id);
    // }


    static public function getStudentSubject($class_id, $exam_id, $student_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('student_id', $student_id)->get();
    }
    


    
}

