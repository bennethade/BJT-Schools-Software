<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurserySubjectComment extends Model
{
    use HasFactory;


    static public function getComment($exam_id, $student_id)
    {
        return self::select('nursery_subject_comments.*', 'subjects.name as subject_name')
                    ->join('subjects', 'subjects.id', '=', 'nursery_subject_comments.subject_id')
                    ->where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    ->get();
    }


    static public function checkAlreadyExisting($class_id, $exam_id, $student_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)
                    ->where('exam_id', '=', $exam_id)
                    ->where('student_id', '=', $student_id)
                    ->where('subject_id', '=', $subject_id)
                    ->first();
    }


}



