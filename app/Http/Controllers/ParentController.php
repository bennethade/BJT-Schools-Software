<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class ParentController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Parent List";

        $data['getRecord'] = User::getParent();
        return view('admin.parent.list', $data);
    }


    public function add()
    {
        $data['header_title'] = "Add New Parent";

        return view('admin.parent.add', $data);
    }



    public function insert(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            // 'address' => 'max:255',
            // 'occupation' => 'max:255',
        ]); 

        $parent = new User();

        $parent->user_type = 4;
        $parent->keep_track = $request->password;
        
        $parent->title = $request->title;
        $parent->name = $request->name;
        $parent->last_name = $request->last_name;
        $parent->other_name = $request->other_name;
        $parent->gender = $request->gender;
        $parent->occupation = $request->occupation;
        $parent->address = $request->address;


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


            $parent->profile_picture = $filename;        //For the DB Fields
        }


        // if ($request->file('profile_picture')) {
        //     $file = $request->file('profile_picture');
        //     $filename = date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/profile'),$filename);
        //     $parent['profile_picture'] = $filename;
        // }


        
        $parent->mobile_number = $request->mobile_number;
        $parent->status = $request->status;


        $parent->email = $request->email;


        if(!empty($request->name) || !empty($request->last_name) || !empty($request->other_name))
        {
            $otherNameInitial = !empty($request->other_name) ? $request->other_name[0] : ''; // Check if other_name is entered
            
            $parentPassword = strtoupper($request->name[0] . $request->last_name . $otherNameInitial . rand(0, 999));
        }
        
        $parent->password = Hash::make($parentPassword);
        $parent->keep_track = $parentPassword;



        // $parent->password = Hash::make($request->password);
        
        $parent->save();

        return redirect()->route('parent.list')->with('success', 'Parent Created Successfully!');

    }


    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        $data['header_title'] = "Edit Parent";
        return view('admin.parent.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'occupation' => 'max:255',
            'mobile_number' => 'max:15|min:8',
            'address' => 'max:255',
            
        ]); 

        $parent = User::getSingle($id);
        
        $parent->title = $request->title;
        $parent->name = $request->name;
        $parent->last_name = $request->last_name;
        $parent->other_name = $request->other_name;
        $parent->occupation = $request->occupation;
        $parent->address = $request->address;
        $parent->gender = $request->gender;


        if(!empty($request->file('profile_picture')))
        {
            if(!empty($parent->getProfile()))
            {
                unlink('upload/profile/'.$parent->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 


            $parent->profile_picture = $filename;        //For the DB Fields
        }

        
        $parent->mobile_number = $request->mobile_number;
        $parent->status = $request->status;
        $parent->email = $request->email;

        if(!empty($request->password))
        {
            $parent->keep_track = $request->password;
            
            $parent->password = Hash::make($request->password);
        }
        
        $parent->save();

        return redirect()->route('parent.list')->with('success', 'Parent Updated Successfully!');

    }



    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('parent.list')->with('warning', 'Parent Deleted Successfully!');
    }


    public function myStudent($id)
    {
        $data['header_title'] = "Parent Student List";

        $data['getParent'] = User::getSingle($id);
        $data['parent_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        return view('admin.parent.my_student', $data);
    }

    

    public function assignStudentToParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();

        return redirect()->back()->with('success', 'Student Assigned Successfully!');
    }


    public function deleteAssignStudentToParent($student_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = null;
        $student->save();

        return redirect()->back()->with('success', 'Deleted Assigned Student!');
    }


    //PARENT DASHBOARD FUNCTIONS
    public function myStudentParentSide()
    {
        $id = Auth::user()->id;

        $data['getRecord'] = User::getMyStudent($id);

        $data['header_title'] = "My Student";
        return view('parent.my_student', $data); 
    }


    public function myStudentFeesParentSide(Request $request)
    {
        $parent_id = Auth::user()->id;

        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('exam_id')))
        {
            $data['getRecord'] = User::getMyStudent($parent_id);
        }

    
        $data['header_title'] = "Student Fees";
        return view('parent.my_student_fees', $data); 
    }




}
