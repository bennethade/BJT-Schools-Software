<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Str;
// use Str;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(123456789));

        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
            {
                return redirect('admin/dashboard');    
            }

            elseif(Auth::user()->user_type == 'Principal')
            {
                return redirect('other_roles/dashboard');
            }

            elseif(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }

            elseif(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }

            elseif(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }

        return view('auth.login');
    }


    public function authLogin(Request $request)
    {
        // dd($request->all());

        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true))
        {
            if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
            {
                return redirect('admin/dashboard');    
            }
            elseif(Auth::user()->user_type == 'Principal')
            {
                return redirect('other_roles/dashboard');
            }

            elseif(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            
            elseif(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            
            elseif(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
            
        }
        else
        {
            return redirect()->back()->with('error', 'Please enter a correct email and password');
        }
    }

    public function forgotPassword()
    {
        return view('auth.forgot');
    }


    public function postForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        // dd($getEmailSingle);

        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Please check your email to reset your password');

        }
        else
        {
            return redirect()->back()->with('error', 'Email not found in the system');
        }

    }



    public function reset($remember_token)
    {
        // dd($token);
        $user = User::getTokenSingle($remember_token);

        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }

    }


    public function postReset(Request $request, $token)
    {

        if($request->password == $request->confirm_password)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect('/')->with('success', 'Password has been reset successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Password does not match!');
        }

    }
    


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); 


    }













}
