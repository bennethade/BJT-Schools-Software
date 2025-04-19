<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ClassSubjectTimetable extends Model
{
    use HasFactory, SoftDeletes;

    static public function getRecordClassSubject($class_id, $subject_id, $week_id)
    {
        return self::where('class_id', $class_id)->where('subject_id', $subject_id)->where('week_id', $week_id)->first();
    }




}
