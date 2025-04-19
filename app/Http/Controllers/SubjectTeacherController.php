<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectTeacherController extends Controller
{
    public function view()
    {
        $data['getRecord'] = SubjectTeacher::getRecord();
        $data['header_title'] = "Subject Teacher";
        return view('admin.subject_teacher.list', $data);
    }


    public function add()
    {
        $data['getExam'] = Exam::getExam();
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacher();
        $data['getSubject'] = Subject::getSubject();

        $data['header_title'] = "Assign Subject Teacher";
        return view('admin.subject_teacher.add', $data);
    }


    public function insert(Request $request)
    {
        // dd($request->all());

        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = SubjectTeacher::getAlreadyFirst($request->class_id, $request->exam_id, $subject_id, $request->teacher_id);

                if(!empty($getAlreadyFirst))
                {
                    // $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $data = new SubjectTeacher();
                    $data->class_id = $request->class_id;
                    $data->exam_id = $request->exam_id;
                    $data->teacher_id = $request->teacher_id;
                    $data->subject_id = $subject_id;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }
                
            }

            return redirect()->route('subject_teacher.view')->with('success', 'Subject(s) Successfully Assigned to Teacher');
        }
        else
        {
            return redirect()->back()->with('error', 'Error! </br> Please Try Again with the right details');
        }

    }



    public function massEdit($id)
    {
        $getRecord = SubjectTeacher::getSingle($id);

        if(!empty($getRecord))
        {
            $data['header_title'] = "Edit Assigned Subejct";

            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId'] = SubjectTeacher::getAssignSubjectId($getRecord->class_id, $getRecord->exam_id, $getRecord->teacher_id);

            $data['getClass'] = ClassModel::getClass();
            $data['getExam'] = Exam::getExam();
            $data['getTeacher'] = User::getTeacher();
            $data['getSubject'] = Subject::getSubject();
            return view('admin.subject_teacher.mass_edit', $data);
        }
        else
        {
            abort(404);
        }
        
    }


    public function massUpdate(Request $request)
    {
        SubjectTeacher::deleteSubject($request->class_id, $request->exam_id, $request->teacher_id);

        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = SubjectTeacher::getAlreadyFirst($request->class_id, $request->exam_id, $subject_id, $request->teacher_id);

                if(!empty($getAlreadyFirst))
                {
                    // $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $data = new SubjectTeacher;
                    $data->class_id = $request->class_id;
                    $data->exam_id = $request->exam_id;
                    $data->subject_id = $subject_id;
                    $data->teacher_id = $request->teacher_id;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }

                
            }

        }

        return redirect()->route('subject_teacher.view')->with('success', 'Teacher Subjects Successfully Updated!');

    }


    public function delete($id)
    {
        $data = SubjectTeacher::getSingle($id);
        // $data->is_delete = 1;
        // $data->save();
        // $data->delete();
        $data->forceDelete();

        return redirect()->back()->with('warning', 'Record Successfully Deleted!');
    }





    //TEACHER DASHBOARD
    public function show(Request $request) 
    {
        $data['getClass'] = ClassModel::getClass();    //This line gets all classes

        // $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id); //This line gets only the class assigned to a teacher

        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getSubject'] = ExamSchedule::getTeacherSubject($request->get('class_id'), $request->get('exam_id'), Auth::user()->id);

            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }

        $data['header_title'] = "Marks Entry";

        if(Auth::user()->user_type == 2 || Auth::user()->user_type == 'Teacher')
        {
            return view('teacher.subject_teacher.marks_entry', $data);
        }else{
            return view('other_roles.subject_teacher.marks_entry', $data);
        }
    }



    




}
