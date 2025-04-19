<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Assign Subject List";

        $data['getRecord'] = ClassSubject::getRecord();
        return view('admin.assign_subject.list', $data);
    }


    public function add()
    {
        $data['header_title'] = "Assign New Subejct";

        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        // dd($request->all());

        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);

                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $data = new ClassSubject;
                    $data->class_id = $request->class_id;
                    $data->subject_id = $subject_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }

                
            }

            return redirect()->route('assign_subject.list')->with('success', 'Subject Successfully Assigned to Class');
        }
        else
        {
            return redirect()->back()->with('error', 'Error! </br> Please Try Again with the right details');
        }
    }



    public function editSingle($id)
    {
        $getRecord = ClassSubject::getSingle($id);

       
        $data['header_title'] = "Edit Assigned Subejct";

        $data['getRecord'] = $getRecord;

        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = Subject::getSubject();
        return view('admin.assign_subject.edit_single', $data);
    
    }


    public function updateSingle(Request $request, $id)
    {
        $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $request->subject_id);

        if(!empty($getAlreadyFirst))
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();

            return redirect()->route('assign_subject.list')->with('success', 'Status Successfully Updated');
        }
        else
        {
            $data = ClassSubject::getSingle($id);
            $data->class_id = $request->class_id;
            $data->subject_id = $request->subject_id;
            $data->status = $request->status;
            $data->save();

            return redirect()->route('assign_subject.list')->with('success', 'Subject Successfully Assigned to Class');
        }

        
        
    
    }




    public function massEdit($id)
    {
        $getRecord = ClassSubject::getSingle($id);

        if(!empty($getRecord))
        {
            $data['header_title'] = "Edit Assigned Subejct";

            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId'] = ClassSubject::getAssignSubjectId($getRecord->class_id);

            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('admin.assign_subject.mass_edit', $data);
        }
        else
        {
            abort(404);
        }
        
    }


    public function massUpdate(Request $request)
    {
        ClassSubject::deleteSubject($request->class_id);

        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id, $subject_id);

                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $data = new ClassSubject;
                    $data->class_id = $request->class_id;
                    $data->subject_id = $subject_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }

                
            }

        }

        return redirect()->route('assign_subject.list')->with('success', 'Subject Successfully Assigned to Class');

    }


    public function delete($id)
    {
        $data = ClassSubject::getSingle($id);
        // $data->is_delete = 1;
        // $data->save();
        // $data->delete();
        $data->forceDelete();

        return redirect()->back()->with('success', 'Record Successfully Deleted!');
    }


    





}
