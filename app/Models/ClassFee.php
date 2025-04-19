<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassFee extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function checkAlreadyExistingData($class_id, $exam_id)
    {
        return self::where('class_id', '=', $class_id)->where('exam_id', '=', $exam_id)->first();
    }


    static public function getClassFee($class_id, $exam_id)
    {
        return self::select('class_fees.*')->where('class_id', $class_id)->where('exam_id', $exam_id)->first();
    }





}
