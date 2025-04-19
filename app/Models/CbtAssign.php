<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class CbtAssign extends Model
{
    use HasFactory, SoftDeletes;

    static public function alreadyExistingData($cbt_exam_id, $exam_id, $class_id)
    {
        return self::where('cbt_exam_id', $cbt_exam_id)->where('exam_id', $exam_id)->where('class_id', $class_id)->first();
    }


    static public function getRecord()
    {
        $return = self::select(
                    'cbt_assigns.*',
                    'classes.name as class_name',
                    'classes.description as class_description',
                    'exams.name as exam_name',
                    'exams.session as exam_session',
                    'cbt_exams.exam_title as exam_title',
                    'cbt_exams.duration as duration',
                    'subjects.name as subject_name',
                    'users.name as created_by_name',
                    'users.last_name as created_by_last_name'
                )
                ->join('classes', 'classes.id', '=', 'cbt_assigns.class_id')
                ->join('exams', 'exams.id', '=', 'cbt_assigns.exam_id')
                ->join('cbt_exams', 'cbt_exams.id', '=', 'cbt_assigns.cbt_exam_id')
                ->join('subjects', 'subjects.id', '=', 'cbt_exams.subject_id')
                ->join('users', 'users.id', '=', 'cbt_assigns.created_by');

                if (!empty(Request::get('name'))) {
                    $return = $return->where(function ($query) {
                        $query->where('classes.name', 'like', '%' . Request::get('name') . '%')
                            ->orWhere('classes.description', 'like', '%' . Request::get('name') . '%')
                            ->orWhere('exams.name', 'like', '%' . Request::get('name') . '%')
                            ->orWhere('exams.session', 'like', '%' . Request::get('name') . '%')
                            ->orWhere('cbt_exams.exam_title', 'like', '%' . Request::get('name') . '%');
                    });
                }

        // Order by latest entries in the cbt_assigns table
        $return = $return->orderBy('cbt_assigns.created_at', 'DESC')->paginate(50);

        return $return;
    }



    static public function getStudentCBT($class_id, $exam_id)
    {
        return self::select('cbt_assigns.*', 
                        'cbt_exams.id as cbt_exam_id',
                        'cbt_exams.exam_title as exam_title',
                        'classes.id as class_id',
                        'classes.name as class_name',
                        'exams.id as term_id',
                        'exams.name as term_name',
                        'exams.session as term_session',
                        'subjects.id as subject_id',
                        'subjects.name as subject_name'
                    )
                    ->join('classes', 'classes.id', '=', 'cbt_assigns.class_id')
                    ->join('exams', 'exams.id', '=', 'cbt_assigns.exam_id')
                    ->join('cbt_exams', 'cbt_exams.id', 'cbt_assigns.cbt_exam_id')
                    ->join('subjects', 'subjects.id', '=', 'cbt_exams.subject_id')
                    ->where('cbt_assigns.class_id', '=', $class_id)
                    ->where('cbt_assigns.exam_id', '=', $exam_id)
                    ->get();
    }




}
