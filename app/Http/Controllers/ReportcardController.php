<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

class ReportcardController extends Controller
{
    public function reportCard(Request $request)
    {
        $data['getExam'] = Exam::getExam();
        $data['getClass'] = ClassModel::get();

        $data['getStudent'] = User::getStudentClassIDCard($request->get('class_id'), $request->get('exam_id'));

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->get('class_id'));
        $data['getSingleExamName'] = Exam::getSingleExamName($request->get('exam_id'));

        $data['header_title'] = "Report Card";
        return view('report_card.student_list', $data);
    }



}
