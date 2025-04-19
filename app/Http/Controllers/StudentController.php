<?php

namespace App\Http\Controllers;

use App\Models\AssignStudent;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class StudentController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Student List";

        $data['getRecord'] = User::getStudent();
        return view('admin.student.list', $data);
    }


    public function add()
    {
        $data['getClass'] = ClassModel::getClass();

        $data['header_title'] = "Add New Student";
        return view('admin.student.add', $data);
    }


    public function insert(Request $request)
    {
        $request->validate([
            'email' => 'email|unique:users',
            // 'blooad_group' => 'max:10',
            // 'admission_number' => 'max:50',
            // 'roll_number' => 'max:50',
            // 'mobile_number' => 'max:15|min:8',
            // 'caste' => 'max:50',
            // 'religion' => 'max:50',
            // 'height' => 'max:10',
            // 'weight' => 'max:10'
        ]); 

        $student = new User();

        $student->user_type = 3;
        
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id;
        $student->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->file('profile_picture')))
        {
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 


            $student->profile_picture = $filename;      //For the DB Fields
        }


        // if ($request->file('profile_picture')) {
        //     $file = $request->file('profile_picture');
        //     $filename = date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/profile'),$filename);
        //     $student['profile_picture'] = $filename;
        // }


        if(!empty($request->admission_date))
        {
            $student->admission_date = $request->admission_date;
        }
        
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->status = $request->status;
        

        if(!empty($request->name) || !empty($request->last_name) || !empty($request->other_name))
        {
            $otherNameInitial = !empty($request->other_name) ? $request->other_name[0] : ''; // Check if other_name is entered

            $studentEmail = $request->name . $request->last_name . $otherNameInitial . '@cobena.com';
        }
        // $student->email = $studentEmail;
        $student->email = isset($studentEmail) ? $studentEmail : null;



        if(!empty($request->name) || !empty($request->last_name) || !empty($request->other_name))
        {
            $otherNameInitial = !empty($request->other_name) ? $request->other_name[0] : ''; // Check if other_name is entered
            
            $studentPassword = strtoupper($request->name[0] . $request->last_name . $otherNameInitial . rand(0, 999));
        }
        $student->password = Hash::make($studentPassword);
        $student->keep_track = $studentPassword;



        // $student->password = Hash::make($request->password);
        // $student->keep_track = $request->password;



        $student->save();

        return redirect()->route('student.list')->with('success', 'Student Created Successfully!');

    }



    public function edit($id)
    {
        $data['header_title'] = "Edit Student";

        $data['getRecord'] = User::getSingle($id);
        $data['getClass'] = ClassModel::getClass();

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 'School ICT')
        {
            return view('admin.student.edit', $data);
        }
        else
        {
            return view('teacher.edit_student', $data);
        }
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            // 'blooad_group' => 'max:10',
            // 'admission_number' => 'max:50',
            // 'roll_number' => 'max:50',
            // 'mobile_number' => 'max:15|min:8',
            // 'caste' => 'max:50',
            // 'religion' => 'max:50',
            // 'height' => 'max:10',
            // 'weight' => 'max:10'
        ]); 

        $student = User::getSingle($id);
        
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id;
        

        $student->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 


            $student->profile_picture = $filename;      //For the DB Fields
        }

        if(!empty($request->admission_date))
        {
            $student->admission_date = $request->admission_date;
        }
        
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->email = $request->email;
        $student->status = $request->status;


        if(!empty($request->password))
        {
            $student->keep_track = $request->password;
            
            $student->password = Hash::make($request->password);
        }
        
        $student->save();

        return redirect()->route('student.list')->with('success', 'Student Data Updated Successfully!');

    }


    //Teacher Side
    public function updateStudent(Request $request, $id)
    {
        $student = User::getSingle($id);
        
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;        

        $student->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 


            $student->profile_picture = $filename;      //For the DB Fields
        }

        if(!empty($request->admission_date))
        {
            $student->admission_date = $request->admission_date;
        }
        
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        
        $student->save();


        return redirect()->route('teacher.my_student')->with('success', 'Student Data Updated Successfully!');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('student.list')->with('warning', 'Student Deleted Successfully!');
    }


    public function myStudent()
    {

        $data['getRecord'] = User::getTeacherStudent(Auth::user()->id);

        $data['header_title'] = "My Students";
        return view('teacher.my_student', $data);
    }



 




}
