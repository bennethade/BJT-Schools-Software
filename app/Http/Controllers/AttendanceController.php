<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\StudentAttendance;
use App\Models\TeacherAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class AttendanceController extends Controller
{

    //TEACHER ATTENDANCE
    public function teacherAttendance()
    {
        $data['getAttendance'] = TeacherAttendance::getTeacher();
        
        $data['header_title'] = "Teacher Attendance";
        return view('admin.attendance.teacher.view', $data);
    }


    public function addTeacherAttendance(Request $request)
    {
        $data['teacherIP'] = $request->ip();  

        $data['teacherIP'] = $_SERVER['REMOTE_ADDR'];

        // $data['IPValue'] = '66.102.0.0';  //IP Address for USA
        $data['IPValue'] = '160.119.125.248';  //IP Address for Abuja

        $data['location'] = Location::get($data['IPValue']);




        $data['getTeacher'] = User::where('user_type', 2)->get();

        $data['attendanceDate'] = today()->format('d-m-Y');

        $data['currentTime'] = now()->toTimeString();

        $data['getRecord'] = TeacherAttendance::where('teacher_id', Auth::user()->id)->get();


        $allowedCoordinates = [
            ['latitude' => '9.0014', 'longitude' => '7.42408'],
            ['latitude' => '9.0567', 'longitude' => '7.4969'],
            // ['latitude' => '9.056', 'longitude' => '7.496'],
            // Add more coordinates as needed
        ];
        
        $latitude = $data['location']->latitude;
        $longitude = $data['location']->longitude;
        
        if (in_array(['latitude' => $latitude, 'longitude' => $longitude], $allowedCoordinates, true)) {

            $data['header_title'] = "Add Teacher Attendance";
            return view('admin.attendance.teacher.add', $data);
        }
        else
        {
            return redirect()->back()->with('error', 'You are not Within the school premises! Kindly try again when you get to the school compound');
        }

        
    }


    public function submitTeacherAttendance(Request $request)
    {
        // dd($request->all());

        $attendanceDate = today()->format('Y-m-d');

        $arrivalTime = now()->toTimeString();

        $closingTime = now()->toTimeString();

        $convertArrivalTime = strtotime($arrivalTime); // Convert arrival time to Unix timestamp
        $convertClosingTime = strtotime($closingTime); // Convert closing time to Unix timestamp

        if ($convertArrivalTime <= strtotime('07:25:59')) 
        {
            $attendanceStatus = 1;
        }
        elseif ($convertArrivalTime > strtotime('07:26:00')) 
        {
            $attendanceStatus = 2;
        }
        else
        {
            $attendanceStatus = 3;
        }

        if (empty($attendanceDate)) {
            $attendance = new TeacherAttendance();
            $attendance->attendance_date = $attendanceDate; // Assuming you want to set it to today's date
            $attendance->teacher_id = $request->teacher_id;
            $attendance->arrival_time = $arrivalTime;
            $attendance->attendance_type = $attendanceStatus;
            $attendance->created_by = Auth::user()->id; 
        } 
        else 
        {
            $attendance = TeacherAttendance::where('attendance_date', $attendanceDate)->where('teacher_id', $request->teacher_id)->first();
        
            // If the record doesn't exist, you may want to create a new instance
            if (!$attendance) {
                $attendance = new TeacherAttendance();
                $attendance->attendance_date = $attendanceDate;
                $attendance->teacher_id = $request->teacher_id;
                $attendance->arrival_time = $arrivalTime;
                $attendance->attendance_type = $attendanceStatus;
                $attendance->created_by = Auth::user()->id; 
            }
        
            elseif($attendance)
            {
                $attendance->closing_time = $closingTime;
            }
        }
        
        $attendance->save();
        

        return redirect()->route('attendance.teacher.view')->with('success', 'Teacher Attendance Submitted Successfully!');

    }




    public function teacherAttendanceReport()
    {
        $data['getRecord'] = TeacherAttendance::get();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.report', $data);
    }


    public function todayReport()
    {
        $data['todayDate'] = now()->format('d-m-Y'); // Get the current date in 'Y-m-d' format
        $data['dayOfMonth'] = now()->format('l');

        $data['getAttendance'] = TeacherAttendance::todayAttendance();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.full_report.today_report', $data);
    }


    public function weeklyReport()
    {
        $data['startDate'] = now()->startOfWeek()->format('d-m-Y'); // Get the start date of the current week
        $data['endDate'] = now()->endOfWeek()->format('d-m-Y');     // Get the end date of the current week


        $data['getAttendance'] = TeacherAttendance::weeklyAttendance();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.full_report.weekly_report', $data);
    }


    public function monthlyReport()
    {
        $data['monthName'] = now()->startOfMonth()->format('F');

        $data['getAttendance'] = TeacherAttendance::monthlyAttendance();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.full_report.monthly_report', $data);
    }


    public function todayLateComers()
    {
        $data['todayDate'] = now()->format('d-m-Y'); 

        $data['getAttendance'] = TeacherAttendance::todayLateComers();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.late_comers.today_late_comers', $data);
    }

    public function weeklyLateComers()
    {
        $data['startDate'] = now()->startOfWeek()->format('d-m-Y'); // Get the start date of the current week
        $data['endDate'] = now()->endOfWeek()->format('d-m-Y');     // Get the end date of the current week

        $data['getAttendance'] = TeacherAttendance::weeklyLateComers();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.late_comers.weekly_late_comers', $data);
    }


    public function monthlyLateComers()
    {
        $data['monthName'] = now()->startOfMonth()->format('F');

        $data['getAttendance'] = TeacherAttendance::monthlyLateComers();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.late_comers.monthly_late_comers', $data);
    }


    public function todayEarlyLeavers()
    {
        $data['todayDate'] = now()->format('d-m-Y'); 

        $data['getAttendance'] = TeacherAttendance::todayEarlyLeavers();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.early_leavers.today_early_leavers', $data);
    }


    public function weeklyEarlyLeavers()
    {
        $data['startDate'] = now()->startOfWeek()->format('d-m-Y'); 
        $data['endDate'] = now()->endOfWeek()->format('d-m-Y');     

        $data['getAttendance'] = TeacherAttendance::weeklyEarlyLeavers();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.early_leavers.weekly_early_leavers', $data);
    }


    public function monthlyEarlyLeavers()
    {
        $data['monthName'] = now()->startOfMonth()->format('F');

        $data['getAttendance'] = TeacherAttendance::monthlyEarlyLeavers();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.teacher.early_leavers.monthly_early_leavers', $data);
    }




    //STUDENT ATTENDANCE
    public function studentAttendance(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }

        $data['header_title'] = "Student Attendance";
        return view('admin.attendance.student', $data);
    }


    public function studentAttendanceSubmit(Request $request)
    {
        $check_attendance = StudentAttendance::checkAlreadyAttendance($request->student_id, $request->class_id, $request->exam_id, $request->attendance_date);

        if(!empty($check_attendance))
        {
            $attendance = $check_attendance;
        }
        else
        {
            $attendance = new StudentAttendance();
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->exam_id = $request->exam_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }

        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message'] = "Attendance Successfully Saved!";
        echo json_encode($json);
    }



    public function attendanceReport(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAttendance::getRecord();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.report', $data);
    }




    //Teacher Dashboard
    public function clockInView()
    {
        $data['getAttendance'] = TeacherAttendance::getTeacherClockIn(Auth::user()->id);

        $data['header_title'] = "My Attendance";
        return view('teacher.attendance.view_clock_in', $data);
    }



    public function clockInNow()
    {
        $data['teacher'] = User::find(Auth::user()->id);

        $data['attendanceDate'] = today()->format('d-m-Y');

        $data['arrivalTime'] = now()->toTimeString();

        $data['closingTime'] = now()->toTimeString();

        $data['header_title'] = "Attendance Clock In";
        return view('teacher.attendance.clock_in_now', $data);
    }


    public function submitClockIn(Request $request)
    {
        $attendanceDate = today()->format('Y-m-d');

        $arrivalTime = now()->toTimeString();

        $closingTime = now()->toTimeString();

        $convertArrivalTime = strtotime($arrivalTime); // Convert arrival time to Unix timestamp
        $convertClosingTime = strtotime($closingTime); // Convert closing time to Unix timestamp

        if ($convertArrivalTime <= strtotime('07:25:59')) 
        {
            $attendanceStatus = 1;
        }
        elseif ($convertArrivalTime > strtotime('07:26:00')) 
        {
            $attendanceStatus = 2;
        }
        else
        {
            $attendanceStatus = 3;
        }

        if (empty($attendanceDate)) {
            $attendance = new TeacherAttendance();
            $attendance->attendance_date = $attendanceDate; // Assuming you want to set it to today's date
            $attendance->teacher_id = $request->teacher_id;
            $attendance->arrival_time = $arrivalTime;
            $attendance->attendance_type = $attendanceStatus;
            $attendance->created_by = Auth::user()->id; 
        } 
        else 
        {
            $attendance = TeacherAttendance::where('attendance_date', $attendanceDate)->where('teacher_id', Auth::user()->id)->first();
        
            // If the record doesn't exist, you may want to create a new instance
            if (!$attendance) {
                $attendance = new TeacherAttendance();
                $attendance->attendance_date = $attendanceDate;
                $attendance->teacher_id = $request->teacher_id;
                $attendance->arrival_time = $arrivalTime;
                $attendance->attendance_type = $attendanceStatus;
                $attendance->created_by = Auth::user()->id; 
            }
        
            elseif($attendance)
            {
                $attendance->closing_time = $closingTime;
            }
        }
        
        $attendance->save();
        

        return redirect()->route('teacher.attendance.clock_in')->with('success', 'You Have Clocked In Successfully!');

    }






    public function teacherStudentAttendance(Request $request)
    {
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);
        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }

        $data['header_title'] = "Student Attendance";
        return view('teacher.attendance.student', $data);
    }


    public function attendanceReportTeacher()
    {
        $getClass = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);
        $classArray = array();

        foreach($getClass as $value)
        {
            $classArray[] = $value->class_id;
        }

        $data['getClass'] = $getClass;
        
        $data['getRecord'] = StudentAttendance::getRecordTeacher($classArray);
        $data['header_title'] = "Attendance Report";
        return view('teacher.attendance.report', $data);
    }




    //Student Dashboard
    public function myAttendanceStudent()
    {
        $data['getClass'] = StudentAttendance::getClassStudent(Auth::user()->id);
        $data['getRecord'] = StudentAttendance::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Attendance";
        return view('student.my_attendance', $data);
    }



    //Parent Side
    public function myAttendanceParent($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $data['getClass'] = StudentAttendance::getClassStudent($student_id);
        $data['getRecord'] = StudentAttendance::getRecordStudent($student_id);
        $data['header_title'] = "Student Attendance";
        return view('parent.my_attendance', $data);
    }



}
