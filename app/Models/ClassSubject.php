<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

use Illuminate\Database\Eloquent\SoftDeletes;


class ClassSubject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "class_subjects";


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }

    

    static public function getAssignedClassSubject($class_id)
    {
        return self::select('class_subjects.*', 'classes.name as class_name', 'subjects.id as subject_id', 'subjects.name as subject_name', 'subjects.type as subject_type')
                    ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->where('class_subjects.class_id', '=', $class_id)
                    ->orderBy('subjects.name', 'asc')
                    ->get();
    }

    


    static public function getRecord()
    {
        $return = self::select('class_subjects.*', 'classes.name as class_name', 'classes.description as class_description', 'subjects.name as subject_name', 'users.name as created_by_name')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
                    ->join('users', 'users.id', '=', 'class_subjects.created_by')
                    ->where('class_subjects.is_delete', '=' ,0)
                    ->where('class_subjects.status', 0);
                    

                     //SEARCH FEATURE STARTS
                     if(!empty(Request::get('class_name')))
                     {
                         $return = $return->where('classes.name', 'like', '%' . Request::get('class_name') . '%');
                     }

                     if(!empty(Request::get('subject_name')))
                     {
                         $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name') . '%');
                     }
 
                     if(!empty(Request::get('date')))
                     {
                         $return = $return->whereDate('class_subjects.created_at', '=', Request::get('date'));
                     }
                     //SEARCH FEATURE ENDS
 


        $return = $return->orderBy('class_subjects.id', 'asc')
                    ->paginate(100);

        return $return;
    }


    static public function mySubject_ByTutor($class_id)
    {//Tutor
        return self::select('class_subjects.*', 'subjects.name as subject_name', 'subjects.type as subject_type')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
                    ->join('users', 'users.id', '=', 'class_subjects.created_by')
                    ->where('class_subjects.class_id', '=', $class_id)
                    ->where('class_subjects.is_delete', '=' ,0)
                    ->where('class_subjects.status', '=' ,0)
                    ->orderBy('class_subjects.id', 'desc')
                    ->get();
                    
    }


    static public function mySubject($user_id)
    {//Mine in use
        return self::join('assign_students', 'assign_students.class_id', '=', 'class_subjects.class_id')
                        ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                        ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
                        ->join('users', 'users.id', '=', 'class_subjects.created_by')
                        ->where('assign_students.student_id', $user_id)
                        ->where('class_subjects.is_delete', '=' ,0)
                        ->where('class_subjects.status', '=' ,0)

                        ->select('class_subjects.*', 'subjects.name as subject_name', 'subjects.type as subject_type')

                        ->orderBy('class_subjects.id', 'desc')    
                        ->get();
    }


    static public function myTotalSubject($class_id)
    {
        return self::select('class_subjects.id')
                    ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                    ->join('classes', 'classes.id', '=', 'class_subjects.class_id')
                    ->join('users', 'users.id', '=', 'class_subjects.created_by')
                    ->where('class_subjects.class_id', '=', $class_id)
                    ->where('class_subjects.is_delete', '=' ,0)
                    ->where('class_subjects.status', '=' ,0)
                    ->count();
                    
    }



    static public function getAlreadyFirst($class_id, $subject_id)
    {
        return self::where('class_id', $class_id)->where('subject_id', $subject_id)->first();
    }


    static public function getAssignSubjectId($class_id)
    {
        return self::where('class_id', $class_id)->where('is_delete',0)->get();
    }


    static public function deleteSubject($class_id)
    {
        return self::where('class_id', $class_id)->forceDelete();
    }


    static public function getComment($class_id, $exam_id, $student_id, $subject_id)
    {
        return NurserySubjectComment::checkAlreadyExisting($class_id, $exam_id, $student_id, $subject_id);
    }


    static public function getPTC($class_id, $exam_id, $student_id, $subject_id)
    {
        return PTC::checkExistingPTC($class_id, $exam_id, $student_id, $subject_id);
    }




}
