<?php

namespace App\Http\Controllers;

use App\Models\Humanresource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class HumanresourceController extends Controller
{
    public function leaveList()
    {
        $data['header_title'] = "Procurement List";
        $data['getRecord'] = Humanresource::getRecord();
        
        return view('admin.humanresource.leave_list', $data);
    }



    public function leaveAdd()
    {
        $data['getTeacher'] = User::getTeacher();
        $data['header_title'] = "Add Staff Leave";
        
        return view('admin.humanresource.add_leave', $data);
    }


    public function leaveStore(Request $request)
    {
        // dd($request->all());

        $leave = new Humanresource();
        $leave->staff_id = $request->staff_id;
        $leave->leave_purpose = $request->leave_purpose;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->status = $request->status;
        $leave->created_by = Auth::user()->id;
        

        if(!empty($request->file('document')))
        {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file = $request->file('document');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('document'));     //Image Intervention Lines
            $file->resize(500, 400);
            $file->save('upload/leave_document/' . $filename); 


            $leave->document = $filename;        //For the DB Field
        }

        $leave->save();

        return redirect()->route('employee.leave.list')->with('success', 'Leave Submitted Successfully!');
 
    }

    public function leaveEdit($id)
    {
        $data['getTeacher'] = User::getTeacher();
        $data['getRecord'] = Humanresource::findOrFail($id);

        $data['header_title'] = "Edit Leave";       
        return view('admin.humanresource.edit_leave', $data);
    }


    public function leaveUpdate(Request $request, $id)
    {
        $leave = Humanresource::findOrFail($id);
        $leave->staff_id = $request->staff_id;
        $leave->leave_purpose = $request->leave_purpose;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->status = $request->status;

        if(!empty($request->file('document')))
        {
            if(!empty($leave->document))
            {
                unlink('upload/leave_document/' . $leave->document);
            }

            $ext = $request->file('document')->getClientOriginalExtension();
            $file = $request->file('document');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('document'));     //Image Intervention Lines
            $file->resize(500, 400);
            $file->save('upload/leave_document/' . $filename); 


            $leave->document = $filename;        //For the DB Fields
        }

        $leave->save();

        return redirect()->route('employee.leave.list')->with('success', 'Leave Updated Successfully!');

    }


    public function leaveDelete($id)
    {
        $leave = Humanresource::findOrFail($id);
        $leave->delete();

        return redirect()->back()->with('warning', 'Leave Deleted Successfully!');
    }



    public function leaveRequests()
    {
        $data['getRecord'] = Humanresource::getLeaveRequests();

        return view('admin.humanresource.leave_requests', $data);
    }


    public function leaveRequestApprove($id)
    {
        $data = Humanresource::findOrFail($id);
        $data->status = 'Approved';
        $data->save();
        
        return redirect()->back()->with('success', 'Leave Request Approved Successfully!');
    }


    public function leaveRequestReject($id)
    {
        $data = Humanresource::findOrFail($id);
        $data->status = 'Rejected';
        $data->save();
        
        return redirect()->back()->with('warning', 'Leave Request Has Been Rejected!');
    }







    ////===FOR TEACHER DASHBOARD====////
    public function teacherLeaveList()
    {
        $data['getRecord'] = Humanresource::getTeacherLeave(Auth::user()->id);

        $data['header_title'] = "Leave List";
        return view('teacher.leave.leave_list', $data);
    }



    public function teacherLeaveRequest()
    {
        $data['header_title'] = "Leave Request";
        return view('teacher.leave.leave_request', $data);
    }


    public function teacherLeaveRequestStore(Request $request)
    {
        $leave = new Humanresource();
        $leave->staff_id = Auth::user()->id;
        $leave->leave_purpose = $request->leave_purpose;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->status = "Pending";
        $leave->created_by = Auth::user()->id;
        

        if(!empty($request->file('document')))
        {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file = $request->file('document');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('document'));     //Image Intervention Lines
            $file->resize(500, 400);
            $file->save('upload/leave_document/' . $filename); 

            $leave->document = $filename;        //For the DB Field
        }

        $leave->save();

        return redirect()->route('teacher.leave.list')->with('success', 'Leave Request Submitted Successfully!');
 
    }





}
