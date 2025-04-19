<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Humanresource extends Model
{
    use HasFactory;

    static public function getRecord()
    {
        $return = self::select('humanresources.*', 'users.name as staff_name', 'users.last_name as staff_last_name', 'users.other_name as staff_other_name', 'created_by.name as created_by_name', 'created_by.last_name as created_by_last_name')
                        ->join('users', 'users.id', '=', 'humanresources.staff_id')
                        ->join('users as created_by', 'created_by.id', '=', 'humanresources.created_by')
                        ->where('humanresources.status', '=', 'Approved')->orWhere('humanresources.status', '=', 'Rejected');

                        //SEARCH FEATURE STARTS

                        if(!empty(Request::get('staff_name')))
                        {
                            $return = $return->where('users.name', 'like', '%' . Request::get('staff_name'). '%')->orWhere('users.last_name', 'like', '%' . Request::get('staff_name'). '%')->orWhere('users.other_name', 'like', '%' . Request::get('staff_name'). '%');
                            
                        }

                        if(!empty(Request::get('leave_purpose')))
                        {
                            $return = $return->where('humanresources.leave_purpose', 'like', '%' . Request::get('leave_purpose'). '%');
                            
                        }

                        // if(!empty(Request::get('purchase_date')))
                        // {
                        //     $return = $return->whereDate('procurements.purchase_date', '=', Request::get('purchase_date'));
                        // }
                        

                        
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('id', 'desc')
                        ->paginate(50);

        return $return;
    }



    static public function getLeaveRequests()
    {
        return self::select('humanresources.*', 'users.name as staff_name', 'users.last_name as staff_last_name', 'users.other_name as staff_other_name')
                        ->join('users', 'users.id', '=', 'humanresources.staff_id')
                        ->where('humanresources.status', '=', 'Pending')
                        ->orderBy('id', 'desc')
                        ->paginate(50);

    }



    static public function getTeacherLeave($teacher_id)
    {
        $return = self::select('humanresources.*', 'users.name as staff_name', 'users.last_name as staff_last_name', 'users.other_name as staff_other_name')
                        ->join('users', 'users.id', '=', 'humanresources.staff_id')
                        ->where('humanresources.staff_id', '=', $teacher_id);

                        //SEARCH FEATURE STARTS

                        if(!empty(Request::get('leave_purpose')))
                        {
                            $return = $return->where('humanresources.leave_purpose', 'like', '%' . Request::get('leave_purpose'). '%');
                            
                        }

                        
                        //SEARCH FEATURE ENDS
                        
        $return = $return->orderBy('id', 'desc')
                        ->paginate(50);

        return $return;
    }






}
