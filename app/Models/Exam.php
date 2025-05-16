<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Exam extends Model
{
    use HasFactory, SoftDeletes;



    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }

    static public function getRecord()
    {
        $return = self::select('exams.*', 'users.name as created_by')
                ->join('users', 'users.id', '=', 'exams.created_by');

                if(!empty(Request::get('name')))
                {
                    $return = $return->where('exams.name', 'like', '%'.Request::get('name').'%');
                }

                if(!empty(Request::get('date')))
                {
                    $return = $return->whereDate('exams.created_at', '=', Request::get('date'));
                }
                
                $return = $return->orderBy('exams.id', 'desc')
                ->paginate(50);

        return $return;
    }


    static public function getExam()
    {
        $return = self::select('exams.*')
                ->join('users', 'users.id', '=', 'exams.created_by')                
                ->orderBy('exams.id', 'desc')
                ->get();

        return $return;
    }


    static public function getSingleExamName($exam_id)
    {
        $return = self::select('exams.*')
                ->where('exams.id', '=', $exam_id)
                ->first();

        return $return;
    }



    static public function getTotalExam()
    {
        $return = self::select('exams.id')
                ->join('users', 'users.id', '=', 'exams.created_by')                
                ->count();

        return $return;
    }


    public function getSchoolStamp()
    {
        if(!empty($this->school_stamp) && file_exists('upload/school_stamp/'.$this->school_stamp))
        {
            return url('upload/school_stamp/'.$this->school_stamp);
        }
        else
        {
            return '';
        }

    }


    static public function getAssignedTerm()
    {
        
    }



    static public function getMyTermList($teacher_id)
    {
        return self::select('exams.*', 'exams.id as exam_id', 'exams.name as exam_name', 'exams.session as exam_session')
                    ->join('assign_class_teachers', 'assign_class_teachers.exam_id', '=', 'exams.id')
                    ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                    ->orderBy('exams.id', 'DESC')
                    ->distinct()
                    ->get();
    }


    static public function getStudentTermList($student_id)
    {
        return self::select('exams.*', 'exams.id as exam_id', 'exams.name as exam_name', 'exams.session as exam_session')
                    ->join('assign_students', 'assign_students.exam_id', '=', 'exams.id')
                    ->where('assign_students.student_id', '=', $student_id)
                    ->orderBy('exams.id', 'DESC')
                    ->distinct()
                    ->get();
    }









}
