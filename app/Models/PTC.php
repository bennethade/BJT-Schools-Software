<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\select;

class PTC extends Model
{
    use HasFactory;

    protected $table = 'p_t_c_s';

    protected $fillable = [
        'student_id',
        'subject_id',
        'comment',
        'teacher_comment',
        'parent_comment',
    ];


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function checkExistingPTC($class_id, $exam_id, $student_id, $subject_id)
    {
        return self::where('class_id', $class_id)
                    ->where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    ->where('subject_id', $subject_id)
                    ->first();
    }



    static public function getStudentPTC($class_id, $exam_id, $student_id)
    {
        return self::select('p_t_c_s.*', 'subjects.name as subject_name')
                    ->join('subjects', 'subjects.id', '=', 'p_t_c_s.subject_id')
                    ->where('class_id', $class_id)
                    ->where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    ->orderBy('subjects.name', 'asc')
                    ->get();
    }


    static public function getStudent($student_id)
    {
        return self::select('p_t_c_s.*', 'students.id as student_id', 'students.name as student_name', 'students.last_name as student_last_name', 'students.other_name as student_other_name')
                    ->join('users as students', 'students.id', '=', 'p_t_c_s.student_id')
                    ->where('p_t_c_s.student_id', '=', $student_id)
                    ->first();
    }


    // static public function getRecord($class_id, $exam_id, $student_id)
    // {
    //     return self::select('p_t_c_s.*')
    //                 ->where('class_id', $class_id)
    //                 ->where('exam_id', $exam_id)
    //                 ->where('student_id', $student_id)
    //                 // ->where('subject_id', $subject_id)
    //                 ->get();
    // }


    static public function checkExistingPtcComment($exam_id, $student_id)
    {
        return self::where('exam_id', $exam_id)
                    ->where('student_id', $student_id)
                    ->first();
    }

 
    public function getProfile()
    {
        if(!empty($this->profile_picture) && file_exists('upload/profile/'.$this->profile_picture))
        {
            return url('upload/profile/'.$this->profile_picture);
        }
        else
        {
            return '';
        }

    }

    public function getProfileDirect()
    {
        if(!empty($this->profile_picture) && file_exists('upload/profile/'.$this->profile_picture))
        {
            return url('upload/profile/'.$this->profile_picture);
        }
        else
        {
            return url('upload/profile/user.jpg');
        }

    }






}
