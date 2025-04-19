<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class TeacherAttendance extends Model
{
    use HasFactory;



    static public function getTeacher()
    {
        $return =  self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by');

                        if(!empty(Request::get('attendance_date')))
                        {
                            $return = $return->whereDate('attendance_date', '=', Request::get('attendance_date'));
                        }

        $return = $return->orderBy('teacher_id', 'asc')->paginate(50);

        return $return;
    }


    static public function getTeacherClockIn($teacher_id)
    {   //USED AT THE TEACHER DASHBOARD
        $return =  self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.teacher_id', '=', $teacher_id);

                        if(!empty(Request::get('attendance_from')))
                        {
                            $return = $return->whereDate('attendance_date', '>=', Request::get('attendance_from'));
                        }

                        if(!empty(Request::get('attendance_to')))
                        {
                            $return = $return->whereDate('attendance_date', '<=', Request::get('attendance_to'));
                        }

        $return = $return->get();

        return $return;
    }




    static public function todayAttendance()
    {
        $todayDate = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->whereDate('teacher_attendances.created_at', '=', $todayDate); // Add the condition to filter by today's date

        $return = $return->orderBy('teacher_id', 'asc')->get();

        return $return;
    }




    static public function weeklyAttendance()
    {
        $startDate = now()->startOfWeek()->format('Y-m-d'); // Get the start date of the current week
        $endDate = now()->endOfWeek()->format('Y-m-d');     // Get the end date of the current week

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->whereBetween('teacher_attendances.created_at', [$startDate, $endDate]); // Add the condition to filter by the current week

        $return = $return->orderBy('attendance_date', 'asc')->get();

        return $return;
    }




    /////====THIS IS CORRECT AS WELL AS THE ONE BELOW=====//////
    // static public function monthlyAttendance()
    // {
    //     $startDate = now()->startOfMonth()->format('Y-m-d'); // Get the start date of the current month
    //     $endDate = now()->endOfMonth()->format('Y-m-d');     // Get the end date of the current month

    //     $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'created_by.name as created_by')
    //                     ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
    //                     ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
    //                     ->whereBetween('teacher_attendances.created_at', [$startDate, $endDate]); // Add the condition to filter by the current month

    //     $return = $return->orderBy('attendance_date', 'asc')->get();

    //     return $return;
    // }


     /////====THE BELOW CODE IS CORRECT TOO=====//////
    static public function monthlyAttendance()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->whereYear('teacher_attendances.created_at', $currentYear)
                        ->whereMonth('teacher_attendances.created_at', $currentMonth);

        $return = $return->orderBy('attendance_date', 'asc')->get();

        return $return;
    }




    static public function todayLateComers()
    {
        $todayDate = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.attendance_type', '=', 2)
                        ->whereDate('teacher_attendances.created_at', '=', $todayDate); // Add the condition to filter by today's date

        $return = $return->orderBy('teacher_id', 'asc')->get();

        return $return;
    }



    static public function todayEarlyLeavers()
    {
        $todayDate = now()->format('Y-m-d'); 

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.closing_time', '<', '14:00:00')
                        ->whereDate('teacher_attendances.created_at', '=', $todayDate);

        $return = $return->orderBy('teacher_id', 'asc')->get();

        return $return;
    }


    

    static public function weeklyLateComers()
    {
        $startDate = now()->startOfWeek()->format('Y-m-d'); // Get the start date of the current week
        $endDate = now()->endOfWeek()->format('Y-m-d');     // Get the end date of the current week

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.attendance_type', '=', 2)
                        ->whereBetween('teacher_attendances.created_at', [$startDate, $endDate]); // Add the condition to filter by the current week

        $return = $return->orderBy('attendance_date', 'asc')->get();

        return $return;
    }


    static public function weeklyEarlyLeavers()
    {
        $startDate = now()->startOfWeek()->format('Y-m-d'); 
        $endDate = now()->endOfWeek()->format('Y-m-d');     

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.closing_time', '<', '14:00:00')
                        ->whereBetween('teacher_attendances.created_at', [$startDate, $endDate]); // Add the condition to filter by the current week

        $return = $return->orderBy('attendance_date', 'asc')->get();

        return $return;
    }


    static public function monthlyLateComers()
    {
        $startDate = now()->startOfMonth()->format('Y-m-d'); // Get the start date of the current month
        $endDate = now()->endOfMonth()->format('Y-m-d');     // Get the end date of the current month

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.attendance_type', '=', 2)
                        ->whereBetween('teacher_attendances.created_at', [$startDate, $endDate]); // Add the condition to filter by the current month

        $return = $return->orderBy('attendance_date', 'asc')->get();

        return $return;
    }


    static public function monthlyEarlyLeavers()
    {
        $startDate = now()->startOfMonth()->format('Y-m-d'); // Get the start date of the current month
        $endDate = now()->endOfMonth()->format('Y-m-d');     // Get the end date of the current month

        $return = self::select('teacher_attendances.*', 'teacher.name as teacher_name', 'teacher.last_name as teacher_last_name', 'teacher.other_name as teacher_other_name' , 'created_by.name as created_by')
                        ->join('users as teacher', 'teacher.id', '=', 'teacher_attendances.teacher_id')
                        ->join('users as created_by', 'created_by.id', '=', 'teacher_attendances.created_by')
                        ->where('teacher_attendances.closing_time', '<', '14:00:00')
                        ->whereBetween('teacher_attendances.created_at', [$startDate, $endDate]); // Add the condition to filter by the current month

        $return = $return->orderBy('attendance_date', 'asc')->get();

        return $return;
    }




    


    static public function checkAlreadyAttendance($teacher_id, $attendance_date)
    {
        return self::where('teacher_id', '=', $teacher_id)->where('attendance_date', '=', $attendance_date)->first();
    }


    

}
