<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\Homework;
use App\Models\SubmitHomework;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class HomeworkController extends Controller
{
    
    public function homeworkReport()
    {
        $data['getRecord'] = SubmitHomework::getHomeworkReport();
        $data['header_title'] = "Homework Report";
        return view('admin.homework.report', $data);
    }
        


    public function homework()
    {
        $data['getRecord'] = Homework::getRecord();
        $data['header_title'] = "Homework";
        return view('admin.homework.list', $data);
    }


    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        $data['header_title'] = "Add New Homework";
        return view('admin.homework.add', $data);
    }



    public function insert(Request $request)
    {
        // dd($request->all());


        $request->validate([
            'document_file' => 'file|max:5120',
        ], [
            'document_file.max' => 'The document must not be larger than 5MB.',
        ]);


        $homework = new Homework;
        $homework->class_id = trim($request->class_id);
        $homework->exam_id = trim($request->exam_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = $request->submission_date;
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;


        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename); 

            $homework->document_file = $filename;
        }


        $homework->save();

        return redirect()->route('homework.homework')->with('success','Homework Successfully Created');
    }



    
    public function ajax_get_subject(Request $request)
    {
        /////====TUTOR
        // $class_id = $request->class_id;
        // $getSubject = ClassSubject::mySubject($class_id);
        // $html = '';
        // $html .= '<option value="">Select Subject</option>';
        // foreach($getSubject as $value)
        // {
            // $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.'</option>';
        // }

        // $json['success'] = $html;
        // echo json_encode($json);



        ////ME BEN
        $getSubject = ClassSubject::mySubject_ByTutor($request->class_id);

        $html = '';
        $html .= '<option value="">Select</option>';

        foreach($getSubject as $value)
        {
            $html .= "<option value='".$value->subject_id."'>".$value->subject_name."</option>";
        }

        $json['success'] = $html;
        echo json_encode($json);



    }




    public function edit($id)
    {
        $getRecord = Homework::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubject::mySubject_ByTutor($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        
        $data['header_title'] = "Edit Homework";
        return view('admin.homework.edit', $data);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'document_file' => 'file|max:5120',
        ], [
            'document_file.max' => 'The document must not be larger than 5MB.',
        ]);

        $homework = Homework::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->exam_id = trim($request->exam_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = $request->submission_date;
        $homework->description = trim($request->description);


        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename); 

            $homework->document_file = $filename;
        }


        $homework->save();

        return redirect()->route('homework.homework')->with('success','Homework Successfully Updated');
    }


    public function delete($id)
    {
        $homework = Homework::findOrFail($id);
        $homework->delete();
        return redirect()->back()->with('success','Homework Deleted Successfully');
    }


    public function submitted($homework_id)
    {
        $homework = Homework::getSingle($homework_id);
        $data['homework_id'] = $homework_id;
        $data['getRecord'] = SubmitHomework::getRecord($homework_id);
        $data['header_title'] = "Submitted Homework";
        return view('admin.homework.submitted', $data);

    }





    //Teacher Side
    public function homeworkTeacher()
    {
        $class_ids = array();
        $getClass = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);   
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }

        $data['getRecord'] = Homework::getRecordTeacher($class_ids);
        $data['header_title'] = "Homework";
        return view('teacher.homework.list', $data);
    }

    public function addHomeworkTeacher()
    {
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);   
        // $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Homework";
        return view('teacher.homework.add', $data);
    }


    public function insertTeacher(Request $request)
    {
        $request->validate([
            'document_file' => 'file|max:5120',
        ], [
            'document_file.max' => 'The document must not be larger than 5MB.',
        ]);

        // dd($request->all());
        $homework = new Homework;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = $request->submission_date;
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;


        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename); 

            $homework->document_file = $filename;
        }


        $homework->save();

        return redirect()->route('teacher.homework')->with('success','Homework Successfully Created');
    }


    public function editTeacher($id)
    {
        $getRecord = Homework::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubject::mySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);   
        $data['header_title'] = "Edit Homework";
        return view('teacher.homework.edit', $data);
    }



    public function updateTeacher(Request $request, $id)
    {
        $request->validate([
            'document_file' => 'file|max:5120',
        ], [
            'document_file.max' => 'The document must not be larger than 5MB.',
        ]);

        $homework = Homework::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = $request->submission_date;
        $homework->description = trim($request->description);


        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename); 

            $homework->document_file = $filename;
        }


        $homework->save();

        return redirect()->route('teacher.homework')->with('success','Homework Successfully Updated');
    }


    public function submittedTeacher($homework_id)
    {
        $homework = Homework::getSingle($homework_id);
        $data['homework_id'] = $homework_id;
        $data['getRecord'] = SubmitHomework::getRecord($homework_id);
        $data['header_title'] = "Submitted Homework";
        return view('teacher.homework.submitted', $data);

    }




    ///====STUDENT SIDE=====///
    public function studentHomework()
    {
        $data['getRecord'] = Homework::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "My Homework";
        return view('student.homework.list', $data);
    }


    

    public function submitHomework($homework_id)
    {
        $data['getRecord'] = Homework::getSingle($homework_id);
        $data['header_title'] = "Submit Homework";
        return view('student.homework.submit', $data);
    }


    public function submitHomeworkInsert(Request $request, $homework_id)
    {
        $request->validate([
            'document_file' => 'file|max:5120',
        ], [
            'document_file.max' => 'The document must not be larger than 5MB.',
        ]);
        
        // dd($request->all());
        $homework = new SubmitHomework();
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename); 

            $homework->document_file = $filename;
        }


        $homework->save();

        return redirect()->route('student.my_homework')->with('success','Homework Successfully Submited');

    }


    public function studentSubmittedHomework()
    {
        $data['getRecord'] = SubmitHomework::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Submitted Homework";
        return view('student.homework.submitted_list', $data);
    }





    ///====Parent side===///
    public function homeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = Homework::getRecordStudent($getStudent->class_id, $getStudent->id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Student Homework";
        return view('parent.homework.list', $data);
    }


    public function submittedHomeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = SubmitHomework::getRecordStudent($getStudent->id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Student Submitted Homework";
        return view('parent.homework.submitted_list', $data);
    }







}
