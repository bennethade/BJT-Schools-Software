<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorChart extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function checkAlreadyBehaviorChart($student_id, $exam_id, $class_id)
    {
        return self::where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->first();
    }


    static public function getBehaviorChart($student_id, $exam_id)
    {
        return self::select('behavior_charts.*')
                    ->where('student_id', $student_id)->where('exam_id', $exam_id)->first();
    }


    
}
