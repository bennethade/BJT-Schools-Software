<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\StudentSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentSubjectController extends Controller
{
    

    public function view(Request $request)
    {
        $data['getRecord'] = StudentSubject::getRecord($request->class_id, $request->exam_id, $request->student_id);

        $data['getStudent'] = StudentSubject::getStudent($request->student_id);

        $data['getExam'] = Exam::getSingle($request->exam_id);

        $data['getSingleExamName'] = Exam::getSingleExamName($request->exam_id);

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id); 
        
        $data['header_title'] = "Student Subject List";

        if(Auth::user()->user_type == "Super Admin" || Auth::user()->user_type == "School Admin" || Auth::user()->user_type == "1")
        {
            return view('admin.assign_student.view_subjects', $data);
        }
        else
        {
            return view('teacher.my_student.view_subjects', $data);
        }

        
    }



    public function assignAllSubjects(Request $request)
    {
        $record = StudentSubject::checkAlreadyExistingSubject($request->class_id, $request->exam_id, $request->student_id);

        if($record)
        {
            $data = $record;
        }
        else
        {
            $data = ClassSubject::where('class_id', $request->class_id)->get();

            foreach ($data as $record) 
            {
                StudentSubject::create(
                    [
                        'class_id' => $record->class_id, 
                        'subject_id' => $record->subject_id, 
                        'exam_id' => $request->exam_id,
                        'student_id' => $request->student_id,
                        'created_by' => Auth::user()->id,
                    ]);
            }

        }

        return redirect()->back()->with('success', 'All Subjects Assigned To Student');

    }



    public function deleteSubjects(Request $request)
    {
        $data = StudentSubject::findOrFail($request->assign_subject_id);
        $data->forceDelete();

        // DB::table('student_subjects')->where('id', '=', $request->assign_student_id)->delete();

        return redirect()->back()->with('warning', 'Subject Removed From Student Successfully!');

    }



    public function deleteAllSubjects(Request $request)
    {
        
        StudentSubject::where('class_id',$request->class_id)->where('exam_id',$request->exam_id)->where('student_id', $request->student_id)->forceDelete();

        return redirect()->back()->with('warning', "Student's Subjects Removed Successfully!");

    }






}
