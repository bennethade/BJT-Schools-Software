<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Club::getRecord();

        $data['header_title'] = "Club List";
        return view('admin.club.list', $data);
    }



    public function add()
    {
        $data['header_title'] = "Add Club";
        return view('admin.club.add', $data);
    }




    public function insert(Request $request)
    {
        $request->validate([
            'name'  =>  'string|required',
            'amount' => 'integer|required'
        ]);

        $club                   =   new Club;
        $club->name             =   $request->name;
        $club->description      =   $request->description;
        $club->amount           =   $request->amount;
        $club->status           =   $request->status;
        $club->created_by       =   Auth::user()->id;
        $club->save();

        return redirect()->route('club.list')->with('success', 'Club Saved Successfully!');
    }

    

    public function edit($id)
    {
        $data['getRecord'] = Club::findOrFail($id);

        $data['header_title'] = "Edit Club";
        return view('admin.club.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  =>  'string|required',
            'amount' => 'integer|required'
        ]);

        $club                   =   Club::findOrFail($id);
        $club->name             =   $request->name;
        $club->description      =   $request->description;
        $club->amount           =   $request->amount;
        $club->status           =   $request->status;
        // $club->created_by       =   Auth::user()->id;
        $club->save();

        return redirect()->route('club.list')->with('success', 'Club Updated Successfully!');
    }


    public function delete($id)
    {
        $club = Club::findOrFail($id);
        $club->delete();

        return redirect()->back()->with('success', 'Club Deleted Successfully!');
    }



    public function parentClubView()
    {
        $data['getRecord'] = Club::getRecordParent();
        $data['header_title'] = "School CLub";
        return view('parent.club.view', $data);
    }












}
