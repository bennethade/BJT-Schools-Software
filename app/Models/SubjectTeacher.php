<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubjectTeacher extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function getAlreadyFirst($class_id, $exam_id, $subject_id, $teacher_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('subject_id', $subject_id)->where('teacher_id', $teacher_id)->first();
    }


    static public function getRecord()
    {
        $return = self::select('subject_teachers.*', 'classes.name as class_name', 'classes.description as class_description', 'exams.name as exam_name' , 'exams.session as exam_session', 'subjects.name as subject_name', 'users.name as teacher_name', 'users.last_name as teacher_last_name', 'users.other_name as teacher_other_name', 'created_by.name as created_by')
                        ->join('classes', 'classes.id', '=', 'subject_teachers.class_id')
                        ->join('exams', 'exams.id', '=', 'subject_teachers.exam_id')
                        ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                        ->join('users', 'users.id', '=', 'subject_teachers.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'subject_teachers.created_by')
                        ->where('users.user_type', '!=', 1)
                        ->where('users.user_type', '!=', 'Super Admin')
                        ->where('users.user_type', '!=', 'School Admin');

                        //SEARCH FEATURE STARTS
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
                        //     $return = $return->where('users.name', 'like', '%' . Request::get('teacher_name') . '%')->orWhere('users.last_name', 'like', '%' . Request::get('teacher_name') . '%')->orWhere('users.other_name', 'like', '%' . Request::get('teacher_name') . '%');
                        // }

                        if(!empty(Request::get('subject_name')))
                        {
                            $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name') . '%');
                        }
    
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('subject_teachers.created_at', '=', Request::get('date'));
                        }
                        //SEARCH FEATURE ENDS


        $return = $return->orderBy('subject_teachers.id', 'desc')
                        ->paginate(100);
        return $return;
    }


    static public function getAssignSubjectId($class_id, $exam_id, $teacher_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('teacher_id', $teacher_id)->get();
    }


    static public function deleteSubject($class_id, $exam_id, $teacher_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('teacher_id', $teacher_id)->forceDelete();
    }



    


    



    


}
