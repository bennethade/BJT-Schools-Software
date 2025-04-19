<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Suggestion::getRecord();

        $data['header_title'] = "Suggestion Box";
        return view('admin.suggestion.list', $data);
    }
    
    


    public function add()
    {
        $data['header_title'] = "Add Suggestion";
        return view('admin.suggestion.add', $data);
    }
    


    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = new Suggestion();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = 1;
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect()->route('suggestion.list')->with('success', 'Suggestion Sent Successfully!');

    }
    


    public function edit($id)
    {
        $data['getRecord'] = Suggestion::findOrFail($id);
        
        $data['header_title'] = "Edit Suggestion";
        return view('admin.suggestion.edit', $data);
    }

    
    public function update(request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = Suggestion::findOrFail($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        
        return redirect()->route('suggestion.list')->with('success', 'Suggestion/Feedback Updated Succesfully!');
    }




    //FOR OTHER USERS DASHBOARD

    public function userSuggestionList()
    {
        $data['getRecord'] = Suggestion::userGetRecord(Auth::user()->id);

        $data['header_title'] = "Suggestion Box";

        if(Auth::user()->user_type == 4)
        {
            return view('parent.suggestion.list', $data);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.suggestion.list', $data);
        }
        else
        {
            return view('teacher.suggestion.list', $data);
        }

    }


    public function userSuggestionAdd()
    {
        $data['header_title'] = "Add Suggestion";
        
        if(Auth::user()->user_type == 4)
        {
            return view('parent.suggestion.add', $data);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.suggestion.add', $data);
        }
        else
        {
            return view('teacher.suggestion.add', $data);
        }

    }


    public function userSuggestionInsert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = new Suggestion();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = 1;
        $data->created_by = Auth::user()->id;
        $data->save();

        if(Auth::user()->user_type == 4)
        {
            return redirect()->route('parent.suggestion.list')->with('success', 'Suggestion Sent Successfully!');
        }

        if(Auth::user()->user_type == 3)
        {
            return redirect()->route('student.suggestion.list')->with('success', 'Suggestion Sent Successfully!');
        }

        else
        {
            return redirect()->route('teacher.suggestion.list')->with('success', 'Suggestion Sent Successfully!');
        }

        

    }



    //END FOR OTHER USERS DASHBOARD




    
}
