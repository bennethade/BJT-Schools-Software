<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class IDCardController extends Controller
{
    public function studentIDList(Request $request)
    {
        $data['getExam'] = Exam::getExam();
        $data['getClass'] = ClassModel::get();

        $data['getStudent'] = User::getStudentClassIDCard($request->get('class_id'), $request->get('exam_id'));

        $data['header_title'] = "ID Card";
        return view('id_card.student.list', $data);
    }



    public function studentIDPrint(Request $request)
    {
        $data['getStudent'] = User::getSingle($request->student_id);

        $data['getSetting'] = Setting::getSingle();

        $data['header_title'] = "ID Card";
        return view('id_card.student.print', $data);
    }




    public function teacherIDList(Request $request)
    {
        $data['getTeacher'] = User::getTeacher();

        $data['header_title'] = "ID Card";
        return view('id_card.teacher.list', $data);
    }


    public function teacherIDPrint(Request $request)
    {
        $data['getTeacher'] = User::getSingle($request->teacher_id);

        $data['getSetting'] = Setting::getSingle();

        $data['header_title'] = "ID Card";
        return view('id_card.teacher.print', $data);
    }




}
