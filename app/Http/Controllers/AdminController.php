<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class AdminController extends Controller
{
    
    public function list()
    {
        $data['header_title'] = "Admin List";

        // $data['getRecord'] = User::where('user_type', 1)->Where('is_delete', 0)->orderBy('id','desc')->paginate(4);
        $data['getRecord'] = User::getAdmin();
        
        return view('admin.admin.list', $data);
    }


    public function add()
    {
        $data['header_title'] = "Add New Admin";

        return view('admin.admin.add', $data);
    }


    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        // $user->user_type = 1;
        $user->user_type = $request->user_type;
        $user->keep_track = $request->password;
        $user->password = Hash::make($request->password);

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

            $user->profile_picture = $filename;     //For the DB Field
        }
        
        $user->save();

        return redirect()->route('admin.list')->with('success', 'Admin Successfully Created!');
    }


    public function edit($id)
    {
        $data['header_title'] = "Edit Admin";
        $data['getRecord'] = User::getSingle($id);

        return view('admin.admin.edit', $data);

    }



    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        if(!empty($request->password))
        {
            $user->keep_track = $request->password;
            $user->password = Hash::make($request->password);
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($user->getProfile()))
            {
                unlink('upload/profile/'.$user->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 

            $user->profile_picture = $filename;
        }


        $user->save();
        

        return redirect()->route('admin.list')->with('success', 'Admin Details Successfully Updated!');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // $user->is_delete = 1;
        // $user->save();
        return redirect()->route('admin.list')->with('warning', 'Admin Deleted Successfully!');
    }



    public function designationList()
    {
        $data['getRecord'] = Designation::get();

        $data['header_title'] = "Designation List";
        return view('admin.designation.list', $data);
    }


    public function designationAdd()
    {
        $data['header_title'] = "Add Designation";
        return view('admin.designation.add', $data);
    }



    public function designationInsert(Request $request)
    {
        $designation = new Designation;
        $designation->name = $request->name;
        $designation->save();

        return redirect()->route('designation.list')->with('success', 'Designation Inserted Successfully!');
    }



    public function designationEdit($id)
    {
        $data['getRecord'] = Designation::findOrFail($id);

        $data['header_title'] = "Edit Designation";
        return view('admin.designation.edit', $data);
    }


    public function designationUpdate(Request $request, $id)
    {
        $designation = Designation::findOrFail($id);
        $designation->name = $request->name;
        $designation->save();

        return redirect()->route('designation.list')->with('success', 'Designation Updated Successfully!');
    }



    public function designationDelete($id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();

        return redirect()->route('designation.list')->with('warning', 'Designation Deleted Successfully!');
    }







}
