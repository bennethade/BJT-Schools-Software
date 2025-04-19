<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentAttendance extends Model
{
    use HasFactory;


    static public function checkAlreadyAttendance($student_id, $class_id, $exam_id, $attendance_date)
    {
        return StudentAttendance::where('student_id', '=', $student_id)->where('class_id', '=', $class_id)->where('exam_id', '=', $exam_id)->where('attendance_date', '=', $attendance_date)->first();
    }


    static public function getRecord()
    {
        $return =  StudentAttendance::select('student_attendances.*', 'classes.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'student.other_name as student_other_name', 'createdby.name as created_name', 'createdby.last_name as created_last_name')
                        ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
                        ->join('users as student', 'student.id', '=', 'student_attendances.student_id')
                        ->join('users as createdby', 'createdby.id', '=', 'student_attendances.created_by');

                        if(!empty(Request::get('student_id')))
                        {
                            $return = $return->where('student_attendances.student_id', '=', Request::get('student_id'));
                       
                        }


                        if(!empty(Request::get('student_name'))) {
                            $return = $return->where(function($query) {
                                $query->where('users.name', 'like', '%' . Request::get('student_name') . '%')
                                      ->orWhere('users.last_name', 'like', '%' . Request::get('student_name') . '%')
                                      ->orWhere('users.other_name', 'like', '%' . Request::get('student_name') . '%');
                            });
                        }

                        
                        // if(!empty(Request::get('student_name')))
                        // {
                        //     $return = $return->where('student.name', 'like', '%'.Request::get('student_name').'%');
                       
                        // }

                        if(!empty(Request::get('student_last_name')))
                        {
                            $return = $return->where('student.last_name', 'like', '%'.Request::get('student_last_name').'%');
                       
                        }

                        if(!empty(Request::get('class_id')))
                        {
                            $return = $return->where('student_attendances.class_id', '=', Request::get('class_id'));
                       
                        }

                        if(!empty(Request::get('attendance_from')))
                        {
                            $return = $return->whereDate('student_attendances.attendance_date', '>=', Request::get('attendance_from'));
                    
                        }



                        if(!empty(Request::get('attendance_to')))
                        {
                            $return = $return->whereDate('student_attendances.attendance_date', '<=', Request::get('attendance_to'));
                    
                        }

                        if(!empty(Request::get('attendance_type')))
                        {
                            $return = $return->where('student_attendances.attendance_type', '=', Request::get('attendance_type'));
                       
                        }

        $return = $return->orderBy('student_attendances.id', 'desc')
                        ->paginate(50);

        return $return;
    }




    static public function getRecordTeacher($class_id)
    {
        if(!empty($class_id))
        {
            $return =  StudentAttendance::select('student_attendances.*', 'classes.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'student.other_name as student_other_name', 'createdby.name as created_name', 'createdby.last_name as created_last_name')
                        ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
                        ->join('users as student', 'student.id', '=', 'student_attendances.student_id')
                        ->join('users as createdby', 'createdby.id', '=', 'student_attendances.created_by')
                        ->whereIn('student_attendances.class_id', $class_id);

            if(!empty(Request::get('student_id')))
            {
                $return = $return->where('student_attendances.student_id', '=', Request::get('student_id'));
           
            }

            
            
            if(!empty(Request::get('student_name'))) {
                $return = $return->where(function($query) {
                    $query->where('users.name', 'like', '%' . Request::get('student_name') . '%')
                          ->orWhere('users.last_name', 'like', '%' . Request::get('student_name') . '%')
                          ->orWhere('users.other_name', 'like', '%' . Request::get('student_name') . '%');
                });
            }

            if(!empty(Request::get('student_last_name')))
            {
                $return = $return->where('student.last_name', 'like', '%'.Request::get('student_last_name').'%');
           
            }

            if(!empty(Request::get('class_id')))
            {
                $return = $return->where('student_attendances.class_id', '=', Request::get('class_id'));
           
            }

            if(!empty(Request::get('attendance_from')))
            {
                $return = $return->whereDate('student_attendances.attendance_date', '>=', Request::get('attendance_from'));
        
            }



            if(!empty(Request::get('attendance_to')))
            {
                $return = $return->whereDate('student_attendances.attendance_date', '<=', Request::get('attendance_to'));
        
            }

            if(!empty(Request::get('attendance_type')))
            {
                $return = $return->where('student_attendances.attendance_type', '=', Request::get('attendance_type'));
           
            }

            $return = $return->orderBy('student_attendances.id', 'desc')
                        ->paginate(50);

            return $return;
        }
        else
        {
            return "";
        }
        
    }




    static public function getRecordStudent($student_id)
    {
        $return =  StudentAttendance::select('student_attendances.*', 'classes.name as class_name')
                    ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
                    ->where('student_attendances.student_id', '=', $student_id);


                    if(!empty(Request::get('class_id')))
                    {
                        $return = $return->where('student_attendances.class_id', '=', Request::get('class_id'));
                
                    }



                    if(!empty(Request::get('attendance_type')))
                    {
                        $return = $return->where('student_attendances.attendance_type', '=', Request::get('attendance_type'));
                
                    }


                    if(!empty(Request::get('attendance_from')))
                    {
                        $return = $return->whereDate('student_attendances.attendance_date', '>=', Request::get('attendance_from'));
                
                    }



                    if(!empty(Request::get('attendance_to')))
                    {
                        $return = $return->whereDate('student_attendances.attendance_date', '<=', Request::get('attendance_to'));
                
                    }
                    

        $return = $return->orderBy('student_attendances.id', 'desc')
                    ->paginate(50);

        return $return;
    
     
        
    }



    static public function getRecordStudentCount($student_id)
    {
        $return =  StudentAttendance::select('student_attendances.id')
                    ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
                    ->where('student_attendances.student_id', '=', $student_id)
                    ->count();

        return $return;
    
    }


    static public function getRecordStudentParentCount($student_ids)
    {
        $return =  StudentAttendance::select('student_attendances.id')
                    ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
                    ->whereIn('student_attendances.student_id', $student_ids)
                    ->count();

        return $return;
    
    }



    static public function getClassStudent($student_id)
    {
        return self::select('student_attendances.*', 'classes.name as class_name')
                    ->join('classes', 'classes.id', '=', 'student_attendances.class_id')
                    ->where('student_attendances.student_id', '=', $student_id)
                    ->groupBy('student_attendances.class_id')
                    ->get();
    
     
        
    }


    


}
