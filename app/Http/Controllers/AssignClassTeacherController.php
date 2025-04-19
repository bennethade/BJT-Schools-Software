<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = AssignClassTeacher::getRecord();
        
        $data['header_title'] = "Assign Class Teacher";

        return view('admin.assign_class_teacher.list', $data);
    }


    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        $data['getTeacher'] = User::getTeacherClass();

        $data['header_title'] = "Add New Class Teacher";
        return view('admin.assign_class_teacher.add', $data);
    }



    public function insert(Request $request)
    {
        // dd($request->all());

        if(!empty($request->teacher_id))
        {
            foreach($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id, $request->exam_id, $teacher_id);

                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $data = new AssignClassTeacher;
                    $data->class_id = $request->class_id;
                    $data->exam_id = $request->exam_id;
                    $data->teacher_id = $teacher_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }

                
            }

            return redirect()->route('assign_class_teacher.list')->with('success', 'Class Successfully Assigned to Teacher');
        }
        else
        {
            return redirect()->back()->with('error', 'Error! Please Try Again with the right details');
        }
    }



    public function massEdit($id)
    {
        $getRecord = AssignClassTeacher::getSingle($id);

        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherId'] = AssignClassTeacher::getAssignTeacherId($getRecord->class_id, $getRecord->exam_id);

            $data['getClass'] = ClassModel::getClass();
            $data['getExam'] = Exam::getExam();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = "Edit Assigned Class Teacher";
            return view('admin.assign_class_teacher.mass_edit', $data);
        }
        else
        {
            abort(404);
        }
        
    }


    public function massUpdate(Request $request, $id)
    {
        AssignClassTeacher::deleteTeacher($request->class_id);

        if(!empty($request->teacher_id))
        {
            foreach($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id, $request->exam_id, $teacher_id);

                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $data = new AssignClassTeacher;
                    $data->class_id = $request->class_id;
                    $data->exam_id = $request->exam_id;
                    $data->teacher_id = $teacher_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }

                
            }

        }
        return redirect()->route('assign_class_teacher.list')->with('success', 'Teacher Successfully Assigned to Class');

        
    }


    public function editSingle($id)
    {
        $getRecord = AssignClassTeacher::getSingle($id);

        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getExam'] = Exam::getExam();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = "Edit Assigned Class Teacher";
            return view('admin.assign_class_teacher.edit_single', $data);
        }
        else
        {
            abort(404);
        }
    
    }


    public function updateSingle(Request $request, $id)
    {
        $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id, $request->exam_id, $request->teacher_id);

        if(!empty($getAlreadyFirst))
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();

            return redirect()->route('assign_class_teacher.list')->with('success', 'Status Successfully Updated');
        }
        else
        {
            $data = AssignClassTeacher::getSingle($id);
            $data->class_id = $request->class_id;
            $data->exam_id = $request->exam_id;
            $data->teacher_id = $request->teacher_id;
            $data->status = $request->status;
            $data->save();

            return redirect()->route('assign_class_teacher.list')->with('success', 'Teacher Successfully Updated to Class');
        }

        
        
    
    }
 


    public function delete($id)
    {
        $data = AssignClassTeacher::getSingle($id);
        // $data->delete();
        $data->forceDelete();
       

        return redirect()->back()->with('success', 'Record Successfully Deleted!');
    }





    //TEACHER SIDE

    public function myClassSubject()
    {
        $data['getRecord'] = AssignClassTeacher::getMyClassSubject(Auth::user()->id);

        $data['header_title'] = "My Class Subject";
        return view('teacher.my_class_subject', $data);
        
    }






}
