<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\Homework;
use App\Models\NoticeBoard;
use App\Models\StudentAttendance;
use App\Models\StudentFees;
use App\Models\Subject;
use App\Models\SubmitHomework;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboad';

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            
            //Fetch monthly date start
            $data['firstDayOfMonth'] = Carbon::now()->startOfMonth()->toDateString();
            $data['lastDayOfMonth'] = Carbon::now()->endOfMonth()->toDateString();
            //Fetch monthly date ends


            $data['getTotalFees'] = StudentFees::getTotalFees();
            $data['getTotalMonthFees'] = StudentFees::getTotalMonthFees();
            $data['getTotalTodayFees'] = StudentFees::getTotalTodayFees();

            $data['totalAdmin'] = User::getTotalAdmin();
            $data['totalTeacher'] = User::getTotalUser(2);
            $data['totalStudent'] = User::getTotalUser(3);
            $data['totalParent'] = User::getTotalUser(4);
            
            $data['totalExam'] = Exam::getTotalExam();
            $data['totalClass'] = ClassModel::getTotalClass();
            $data['totalSubject'] = Subject::getTotalSubject();

            $data['totalNotification'] = NoticeBoard::getTotalNotification();
            $data['totalHomework'] = SubmitHomework::getTotalHomework();

            return view('admin.dashboard', $data);    
        }


        // elseif(Auth::user()->user_type == 2)
        elseif(Auth::user()->user_type == 'Principal' || Auth::user()->user_type == 'Vice Principal')
        {
            
            $data['totalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
            $data['totalClass'] = AssignClassTeacher::getMyClassSubjectGroupCount(Auth::user()->id);
            $data['totalSubject'] = AssignClassTeacher::getMyClassSubjectCount(Auth::user()->id);

            $data['totalNoticeBoard'] = NoticeBoard::getRecordUserCount(Auth::user()->user_type);
            $data['totalHomework'] = SubmitHomework::getTotalHomework();

            return view('other_roles.dashboard', $data);
        }


        elseif(Auth::user()->user_type == 2 )
        {
            
            $data['totalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
            $data['totalClass'] = AssignClassTeacher::getMyClassSubjectGroupCount(Auth::user()->id);
            $data['totalSubject'] = AssignClassTeacher::getMyClassSubjectCount(Auth::user()->id);

            $data['totalNoticeBoard'] = NoticeBoard::getRecordUserCount(Auth::user()->user_type);
            $data['totalHomework'] = SubmitHomework::getTotalHomework();

            return view('teacher.dashboard', $data);
        }


        elseif(Auth::user()->user_type == 3)
        {

            $data['totalPaidAmount'] = StudentFees::totalPaidAmountStudent(Auth::user()->id);
            
            $data['totalSubject'] = ClassSubject::myTotalSubject(Auth::user()->class_id);

            $data['totalNoticeBoard'] = NoticeBoard::getRecordUserCount(Auth::user()->user_type);
            
            $data['totalHomework'] = Homework::getRecordStudentCount(Auth::user()->class_id, Auth::user()->id);
            $data['totalSubmittedHomework'] = SubmitHomework::getRecordStudentCount(Auth::user()->id);

            $data['totalAttendance'] = StudentAttendance::getRecordStudentCount(Auth::user()->id);


            return view('student.dashboard', $data);
        }


        elseif(Auth::user()->user_type == 4)
        {
            $student_ids = User::getMyStudentIds(Auth::user()->id);
            $class_ids = User::getMyStudentClassIds(Auth::user()->id);

            if(!empty($student_ids))
            {
                $data['totalPaidAmount'] = StudentFees::totalPaidAmountStudentParent($student_ids);
                $data['totalAttendance'] = StudentAttendance::getRecordStudentParentCount($student_ids);
                $data['totalSubmittedHomework'] = SubmitHomework::getRecordStudentParentCount($student_ids);

            }
            else
            {
                $data['totalPaidAmount'] = 0;
                $data['totalAttendance'] = 0;
                $data['totalSubmittedHomework'] = 0;
            }


            $data['getTotalFees'] = StudentFees::getTotalFees();
            
            $data['totalStudent'] = User::getMyStudentCount(Auth::user()->id);

            $data['totalNoticeBoard'] = NoticeBoard::getRecordUserCount(Auth::user()->user_type);            


            return view('parent.dashboard', $data);
        }
    }



    public function commentBank()
    {
        $data['header_title'] = "Comment Bank";
        return view('admin.comment_bank');
    }



    public function underDevelopment()
    {
        $data['header_title'] = "Under Development";
        return view('under_development');
    }


}
