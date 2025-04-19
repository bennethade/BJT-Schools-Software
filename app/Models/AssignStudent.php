<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignStudent extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function checkAlreadyExiting($class_id, $exam_id, $student_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('student_id', $student_id)->first();
    }


    static public function checkAuthStudentData($student_id)
    {
        return self::where('student_id', $student_id)->where('lock_student', 0)->first();
    }



    static public function getSearchStudent()
    {
        // dd(Request::all());

        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('other_name')) || !empty(Request::get('email')))
        {
            $return = User::select('users.*', 'classes.name as class_name', 'parent.name as parent_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                        ->join('classes', 'classes.id', '=', 'assign_students.class_id', 'left')
                        ->where('users.user_type', '=', 3)
                        ->where('users.is_delete', '=', 0);

                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('id')))
                        {
                            $return = $return->where('users.id', '=', Request::get('id'));
                        }


                        if(!empty(Request::get('name'))) {
                            $return = $return->where(function($query) {
                                $query->where('users.name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.last_name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.other_name', 'like', '%' . Request::get('name') . '%');
                            });
                        }


                        // if(!empty(Request::get('name')))
                        // {
                        //     $return = $return->where('users.name', 'like', '%' . Request::get('name'). '%');
                        // }

                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name'). '%');
                        }
                        
                        if(!empty(Request::get('other_name')))
                        {
                            $return = $return->where('users.other_name', 'like', '%' . Request::get('other_name'). '%');
                        }
                        
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
                        }

                        
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('users.name', 'asc')
                        ->limit(50)
                        ->get();

        return $return;   
        }

    }



    static public function getAssignedClassStudent($class_id, $exam_id)
    {
        $return = self::select('assign_students.*', 'parent.name as parent_name', 'classes.name as class_name', 'users.id as student_id', 'users.name as user_name', 'users.last_name as user_last_name', 'users.other_name as user_other_name', 'users.email as email', 'users.admission_number as admission_number', 'users.roll_number as roll_number', 'users.gender as gender', 'users.religion as religion', 'users.mobile_number as mobile_number', 'users.keep_track as keep_track', 'users.date_of_birth as date_of_birth', 'users.admission_date as admission_date')
                        ->join('users', 'users.id', '=', 'assign_students.student_id')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                        ->join('classes', 'classes.id', '=', 'assign_students.class_id')
                        ->join('exams', 'exams.id', '=', 'assign_students.exam_id', 'left')
                        ->where('users.user_type', '=', 3)
                        ->where('assign_students.class_id', '=', $class_id)
                        ->where('assign_students.exam_id', '=', $exam_id)
                        ->where('users.is_delete', '=', 0)
                        ->orderBy('users.last_name', 'asc')
                        ->paginate(50);

        return $return;
        
    }



    static public function getNurseryGoalClassStudent($class_id, $exam_id)
    {
        return self::select(
                'assign_students.*',
                'users.id as student_id',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.other_name as user_other_name',
                
            )
            ->join('users', 'users.id', '=', 'assign_students.student_id')
            ->leftJoin('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('classes', 'classes.id', '=', 'assign_students.class_id')
            ->leftJoin('exams', 'exams.id', '=', 'assign_students.exam_id')
            ->where('users.user_type', '=', 3)
            ->where('assign_students.class_id', '=', $class_id)
            ->where('assign_students.exam_id', '=', $exam_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.name', 'asc')
            ->get();
    }




    static public function getTeacherStudent($teacher_id)
    {
        //USED FOR 'MY STUDENTS' IN TEACHER DASHBOARD
        $return = self::select('assign_students.*', 'classes.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                        // ->join()
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                        ->join('classes', 'classes.id', '=', 'assign_students.class_id')
                        ->join('assign_class_teachers', 'assign_class_teachers.class_id', '=', 'classes.id')
                        ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                        ->where('assign_class_teachers.status', '=', 0)
                        ->where('users.user_type', '=', 3)
                        ->where('users.is_delete', '=', 0)
                        ->where('users.status', '=', 0);



                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('name'))) {
                            $return = $return->where(function($query) {
                                $query->where('users.name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.last_name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.other_name', 'like', '%' . Request::get('name') . '%');
                            });
                        }

                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name'). '%');
                        }
                        
                        if(!empty(Request::get('other_name')))
                        {
                            $return = $return->where('users.other_name', 'like', '%' . Request::get('other_name'). '%');
                        }
                        
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
                        }

                        if(!empty(Request::get('admission_number')))
                        {
                            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number'). '%');
                        }

                        if(!empty(Request::get('roll_number')))
                        {
                            $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number'). '%');
                        }

                        if(!empty(Request::get('class')))
                        {
                            $return = $return->where('classes.name', 'like', '%' . Request::get('class'). '%');
                        }

                        if(!empty(Request::get('gender')))
                        {
                            $return = $return->where('users.gender', '=', Request::get('gender'));
                        }

                        if(!empty(Request::get('caste')))
                        {
                            $return = $return->where('users.caste', 'like', '%' . Request::get('caste'). '%');
                        }

                        if(!empty(Request::get('religion')))
                        {
                            $return = $return->where('users.religion', 'like', '%' . Request::get('religion'). '%');
                        }

                        if(!empty(Request::get('mobile_number')))
                        {
                            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number'). '%');
                        }

                        if(!empty(Request::get('blood_group')))
                        {
                            $return = $return->where('users.blood_group', 'like', '%' . Request::get('blood_group'). '%');
                        }


                        if(!empty(Request::get('admission_date')))
                        {
                            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
                        }

                        
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
                        }

                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('users.name', 'asc')
                        ->groupBy('users.id')
                        ->paginate(100);

        return $return;
    }



    static public function getSingleExamName($exam_id)
    {
        //USED IN THE FEES BREAKDOWN PAGE (feesBreakdown function) IN FEESCOLLECTION CONTROLLER
        return self::select('assign_students.*', 'exams.name as exam_name', 'exams.session as exam_session', 'exams.this_term_ends as this_term_ends')
                    ->join('exams', 'exams.id', '=', 'assign_students.exam_id')
                    ->where('assign_students.exam_id', '=', $exam_id)
                    ->first();
    }


    static public function getExamName($student_id)
    {
        return self::select('assign_students.*', 'exams.name as exam_name', 'exams.session as exam_session')
                    ->join('exams', 'exams.id', '=', 'assign_students.exam_id')
                    ->where('assign_students.student_id', '=', $student_id)
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


    public static function AssignedStudent($class_id, $exam_id, $student_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('student_id', $student_id);
    }


    static public function getPaidAmount($student_id, $class_id)
    {
        return StudentFees::getPaidAmount($student_id, $class_id);
    }


    static public function promotionClassAndExamID($class_id, $exam_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->get();
    }




    static public function getStudentClass($exam_id, $student_id)
    {
        return self::select('assign_students.*', 'classes.name as class_name', 'classes.section as class_section', 'classes.description as class_description')
                    ->join('classes', 'classes.id', '=', 'assign_students.class_id')
                    ->join('exams', 'exams.id', '=', 'assign_students.exam_id')
                    ->where('assign_students.exam_id', $exam_id)
                    ->where('assign_students.student_id', $student_id)
                    ->first();
    }



    static public function getStudentParent($student_id)
    {
        return self::select('assign_students.*', 'parents.title as parent_title', 'parents.name as parent_name', 'parents.last_name as parent_last_name', 'parents.other_name as parent_other_name')
                    ->join('users', 'users.id', '=', 'assign_students.student_id')
                    ->join('users as parents', 'parents.id', '=', 'users.parent_id')
                    ->where('assign_students.student_id', '=', $student_id)
                    ->first();
    }




}
