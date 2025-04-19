<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function checkAlreadyExisting($class_id, $exam_id, $student_id)
    {
        return self::where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->first();
    }


    static public function getBehaviorChart($exam_id, $student_id)
    {
        return self::select('behavior_charts.*')
                    ->where('student_id', $student_id)->where('exam_id', $exam_id)->first();
    }


    static public function getStudent($student_id)
    {
        return self::select('p_t_c_s.*', 'students.id as student_id', 'students.name as student_name', 'students.last_name as student_last_name', 'students.other_name as student_other_name')
                    ->join('users as students', 'students.id', '=', 'p_t_c_s.student_id')
                    ->where('p_t_c_s.student_id', '=', $student_id)
                    ->first();
    }


}
