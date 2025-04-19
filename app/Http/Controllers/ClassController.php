<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Class List";
        $data['getRecord'] = ClassModel::getRecord();
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Class";
        return view('admin.class.add', $data);
    }


    public function insert(Request $request)
    {
        $class = new ClassModel;
        $class->name = $request->name;
        $class->description = $request->description;
        $class->section = $request->section;
        $class->amount = $request->amount;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;
        $class->save();

        return redirect()->route('class.list')->with('success','Class Created Successfull');

        // dd($request->all());
    }


    public function edit($id)
    {
        // $data['getRecord'] = ClassModel::findOrFail($id);
        $data['getRecord'] = ClassModel::getSingle($id);
        
        $data['header_title'] = "Edit Class";
        return view('admin.class.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $class = ClassModel::getSingle($id);

        $class->name = $request->name;
        $class->description = $request->description;
        $class->section = $request->section;
        $class->amount = $request->amount;
        $class->status = $request->status;
        $class->save();

        return redirect()->route('class.list')->with('success','Class Updated Successfull');
    }


    public function delete($id)
    {
        $class = ClassModel::getSingle($id);
        $class->delete();
        // $class->is_delete = 1;
        // $class->save();

        return redirect()->route('class.list')->with('success','Class Deleted Successfull');
    }





}
