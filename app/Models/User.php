<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function getSingleClass($id)
    {
        return self::select('users.*', 'classes.amount', 'classes.name as class_name')
                    ->join('classes', 'classes.id', 'users.class_id')
                    ->where('users.id', '=', $id)
                    ->first();
    }



    static public function getTotalAdmin()
    {
        return self::select('users.id')
                        ->where('user_type', '=', 1)
                        ->orWhere('user_type', '=', 'Super Admin')
                        ->orWhere('user_type', '=', 'School Admin')
                        ->where('is_delete', '=', 0)
                        ->count();

    }


    static public function getTotalUser($user_type)
    {
        return self::select('users.id')
                        ->where('user_type', '=', $user_type)
                        ->where('is_delete', '=', 0)
                        ->count();

    }



    //This is used on the SEND EMAIL page to search for users
    static public function searchUser($search)
    {
        $return = self::select('users.*')
                ->where(function($query) use ($search){
                $query->where('users.name', 'like', '%'.$search.'%')
                ->orWhere('users.last_name', 'like', '%'.$search.'%')
                ->orWhere('users.other_name', 'like', '%'.$search.'%');
            })
            ->limit(10)
            ->get();

        return $return;
    }
    //End SEND EMAIL page to search for users




    static public function getAdmin()
    {
        $return = self::select('users.*')
                        ->where('user_type', '=', 1)->orWhere('user_type', '=', 'School Admin')->orWhere('user_type', '=', 'Super Admin')
                        ->where('is_delete', '=', 0);


                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('name', 'like', '%' . Request::get('name'). '%');
                        }
                        
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('email', 'like', '%' . Request::get('email'). '%');
                        }

                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('created_at', '=', Request::get('date'));
                        }
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('name', 'asc')
                        ->paginate(20);

        return $return;
    }


    static public function getParent()
    {
        $return = self::select('users.*')
                        ->where('user_type', '=', 4)
                        // ->orWhere('user_type', '=', 'Parent')
                        ->where('is_delete', '=', 0);

                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('name'))) {
                            $return = $return->where(function($query) {
                                $query->where('users.name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.last_name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.other_name', 'like', '%' . Request::get('name') . '%');
                            });
                        }

                        // if(!empty(Request::get('last_name')))
                        // {
                        //     $return = $return->where('users.name', 'like', '%' . Request::get('last_name'). '%')->orWhere('users.last_name', 'like', '%' . Request::get('last_name'). '%')->orWhere('users.other_name', 'like', '%' . Request::get('last_name'). '%') ;
                        // }
                        
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
                        }


                        if(!empty(Request::get('gender')))
                        {
                            $return = $return->where('users.gender', '=', Request::get('gender'));
                        }


                        if(!empty(Request::get('mobile_number')))
                        {
                            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number'). '%');
                        }
                        
                        
                        if(!empty(Request::get('address')))
                        {
                            $return = $return->where('users.address', 'like', '%' . Request::get('address'). '%');
                        }


                        if(!empty(Request::get('occupation')))
                        {
                            $return = $return->where('users.occupation', 'like', '%' . Request::get('occupation'). '%');
                        }

                        
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
                        }

                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->where('users.status', '=', $status);
                        }
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('name', 'asc')
                        ->paginate(100);

        return $return;
    }



    static public function getTeacher()
    {
        $return = self::select('users.*')
                         // ->where('users.user_type', '=', 2) //USER_TYPE === 2 IS FOR TEACHERS
                         ->where('users.user_type', '!=', 'Super Admin')
                         ->Where('user_type', '!=', 'School Admin')
                         ->Where('user_type', '!=', 3)
                         ->Where('user_type', '!=', 'Student')
                         ->Where('user_type', '!=', 4)
                         ->Where('user_type', '!=', 'Parent');
                         // ->where('users.is_delete', '=', 0);

                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('name'))) {
                            $return = $return->where(function($query) {
                                $query->where('users.name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.last_name', 'like', '%' . Request::get('name') . '%')
                                      ->orWhere('users.other_name', 'like', '%' . Request::get('name') . '%');
                            });
                        }

                        // if(!empty(Request::get('last_name')))
                        // {
                        //     $return = $return->where('users.name', 'like', '%' . Request::get('last_name'). '%')->orWhere('users.last_name', 'like', '%' . Request::get('last_name'). '%')->orWhere('users.other_name', 'like', '%' . Request::get('last_name'). '%') ;
                        // }
                        
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email', 'like', '%' . Request::get('email'). '%');
                        }


                        if(!empty(Request::get('gender')))
                        {
                            $return = $return->where('users.gender', '=', Request::get('gender'));
                        }


                        if(!empty(Request::get('mobile_number')))
                        {
                            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number'). '%');
                        }
                        
                        
                        if(!empty(Request::get('marital_status')))
                        {
                            $return = $return->where('users.address', 'like', '%' . Request::get('address'). '%');
                        }


                        if(!empty(Request::get('address')))
                        {
                            $return = $return->where('users.address', 'like', '%' . Request::get('address'). '%');
                        }


                        if(!empty(Request::get('admission_date')))
                        {
                            $return = $return->where('users.admission_date', 'like', '%' . Request::get('admission_date'). '%');
                        }

                        
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
                        }

                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->where('users.status', '=', $status);
                        }
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('name', 'asc')
                        ->paginate(100);

        return $return;
    }



    static public function getTeacherClass()
    {
        $return = self::select('users.*')
                        ->where('users.user_type', '=', 2)
                        ->where('users.is_delete', '=', 0);

        $return = $return->orderBy('name', 'asc')
                        ->get();

        return $return;
    }


    static public function getCollectFeesStudent()
    {
        $return = self::select('users.*', 'classes.name as class_name', 'classes.amount as amount')
                        ->join('classes', 'classes.id', '=', 'users.class_id')
                        ->where('users.user_type', '=', 3)
                        ->where('users.is_delete', '=', 0);

                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('class_id')))
                        {
                            $return = $return->where('classes.id', 'like', '%' . Request::get('class_id'). '%');
                        }

                        if(!empty(Request::get('student_id')))
                        {
                            $return = $return->where('users.id', 'like', '%' . Request::get('student_id'). '%');
                        }

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
                        
                        
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('users.name', 'asc')
                        ->paginate(100);

        return $return;
    }





    static public function getStudent()
    {
        $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                        ->join('classes', 'classes.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type', '=', 3);
                        // ->where('users.is_delete', '=', 0);
                        // ->where('users.status', '=', 0);

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

                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->where('users.status', '=', $status);
                        }

                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('users.name', 'asc')
                        ->paginate(100);

        return $return;
    }



    static public function getUser($user_type)
    {
        return User::select('users.*')
                    ->where('user_type', '=', $user_type)
                    ->where('is_delete',0)
                    ->get();
    }




    ///===TUTOR'S FUNCTION====///
    // static public function getStudentClass($class_id)
    // {
    //     return self::select('users.id', 'users.name', 'users.last_name', 'users.other_name')
    //                     ->where('users.user_type', '=', 3)
    //                     ->where('users.is_delete', '=', 0)
    //                     ->where('users.class_id', '=', $class_id)
    //                     ->orderBy('users.name', 'asc')
    //                     ->get();
    // }


    
    // static public function getStudentClass($class_id)
    // {
    //     ///===MY FUNCTION===///
    //     return self::select('users.*', 'classes.name as class_name')
    //                 ->join('assign_students', 'assign_students.student_id', '=', 'users.id')
    //                 ->join('classes', 'classes.id', '=', 'assign_students.class_id')//This line was Added newly while coding ID Card Module
    //                 ->where('assign_students.class_id', '=', $class_id)
    //                 ->where('users.user_type', '=', 3)
    //                 ->where('users.is_delete', '=', 0)
    //                 ->orderBy('users.name', 'asc')
    //                 ->get();                  
    // }


    static public function getStudentClass($class_id, $exam_id)
    {
        ///===MY FUNCTION===///
        return self::select('users.*', 'classes.name as class_name')
                    ->join('assign_students', 'assign_students.student_id', '=', 'users.id')
                    ->join('classes', 'classes.id', '=', 'assign_students.class_id')//This line was Added newly while coding ID Card Module
                    ->where('assign_students.class_id', '=', $class_id)
                    ->where('assign_students.exam_id', '=', $exam_id)
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0)
                    ->orderBy('users.name', 'asc')
                    ->get();                  
    }


    static public function getStudentClassIDCard($class_id, $exam_id)
    {
        ///===MY FUNCTION===///
        return self::select('users.*', 'classes.name as class_name')
                    ->join('assign_students', 'assign_students.student_id', '=', 'users.id')
                    ->join('classes', 'classes.id', '=', 'assign_students.class_id')//This line was Added newly while coding ID Card Module
                    ->where('assign_students.class_id', '=', $class_id)
                    ->where('assign_students.exam_id', '=', $exam_id)
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0)
                    ->orderBy('users.name', 'asc')
                    ->get();                  
    }



    static public function getTeacherStudent($teacher_id)
    {
        $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                        ->join('classes', 'classes.id', '=', 'users.class_id')
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



    static public function getTeacherStudentCount($teacher_id)
    {
        $return = self::select('users.id')
                        ->join('classes', 'classes.id', '=', 'users.class_id')
                        ->join('assign_class_teachers', 'assign_class_teachers.class_id', '=', 'classes.id')
                        ->where('assign_class_teachers.teacher_id', '=', $teacher_id)
                        ->where('assign_class_teachers.status', '=', 0)
                        ->where('users.user_type', '=', 3)
                        ->where('users.is_delete', '=', 0)
                        // ->groupBy('users.id')
                        ->count();

        return $return;
    }


    static public function getSearchStudent()
    {
        // dd(Request::all());

        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('other_name')) || !empty(Request::get('email')) || !empty(Request::get('admission_number')) || !empty(Request::get('roll_number')) || !empty(Request::get('gender')) || !empty(Request::get('religion')))
        {
            $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                        ->join('classes', 'classes.id', '=', 'users.class_id', 'left')
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

                        if(!empty(Request::get('gender')))
                        {
                            $return = $return->where('users.gender', 'like', '%' . Request::get('gender'). '%');
                        }

                        if(!empty(Request::get('religion')))
                        {
                            $return = $return->where('users.religion', 'like', '%' . Request::get('religion'). '%');
                        }

                        
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('users.name', 'asc')
                        ->limit(50)
                        ->get();

        return $return;   
        }

    }

    


    static public function getMyStudent($parent_id)
    {
        $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                        ->join('classes', 'classes.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type', '=', 3)
                        ->where('users.parent_id', '=', $parent_id)
                        ->where('users.is_delete', '=', 0)
                        ->orderBy('users.name', 'asc')
                        ->get();

        return $return;
    }
    



    static public function getParentStudents($class_id, $exam_id, $parent_id)
    {//////USED FOR STUDENT RESULTS IN PARENT DASHBOARD
        $return = self::select('users.*', 'classes.id as class_id', 'classes.name as class_name', 'parent.name as parent_name')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                        ->join('assign_students','assign_students.student_id', '=', 'users.id')
                        ->join('classes', 'classes.id', '=', 'assign_students.class_id')
                        ->join('exams', 'exams.id', '=', 'assign_students.exam_id')
                        ->where('users.user_type', '=', 3)
                        ->where('assign_students.class_id', '=', $class_id)
                        ->where('assign_students.exam_id', '=', $exam_id)
                        ->where('parent.id', '=', $parent_id)
                        ->where('users.is_delete', '=', 0)
                        ->orderBy('users.name', 'asc')
                        ->get();

        return $return;
    }





    static public function getMyStudentIds($parent_id)
    {
        $return = self::select('users.id')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                ->join('classes', 'classes.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.parent_id', '=', $parent_id)
                ->where('users.is_delete', '=', 0)
                ->orderBy('users.name', 'asc')
                ->get();

        $student_ids = array();
        foreach($return as $value)
        {
            $student_ids[] = $value->id;
        }
        return $student_ids;
    }


    static public function getMyStudentClassIds($parent_id)
    {
        $return = self::select('users.class_id')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                ->join('classes', 'classes.id', '=', 'users.class_id')
                ->where('users.user_type', '=', 3)
                ->where('users.parent_id', '=', $parent_id)
                ->where('users.is_delete', '=', 0)
                ->orderBy('users.name', 'asc')
                ->get();

        $class_ids = array();
        foreach($return as $value)
        {
            $class_ids[] = $value->class_id;
        }
        return $class_ids;
    }


    static public function getMyStudentCount($parent_id)
    {
        $return = self::select('users.*')
                        ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                        ->join('classes', 'classes.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type', '=', 3)
                        ->where('users.parent_id', '=', $parent_id)
                        ->where('users.is_delete', '=', 0)
                        ->count();

        return $return;
    }



    static public function getPaidAmount($student_id, $class_id)
    {
        return StudentFees::getPaidAmount($student_id, $class_id);
    }



    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
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



    static public function getAttendance($student_id, $class_id, $exam_id, $attendance_date)
    {
        return StudentAttendance::checkAlreadyAttendance($student_id, $class_id, $exam_id, $attendance_date);
    }


    static public function getBehaviorChart($student_id, $exam_id, $class_id)
    {
        return BehaviorChart::checkAlreadyBehaviorChart($student_id, $exam_id, $class_id);
    }

    
    static public function getStudentSubject($class_id, $exam_id, $student_id)
    {//MINE (Not working yet)
        return StudentSubject::getStudentSubject($class_id, $exam_id, $student_id);
    }


    static public function studentLoginDetails()
    {
        return self::select('users.*')
                    ->where('users.user_type', '=' ,3)
                    ->orderBy('name', 'asc')
                    ->get();
    }

    static public function teacherLoginDetails()
    {
        return self::select('users.*')
                    ->where('users.user_type', '=' ,2)
                    ->orderBy('name', 'asc')
                    ->get();
    }


    static public function parentLoginDetails()
    {
        return self::select('users.*')
                    ->where('users.user_type', '=' ,4)
                    ->orderBy('name', 'asc')
                    ->get();
    }




    ///CALCULTATE BIRTHDAY

    public static function birthdayCalculation($student_id){
        $user = User::find($student_id);
        if ($user) {
            $dateOfBirth = $user->date_of_birth; 

            $diff = strtotime('now') - strtotime($dateOfBirth);
            
            $age = floor($diff / (60 * 60 * 24 * 365.25));
            $integerAge  = (int)$age;

        } 
        else 
        {
            '';
        }

        return $integerAge;

    }
    



    static public function sendReportCardToEmail($parent_id)
    {
        //NOT WORKING AND NOT IN USE YET
        $return = self::select('users.email')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                ->where('users.user_type', '=', 4)
                ->where('users.parent_id', '=', $parent_id)
                ->get();

        $parent_emails = array();
        foreach($return as $value)
        {
            $parent_emails[] = $value->email;
        }
        return $parent_emails;
    }
    


   









}
