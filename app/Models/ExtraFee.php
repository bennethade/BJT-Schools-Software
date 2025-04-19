<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraFee extends Model
{
    use HasFactory;

    static public function checkAlreadyExistingData($class_id, $exam_id, $student_id)
    {
        return self::where('class_id', '=', $class_id)->where('exam_id', '=', $exam_id)->where('student_id', '=', $student_id)->first();
    }


    static public function getExtraFees($class_id, $exam_id, $student_id)
    {
        return self::select('extra_fees.*')->where('class_id', $class_id)->where('exam_id', $exam_id)->where('student_id', $student_id)->first();
    }


    static public function getStudentFees($exam_id, $student_id)
    {
        return self::select('extra_fees.*')->where('exam_id', $exam_id)->where('student_id', $student_id)->first();
    }


    static public function getClass($exam_id, $student_id)
    {
        return self::select('extra_fees.*', 'classes.id as class_id', 'classes.name as class_name', 'classes.section as section', 'classes.description as description')
                    ->join('exams', 'exams.id', '=', 'extra_fees.exam_id')
                    ->join('classes', 'classes.id', '=', 'extra_fees.class_id')
                    ->where('extra_fees.exam_id', '=', $exam_id)
                    ->where('extra_fees.student_id', '=', $student_id)
                    ->first();

    }





}
