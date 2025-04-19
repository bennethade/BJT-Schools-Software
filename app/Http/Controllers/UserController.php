<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class UserController extends Controller
{

    public function studentLoginDetails()
    {
        $data["getRecord"] = User::studentLoginDetails();
        $data["getSetting"] = Setting::getSingle();
        return view('admin.login_details.student_details', $data);
    }


    public function teacherLoginDetails()
    {
        $data["getRecord"] = User::teacherLoginDetails();
        $data["getSetting"] = Setting::getSingle();
        return view('admin.login_details.teacher_details', $data);
    }


    public function parentLoginDetails()
    {
        $data["getRecord"] = User::parentLoginDetails();
        $data["getSetting"] = Setting::getSingle();
        return view('admin.login_details.parent_details', $data);
    }



    public function setting()
    {
        $data['getRecord'] = Setting::getSingle();
        $data['header_title'] = "Setting";
        return view('admin.setting', $data);
    }


    public function updateSetting(Request $request)
    {
        $setting                            = Setting::getSingle();
        $setting->paypal_email              = trim($request->paypal_email);
        $setting->school_name               = trim($request->school_name);
        $setting->abbreviation              = trim($request->abbreviation);
        $setting->motto                     = trim($request->motto);
        $setting->school_address            = trim($request->school_address);
        $setting->school_email_1            = trim($request->school_email_1);
        $setting->school_email_2            = trim($request->school_email_2);
        $setting->school_phone_1            = trim($request->school_phone_1);
        $setting->school_phone_2            = trim($request->school_phone_2);
        $setting->school_website            = trim($request->school_website);
        $setting->school_account_name       = trim($request->school_account_name);
        $setting->school_account_number     = trim($request->school_account_number);
        $setting->bank_name                 = trim($request->bank_name);

        // $setting->exam_description          = trim($request->exam_description);


        if(!empty($request->file('qr_code')))
        {
            $ext = $request->file('qr_code')->getClientOriginalExtension();
            $file = $request->file('qr_code');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            $setting->qr_code = $filename;
        }


        if(!empty($request->file('barcode')))
        {
            $ext = $request->file('barcode')->getClientOriginalExtension();
            $file = $request->file('barcode');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            // $file = Image::read($request->file('barcode'));     //Image Intervention Lines
            // $file->resize(300, 200);
            // $file->save('upload/setting/'.$filename); 

            $setting->barcode = $filename;
        }


        if(!empty($request->file('logo')))
        {
            $ext = $request->file('logo')->getClientOriginalExtension();
            $file = $request->file('logo');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            $setting->logo = $filename;
        }


        if(!empty($request->file('seal')))
        {
            $ext = $request->file('seal')->getClientOriginalExtension();
            $file = $request->file('seal');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            $setting->seal = $filename;
        }


        if(!empty($request->file('trophy')))
        {
            $ext = $request->file('trophy')->getClientOriginalExtension();
            $file = $request->file('trophy');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            $setting->trophy = $filename;
        }


        if(!empty($request->file('favicon_icon')))
        {
            $ext = $request->file('favicon_icon')->getClientOriginalExtension();
            $file = $request->file('favicon_icon');
            $randomStr = date('Ymdhis').Str::random(10);
            $favicon = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $favicon); 

            $setting->favicon_icon = $favicon;
        }

        
        if(!empty($request->file('accountant_signature')))
        {
            $ext = $request->file('accountant_signature')->getClientOriginalExtension();
            $file = $request->file('accountant_signature');
            $randomStr = date('Ymdhis').Str::random(10);
            $acc_sign = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/setting/', $acc_sign); 

            $file = Image::read($request->file('accountant_signature'));     //Image Intervention Lines
            $file->resize(100, 100);
            $file->save('upload/setting/'.$acc_sign); 

            $setting->accountant_signature = $acc_sign;
        }


        if(!empty($request->file('head_of_school_signature')))
        {
            $ext = $request->file('head_of_school_signature')->getClientOriginalExtension();
            $file = $request->file('head_of_school_signature');
            $randomStr = date('Ymdhis').Str::random(10);
            $hos = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/setting/', $hos); 

            $file = Image::read($request->file('head_of_school_signature'));     //Image Intervention Lines
            $file->resize(100, 100);
            $file->save('upload/setting/'.$hos); 

            $setting->head_of_school_signature = $hos;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Setting Updated Successfully!');
    }


    public function myAccount()
    {
        // $data['getRecord'] = User::findOrFail(Auth::user()->id);
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return view('admin.my_account', $data);
        }

        elseif(Auth::user()->user_type == 'Principal' || Auth::user()->user_type == 'Vice Principal')
        {
            return view('teacher.my_account', $data);
        }

        elseif(Auth::user()->user_type == 2)
        {
            return view('teacher.my_account', $data);
        }
        elseif(Auth::user()->user_type == 3)
        {
            return view('student.my_account', $data);
        }
        elseif(Auth::user()->user_type == 4)
        {
            return view('parent.my_account', $data);
        }

        
    }


    public function updateMyAdminAccount(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        
        $admin = User::getSingle($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->back()->with('success', 'Account Updated Successfully!');

    } 



    public function updateMyAccount(Request $request)
    {   
        $id = Auth::user()->id;

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            // 'mobile_number' => 'max:15|min:8',
            // 'marital_status' => 'max:50'
        ]); 

        $user = User::getSingle($id);
        
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->other_name = $request->other_name;
        $user->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $user->date_of_birth = $request->date_of_birth;
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

            $user->profile_picture = $filename;     //For the DB Field
        }
        
        $user->marital_status = $request->marital_status;
        $user->mobile_number = $request->mobile_number;
        $user->address = $request->address;
        $user->permanent_address = $request->permanent_address;
        $user->qualification = $request->qualification;
        $user->work_experience = $request->work_experience;
                
        $user->save();

        return redirect()->back()->with('success', 'Account Updated Successfully!');

    }



    public function updateMyStudentAccount(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            // 'mobile_number' => 'max:15|min:8',            
            // 'blooad_group' => 'max:10',
            // 'caste' => 'max:50',
            // 'religion' => 'max:50',
            // 'height' => 'max:10',
            // 'weight' => 'max:10'
        ]); 

        $user = User::getSingle($id);
        
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->other_name = $request->other_name;
        $user->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $user->date_of_birth = $request->date_of_birth;
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

            $user->profile_picture = $filename;     //For the DB Field
        }
        
        $user->address = $request->address;
        $user->mobile_number = $request->mobile_number;        
        $user->caste = $request->caste;
        $user->religion = $request->religion;
        $user->blood_group = $request->blood_group;
        $user->height = $request->height;
        $user->weight = $request->weight;
                
        $user->save();

        return redirect()->back()->with('success', 'Account Updated Successfully!');

    }


    public function updateMyParentAccount(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            // 'occupation' => 'max:255',
            // 'mobile_number' => 'max:15|min:8',
            // 'address' => 'max:255',
            
        ]); 

        $parent = User::getSingle($id);
        
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

            $parent->profile_picture = $filename;     //For the DB Field
        }

        
        $parent->mobile_number = $request->mobile_number;
        $parent->email = $request->email;
        
        $parent->save();

        return redirect()->back()->with('success', 'Account Updated Successfully!');


    }




    public function changePassword()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }


    public function updatePassword(Request $request)
    {
        // dd($request->all());

        $user = User::getSingle(Auth::user()->id);

       $new_password = $request->new_password;
       $confirm_password = $request->confirm_password;


        if(Hash::check($request->old_password, $user->password))
        {
            if($new_password == $confirm_password)
            {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', "Password Changed Successfully!");
            }
            else{
                return redirect()->back()->with('error', "Passwords do not match");
            }

        }
        else
        {
            return redirect()->back()->with('error', "Old password is not correct");
        }

    }






}
