<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

use Illuminate\Database\Eloquent\SoftDeletes;


class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "classes";


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function getRecord()
    {
        $return = ClassModel::select('classes.*', 'users.name as created_by_name')
                    ->join('users', 'users.id', 'classes.created_by');


                    //SEARCH FEATURE STARTS
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('classes.name', 'like', '%' . Request::get('name') . '%');
                    }

                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('classes.created_at', '=', Request::get('date'));
                    }
                    //SEARCH FEATURE ENDS


        $return = $return->where('classes.is_delete', '=' ,0)
                    ->orderBy('classes.id', 'asc')
                    ->paginate(20);

        return $return;
    }



    static public function getClass()
    {
        $return = ClassModel::select('classes.*', 'classes.name as class_name', 'classes.section as class_section')
                    ->join('users', 'users.id', 'classes.created_by')
                    ->where('classes.is_delete', '=' ,0)
                    ->where('classes.status', '=' ,0)
                    ->orderBy('classes.id', 'asc')
                    ->get();

        return $return;
    }



    static public function getSingleClassName($class_id)
    {
        $return = ClassModel::select('classes.*', 'classes.name as class_name', 'classes.id as class_id', 'classes.description as description', 'classes.section as class_section')
                    ->where('classes.id', '=', $class_id)
                    ->where('classes.is_delete', '=' ,0)
                    ->where('classes.status', '=' ,0)
                    ->first();

        return $return;
    }


    static public function getTotalClass()
    {
        $return = ClassModel::select('classes.id')
                    ->join('users', 'users.id', 'classes.created_by')
                    ->where('classes.is_delete', '=' ,0)
                    ->where('classes.status', '=' ,0)
                    ->count();

        return $return;
    }



    static public function getMyClassList($teacher_id)
    {
        return self::select('classes.*', 'classes.name as class_name', 'classes.id as class_id', 'classes.description as class_description')
                    ->join('assign_class_teachers', 'assign_class_teachers.class_id', '=', 'classes.id')
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->orderBy('assign_class_teachers.class_id', 'asc')
                    ->distinct()
                    ->get();
    }


    static public function getStudentClassList($student_id)
    {
        return self::select('classes.*', 'classes.name as class_name', 'classes.id as class_id', 'classes.description as class_description')
                    ->join('assign_students', 'assign_students.class_id', '=', 'classes.id')
                    ->where('assign_students.student_id', '=', $student_id)
                    ->orderBy('assign_students.class_id', 'asc')
                    ->distinct()
                    ->get();
    }



}
