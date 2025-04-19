<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimetable;
use App\Models\Subject;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();

        if(!empty($request->class_id))
        {
            $data['getSubject'] = ClassSubject::mySubject_ByTutor($request->class_id);
        }

        $getWeek = Week::getRecord();
        $week = array();

        foreach($getWeek as $value)
        {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->subject_id))
            {
                $classSubject = ClassSubjectTimetable::getRecordClassSubject($request->class_id, $request->subject_id, $value->id);

                if(!empty($classSubject))
                {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $week[] = $dataW;
            
        }

        // dd($week);
        $data['week'] = $week;
        
        $data['header_title'] = "Class Timetable";

        return view('admin.class_timetable.list', $data);
    }



    public function getSubject(Request $request)
    {
        $getSubject = ClassSubject::mySubject($request->class_id);

        $html = "<option value=''>Select</option>";

        foreach($getSubject as $value)
        {
            $html .= "<option value='".$value->subject_id."'>".$value->subject_name."</option>";
        }

        $json['html'] = $html;
        echo json_encode($json);

    }


    public function insert_update(Request $request)
    {
        ClassSubjectTimetable::where('class_id', $request->class_id)->where('subject_id', $request->subject_id)->delete();

        foreach($request->timetable as $timetable)
        {
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
            {
                $save = new ClassSubjectTimetable;
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->save();
                
            }
        }

        return redirect()->back()->with('success', 'Class Timetable Successfully Saved');


    }


    public function myTimetable()
    {

        ////=========NOTE=========/////
        //WHERE $dataW, valueW   =   week data, week value
        // WHERE $dataS, valueS   =   subject data, subject value
        
        $result = array();

        // $getRecord = ClassSubject::mySubject(Auth::user()->class_id); //Tutor
        $getRecord = ClassSubject::mySubject(Auth::user()->id); //Mine

        foreach($getRecord as $value)
        {
                $dataS['name'] = $value->subject_name;
                
                $getWeek = Week::getRecord();
                $week = array();
                foreach($getWeek as $valueW)
                {
                    $dataW = array();
                    $dataW['week_name'] = $valueW->name;
                    $classSubject = ClassSubjectTimetable::getRecordClassSubject($value->class_id, $value->subject_id, $valueW->id);

                    if(!empty($classSubject))
                    {
                        $dataW['start_time'] = $classSubject->start_time;
                        $dataW['end_time'] = $classSubject->end_time;
                        $dataW['room_number'] = $classSubject->room_number;
                    }
                    else
                    {
                        $dataW['start_time'] = '';
                        $dataW['end_time'] = '';
                        $dataW['room_number'] = '';
                    }

                    $week[] = $dataW;
                }

                $dataS['week'] = $week;
                $result[] = $dataS;
        }

        // dd($result);

        $data['getRecord'] = $result;

        $data['header_title'] = "My Timetable";

        return view('student.my_timetable', $data); 
    }





    //TEACHER SIDE
    public function myTimetableTeacher($class_id, $subject_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getSubject'] = Subject::getSingle($subject_id);

        $getWeek = Week::getRecord();
        $week = array();
        foreach($getWeek as $valueW)
        {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;
            $classSubject = ClassSubjectTimetable::getRecordClassSubject($class_id, $subject_id, $valueW->id);

            if(!empty($classSubject))
            {
                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['room_number'] = $classSubject->room_number;
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $result[] = $dataW;
        }               

        $data['getRecord'] = $result;

        $data['header_title'] = "My Timetable";

        return view('teacher.my_timetable', $data); 
    }






    ///PARENT SIDE
    public function myTimetableParent($class_id, $subject_id, $student_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getSubject'] = Subject::getSingle($subject_id);
        $data['getStudent'] = User::getSingle($student_id);

        $getWeek = Week::getRecord();
        $week = array();
        foreach($getWeek as $valueW)
        {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;
            $classSubject = ClassSubjectTimetable::getRecordClassSubject($class_id, $subject_id, $valueW->id);

            if(!empty($classSubject))
            {
                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['room_number'] = $classSubject->room_number;
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }

            $result[] = $dataW;
        }               

        $data['getRecord'] = $result;

        $data['header_title'] = "My Timetable";

        return view('parent.my_timetable', $data); 
    }




    





}
