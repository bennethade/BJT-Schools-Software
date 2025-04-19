<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Homework extends Model
{
    use HasFactory, SoftDeletes;



    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }

    static public function getRecord()
    {
        $return = Homework::select('homework.*', 'classes.name as class_name','exams.name as exam_name', 'exams.session as exam_session', 'subjects.name as subject_name', 'users.name as created_by')
                    ->join('users', 'users.id', '=', 'homework.created_by')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('exams', 'exams.id', '=', 'homework.exam_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id');

                    if(!empty(Request::get('class_name')))
                    {
                        $return = $return->where('classes.name', 'like', '%' . Request::get('class_name') . '%');
                    }

                    if(!empty(Request::get('exam_name')))
                    {
                        $return = $return->where('exams.name', 'like', '%' . Request::get('exam_name') . '%');
                    }

                    if(!empty(Request::get('subject_name')))
                    {
                        $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name') . '%');
                    }


                    if(!empty(Request::get('homework_date_from')))
                    {
                        $return = $return->where('homework.homework_date', '>=', Request::get('homework_date_from'));
                    }


                    if(!empty(Request::get('homework_date_to')))
                    {
                        $return = $return->where('homework.homework_date', '<=', Request::get('homework_date_to'));
                    }


                    if(!empty(Request::get('submission_date_from')))
                    {
                        $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
                    }

                    if(!empty(Request::get('submission_date_to')))
                    {
                        $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
                    }

                    if(!empty(Request::get('created_date_from')))
                    {
                        $return = $return->whereDate('homework.created_at', '>=', Request::get('created_date_from'));
                    }


                    if(!empty(Request::get('created_date_to')))
                    {
                        $return = $return->whereDate('homework.created_at', '<=', Request::get('created_date_to'));
                    }
        
        
        $return = $return->orderBy('homework.id', 'desc')
                    ->paginate(20);


        return $return;
    }



    static public function getRecordTeacher($class_ids)
    {
        $return = Homework::select('homework.*', 'classes.name as class_name', 'subjects.name as subject_name', 'users.name as created_by')
                    ->join('users', 'users.id', '=', 'homework.created_by')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
                    ->whereIn('homework.class_id', $class_ids);

                    if(!empty(Request::get('class_name')))
                    {
                        $return = $return->where('classes.name', 'like', '%' . Request::get('class_name') . '%');
                    }

                    if(!empty(Request::get('subject_name')))
                    {
                        $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name') . '%');
                    }


                    if(!empty(Request::get('homework_date_from')))
                    {
                        $return = $return->where('homework.homework_date', '>=', Request::get('homework_date_from'));
                    }


                    if(!empty(Request::get('homework_date_to')))
                    {
                        $return = $return->where('homework.homework_date', '<=', Request::get('homework_date_to'));
                    }


                    if(!empty(Request::get('submission_date_from')))
                    {
                        $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
                    }

                    if(!empty(Request::get('submission_date_to')))
                    {
                        $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
                    }

                    if(!empty(Request::get('created_date_from')))
                    {
                        $return = $return->whereDate('homework.created_at', '>=', Request::get('created_date_from'));
                    }


                    if(!empty(Request::get('created_date_to')))
                    {
                        $return = $return->whereDate('homework.created_at', '<=', Request::get('created_date_to'));
                    }
        
        
        $return = $return->orderBy('homework.id', 'desc')
                    ->paginate(20);


        return $return;
    }



    static public function getRecordStudent($class_id, $student_id)
    {
        $return = Homework::select('homework.*', 'classes.name as class_name', 'subjects.name as subject_name', 'users.name as created_by')
                    ->join('users', 'users.id', '=', 'homework.created_by')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
                    ->where('homework.class_id', '=', $class_id)


                    //Condition to remove assignment that has been submitted by the student
                    ->whereNotIn('homework.id', function($query) use ($student_id) {
                        $query->select('submit_homework.homework_id')
                                ->from('submit_homework')
                                ->where('submit_homework.student_id', '=', $student_id);
                    });
                    //After submitting the assignment, it disappears from the student's dashboard.


                    if(!empty(Request::get('subject_name')))
                    {
                        $return = $return->where('subjects.name', 'like', '%' . Request::get('subject_name') . '%');
                    }


                    if(!empty(Request::get('homework_date_from')))
                    {
                        $return = $return->where('homework.homework_date', '>=', Request::get('homework_date_from'));
                    }


                    if(!empty(Request::get('homework_date_to')))
                    {
                        $return = $return->where('homework.homework_date', '<=', Request::get('homework_date_to'));
                    }


                    if(!empty(Request::get('submission_date_from')))
                    {
                        $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
                    }

                    if(!empty(Request::get('submission_date_to')))
                    {
                        $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
                    }

                    if(!empty(Request::get('created_date_from')))
                    {
                        $return = $return->whereDate('homework.created_at', '>=', Request::get('created_date_from'));
                    }


                    if(!empty(Request::get('created_date_to')))
                    {
                        $return = $return->whereDate('homework.created_at', '<=', Request::get('created_date_to'));
                    }
        
        
        $return = $return->orderBy('homework.id', 'desc')
                    ->paginate(20);


        return $return;
    }



    static public function getRecordStudentCount($class_id, $student_id)
    {
        $return = Homework::select('homework.id')
                    ->join('users', 'users.id', '=', 'homework.created_by')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
                    ->where('homework.class_id', '=', $class_id)


                    //Condition to remove assignment that has been submitted by the student
                    ->whereNotIn('homework.id', function($query) use ($student_id) {
                        $query->select('submit_homework.homework_id')
                                ->from('submit_homework')
                                ->where('submit_homework.student_id', '=', $student_id);
                    })
                    //After submitting the assignment, it disappears from the student's dashboard.
                    ->count();


        return $return;
    }



    public function getDocument()
    {
        if(!empty($this->document_file) && file_exists('upload/homework/'.$this->document_file))
        {
            return url('upload/homework/'.$this->document_file);
        }
        else
        {
            return "";
        }
    }


    


}



