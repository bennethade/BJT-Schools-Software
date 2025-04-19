<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubmitHomework extends Model
{
    use HasFactory;


    static public function getRecord($homework_id)
    {
        $return = self::select('submit_homework.*', 'users.name as name', 'users.last_name as last_name', 'users.other_name as other_name')
                    ->join('users', 'users.id', '=', 'submit_homework.student_id')
                    ->where('submit_homework.homework_id', '=', $homework_id);

                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
                    }

                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
                    }


                    if(!empty(Request::get('created_date_from')))
                    {
                        $return = $return->whereDate('submit_homework.created_at', '>=', Request::get('created_date_from'));
                    }


                    if(!empty(Request::get('created_date_to')))
                    {
                        $return = $return->whereDate('submit_homework.created_at', '<=', Request::get('created_date_to'));
                    }


        $return = $return->orderBy('submit_homework.homework_id', 'desc')
                    ->paginate(50);

        return $return;

    }

    static public function getRecordStudent($student_id)
    {
        $return = self::select('submit_homework.*', 'classes.name as class_name', 'subjects.name as subject_name')
                    ->join('homework', 'homework.id', '=', 'submit_homework.homework_id')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
                    ->where('submit_homework.student_id', '=', $student_id);


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
                        $return = $return->whereDate('submit_homework.created_at', '>=', Request::get('created_date_from'));
                    }


                    if(!empty(Request::get('created_date_to')))
                    {
                        $return = $return->whereDate('submit_homework.created_at', '<=', Request::get('created_date_to'));
                    }
        


        $return = $return->orderBy('submit_homework.id', 'desc')
                    ->paginate(20);

        return $return;
    }



    static public function getRecordStudentCount($student_id)
    {
        $return = self::select('submit_homework.id')
                    ->join('homework', 'homework.id', '=', 'submit_homework.homework_id')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
                    ->where('submit_homework.student_id', '=', $student_id)
                    ->count();

        return $return;
    }


    static public function getRecordStudentParentCount($student_ids)
    {
        $return = self::select('submit_homework.id')
                    ->join('homework', 'homework.id', '=', 'submit_homework.homework_id')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
                    ->whereIn('submit_homework.student_id', $student_ids)
                    ->count();

        return $return;
    }


    static public function getHomeworkReport()
    {
        $return = self::select('submit_homework.*', 'classes.name as class_name', 'subjects.name as subject_name', 'users.name as name', 'users.last_name as last_name', 'users.other_name as other_name')
                    ->join('users', 'users.id', '=', 'submit_homework.student_id')
                    ->join('homework', 'homework.id', '=', 'submit_homework.homework_id')
                    ->join('classes', 'classes.id', '=', 'homework.class_id')
                    ->join('subjects', 'subjects.id', '=', 'homework.subject_id');


                    if(!empty(Request::get('name'))) {
                        $return = $return->where(function($query) {
                            $query->where('users.name', 'like', '%' . Request::get('name') . '%')
                                  ->orWhere('users.last_name', 'like', '%' . Request::get('name') . '%')
                                  ->orWhere('users.other_name', 'like', '%' . Request::get('name') . '%');
                        });
                    }

                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
                    }
                    
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
                        $return = $return->whereDate('submit_homework.created_at', '>=', Request::get('created_date_from'));
                    }


                    if(!empty(Request::get('created_date_to')))
                    {
                        $return = $return->whereDate('submit_homework.created_at', '<=', Request::get('created_date_to'));
                    }
        


        $return = $return->orderBy('submit_homework.id', 'desc')
                    ->paginate(20);

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



    public function getHomework()
    {
        return $this->belongsTo(Homework::class, 'homework_id');
    }


    public function getStudent()
    {
        return $this->belongsTo(User::class, 'student_id');
    }



    static public function getTotalHomework()
    {
        return self::select('submit_homework.id')->count();
    }
    

}
