<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Eloquent\SoftDeletes;

class ExamSchedule extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function getRecordSingle($exam_id, $class_id, $subject_id)
    {
        return self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }


    static public function deleteRecord($exam_id, $class_id)
    {
        ExamSchedule::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->delete();
    }




    static public function getExam($class_id)
    {
        return ExamSchedule::select('exam_schedules.*', 'exams.name as exam_name', 'exams.session as exam_session')
                ->join('exams', 'exams.id', '=', 'exam_schedules.exam_id')
                ->where('exam_schedules.class_id', '=', $class_id)
                ->groupBy('exam_schedules.exam_id')
                ->orderBy('exam_schedules.id', 'desc')
                ->get();
    }



    static public function getExamTeacher($teacher_id)
    {
        return ExamSchedule::select('exam_schedules.*', 'exams.name as exam_name', 'exams.session as exam_session')
                ->join('exams', 'exams.id', '=', 'exam_schedules.exam_id')
                ->join('assign_class_teachers', 'assign_class_teachers.class_id', '=', 'exam_schedules.class_id')
                ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                ->groupBy('exam_schedules.exam_id')
                ->orderBy('exam_schedules.id', 'desc')
                ->get();
    }
                     


    
    static public function getExamTimetable($exam_id, $class_id)
    {
        return ExamSchedule::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
                ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
                ->where('exam_schedules.exam_id', '=', $exam_id)
                ->where('exam_schedules.class_id', '=', $class_id)
                ->get();
    
    }


    static public function getSubject($exam_id, $class_id)
    {//TUTOR'S METHOD
        return ExamSchedule::select('exam_schedules.*', 'subjects.id as subject_id', 'subjects.name as subject_name', 'subjects.type as subject_type')
                ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
                ->where('exam_schedules.exam_id', '=', $exam_id)
                ->where('exam_schedules.class_id', '=', $class_id)
                ->orderBy('subjects.name', 'asc')
                ->get();
    
    }


    static public function getExamSubject($exam_id, $class_id)
    {//MY METHOD FOR getSubject
        return self::select(
            'exam_schedules.*',
            'subjects.name as subject_name',
            'subjects.type as subject_type',
            'subjects.id as subject_id'
        )
            ->join('student_subjects', function ($join) {
                $join->on('student_subjects.class_id', '=', 'exam_schedules.class_id')
                    ->on('student_subjects.exam_id', '=', 'exam_schedules.exam_id')
                    ->on('student_subjects.subject_id', '=', 'exam_schedules.subject_id');
            })
            ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
            ->where('exam_schedules.exam_id', '=', $exam_id)
            ->where('exam_schedules.class_id', '=', $class_id)
            ->groupBy(
                'exam_schedules.id',
                'subjects.name',
                'subjects.type',
                
            )
            ->orderBy('subjects.name', 'asc')
            ->get();
    }





    


    static public function getTeacherSubject($class_id, $exam_id, $teacher_id)
    {
        return ExamSchedule::select('exam_schedules.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
                    ->join('subjects', 'subjects.id', '=', 'exam_schedules.subject_id')
                    ->join('subject_teachers', 'subject_teachers.subject_id', '=', 'subjects.id')
                    ->where('subject_teachers.class_id', '=', $class_id)
                    ->where('subject_teachers.exam_id', '=', $exam_id)
                    ->where('subject_teachers.teacher_id', '=', $teacher_id)
                    ->where('exam_schedules.class_id', '=', $class_id)
                    ->where('exam_schedules.exam_id', '=', $exam_id)
                    ->get();
    }




    static public function getMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarksRegister::checkAlreadyMark($student_id, $exam_id, $class_id, $subject_id);
    }


    static public function getPTC($class_id, $exam_id, $student_id, $subject_id)
    {
        return PTC::checkExistingPTC($class_id, $exam_id, $student_id, $subject_id);
    }







}
