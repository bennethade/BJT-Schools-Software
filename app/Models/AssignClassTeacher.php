<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class AssignClassTeacher extends Model
{
    use HasFactory, SoftDeletes;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function getRecord()
    {
        $return = self::select('assign_class_teachers.*', 'classes.name as class_name', 'exams.name as exam_name', 'exams.session as exam_session', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'users.name as created_by_name')
                    ->join('users as teacher', 'teacher.id', '=', 'assign_class_teachers.teacher_id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id')
                    ->join('exams', 'exams.id', '=', 'assign_class_teachers.exam_id')
                    ->join('users', 'users.id', '=', 'assign_class_teachers.created_by')
                    ->where('assign_class_teachers.is_delete', '=' ,0);

                    if(!empty(Request::get('class_name')))
                    {
                        $return = $return->where('classes.name', 'like', '%' . Request::get('class_name') . '%');
                    }


                    if(!empty(Request::get('teacher_name'))) {
                        $return = $return->where(function($query) {
                            $query->where('users.name', 'like', '%' . Request::get('teacher_name') . '%')
                                  ->orWhere('users.last_name', 'like', '%' . Request::get('teacher_name') . '%')
                                  ->orWhere('users.other_name', 'like', '%' . Request::get('teacher_name') . '%');
                        });
                    }


                    // if(!empty(Request::get('teacher_name')))
                    // {
                    //     $return = $return->where('teacher.name', 'like', '%' . Request::get('teacher_name') . '%');
                    // }

                    if(!empty(Request::get('status')))
                    {
                        $status = (Request::get('status') == 100) ? 0 :1;
                        $return = $return->where('assign_class_teachers.status', '=', $status);
                    }

                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('assign_class_teachers.created_at', '=', Request::get('date'));
                    }

        $return = $return->orderBy('assign_class_teachers.class_id', 'asc')
                    ->paginate(100);

        return $return;
    }



    static public function getClassTeacher($exam_id, $student_id)
    {
        //THIS METHOD IS NOT LONGER NEEDED
        //To be used on the exam_result_print.blade.php
        //BUT IT HAS A LITTLE ISSUE. DON'T USE IT

        return self::select('assign_class_teachers.*', 'users.name as teacher_name', 'users.last_name as last_name', 'users.other_name as other_name')
                    ->join('users', 'users.id', '=', 'assign_class_teachers.teacher_id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id')
                    ->join('marks_registers', 'marks_registers.class_id', '=', 'assign_class_teachers.class_id')
                    ->where('marks_registers.exam_id', '=', $exam_id)
                    ->where('marks_registers.student_id', '=', $student_id)
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->first();

    }




    static public function getExamTeacher($teacher_id)
    {
        return self::select('assign_class_teachers.*', 'exams.id as exam_id', 'exams.name as exam_name', 'exams.session as exam_session')
                ->join('exams', 'exams.id', '=', 'assign_class_teachers.exam_id')
                ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                ->orderBy('exams.id', 'desc')
                ->get();
    }
    




    static public function getMyClassSubjectCount($teacher_id)
    {
        return self::select('assign_class_teachers.id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id')
                    ->join('class_subjects', 'class_subjects.class_id', '=', 'classes.id')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('subjects.status', '=' ,0)
                    ->where('class_subjects.status', '=' ,0)
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->count();

    }


    static public function getMyClassSubjectGroupCount($teacher_id)
    {
        return self::select('assign_class_teachers.id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id') 
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    // ->groupBy('assign_class_teachers.class_id')
                    ->count();

    }



    static public function getMyClassSubject($teacher_id)
    {
        return self::select('assign_class_teachers.*', 'classes.name as class_name', 'subjects.name as subject_name', 'subjects.type as subject_type', 'classes.id as class_id', 'subjects.id as subject_id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id')
                    ->join('class_subjects', 'class_subjects.class_id', '=', 'classes.id')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('subjects.status', '=' ,0)
                    ->where('class_subjects.status', '=' ,0)
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->get();

    }



    static public function getMyClassSubjectGroup($teacher_id)
    {
        return self::select('assign_class_teachers.*', 'classes.name as class_name', 'classes.id as class_id', 'classes.description as class_description')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id') 
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->groupBy('assign_class_teachers.class_id')
                    ->get();

    }


    static public function getTeacherClassList($teacher_id)
    {
        return self::select('assign_class_teachers.*', 'classes.name as class_name', 'classes.id as class_id', 'classes.description as class_description')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id') 
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->groupBy('assign_class_teachers.class_id')
                    ->get();

    }


    static public function getTeacherTermList($teacher_id)
    {
        return self::select('assign_class_teachers.*', 'exams.name as exam_name', 'exams.id as exam_id', 'exams.session as exam_session')
                    ->join('exams', 'exams.id', '=', 'assign_class_teachers.exam_id') 
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->groupBy('assign_class_teachers.exam_id')
                    ->get();

    }


    static public function getTeacherAssignedTerm($class_id)
    {
        return self::select('assign_class_teachers.*', 'exams.name as exam_name', 'exams.id as exam_id', 'exams.session as exam_session')
                    ->join('exams', 'exams.id', '=', 'assign_class_teachers.exam_id') 
                    ->where('assign_class_teachers.is_delete', '=' ,0)
                    ->where('assign_class_teachers.status', '=' ,0)
                    ->where('assign_class_teachers.class_id', '=', $class_id)
                    ->groupBy('assign_class_teachers.exam_id')
                    ->get();

    }


    static public function getAlreadyFirst($class_id, $exam_id, $teacher_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('teacher_id', $teacher_id)->first();
    }


    static public function getAssignTeacherId($class_id, $exam_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('is_delete',0)->get();
    }


    static public function deleteTeacher($teacher_id)
    {
        return self::where('teacher_id', $teacher_id)->delete();
    }



    static public function getMyTimetable($class_id, $subject_id)
    {
        $getWeek = Week::getWeekUsingName(date('l'));

        return ClassSubjectTimetable::getRecordClassSubject($class_id, $subject_id, $getWeek->id);
    }





    static public function fetchClassTeacher($class_id, $exam_id, $student_id)
    {
        // USED ON NURSERY RESULTS WORKING PERFECTLY
        
        return self::select('assign_class_teachers.*', 'users.name as teacher_name', 'users.last_name as last_name', 'users.other_name as other_name')
                    ->join('users', 'users.id', '=', 'assign_class_teachers.teacher_id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id')
                    ->join('assign_students', 'assign_students.class_id', '=', 'assign_class_teachers.class_id') // Join based on class_id
                    ->where('assign_students.student_id', '=', $student_id)  // Filter by student_id
                    ->where('assign_class_teachers.exam_id', '=', $exam_id)
                    ->where('assign_class_teachers.class_id', '=', $class_id)
                    ->where('assign_class_teachers.is_delete', '=', 0)
                    ->first();
    }


    static public function nurseryClassTeacher($class_id, $exam_id)
    {
        // USED ON NURSERY RESULTS WORKING PERFECTLY TOO
        
        return self::select('assign_class_teachers.*', 'users.name as teacher_name', 'users.last_name as last_name', 'users.other_name as other_name')
                    ->join('users', 'users.id', '=', 'assign_class_teachers.teacher_id')
                    ->join('classes', 'classes.id', '=', 'assign_class_teachers.class_id')
                    ->where('assign_class_teachers.class_id', '=', $class_id) 
                    ->where('assign_class_teachers.exam_id', '=', $exam_id)
                    ->where('assign_class_teachers.is_delete', '=', 0)
                    ->first();
    }





}
