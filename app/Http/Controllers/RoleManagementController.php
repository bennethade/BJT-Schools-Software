<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function show()
    {
        $data['getStaff'] = User::where('user_type', 2)
                            ->orWhere('user_type', 'Teacher')
                            ->orWhere('user_type', 'Principal')
                            ->orWhere('user_type', 'Vice Principal')
                            ->orWhere('user_type', 'Secretary')
                            ->orWhere('user_type', 'Accountant')
                            ->orWhere('user_type', 'Human Resources')
                            ->orWhere('user_type', 'Librarian')
                            ->where('status', 0)->get();
        $data['getRole'] = Designation::all();

        $data['header_title'] = 'Role Managege';
        return view('admin.role_management.show', $data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:users,id',
            'role_name' => 'required|string|max:255',
        ]);

        $user = User::find($request->staff_id);

        if ($user) {
            $user->user_type = $request->role_name;
            $user->save();

            return redirect()->back()->with('success', 'User Designation/Role Updated Successfully!');
        }

        return redirect()->back()->with('error', 'User not found!');
    }







}
