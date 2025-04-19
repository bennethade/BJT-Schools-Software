<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentFees extends Model
{
    use HasFactory;


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    static public function getRecord()
    {
        $return = self::select('student_fees.*', 'classes.name as class_name', 'users.name as created_by', 'student.name as student_name', 'student.last_name as student_last_name', 'student.other_name as student_other_name')
                    ->join('classes', 'classes.id', '=', 'student_fees.class_id')
                    ->join('users as student', 'student.id', '=', 'student_fees.student_id')
                    ->join('users', 'users.id', '=', 'student_fees.created_by')
                    ->where('student_fees.is_paid', '=', 1);


                        if(!empty(Request::get('student_id')))
                        {
                            $return = $return->where('student_fees.student_id', '=', Request::get('student_id'));
                       
                        }


                        if(!empty(Request::get('student_name'))) {
                            $return = $return->where(function($query) {
                                $query->where('users.name', 'like', '%' . Request::get('student_name') . '%')
                                      ->orWhere('users.last_name', 'like', '%' . Request::get('student_name') . '%')
                                      ->orWhere('users.other_name', 'like', '%' . Request::get('student_name') . '%');
                            });
                        }
                        
                        // if(!empty(Request::get('student_name')))
                        // {
                        //     $return = $return->where('student.name', 'like', '%'.Request::get('student_name').'%');
                       
                        // }

                        if(!empty(Request::get('student_last_name')))
                        {
                            $return = $return->where('student.last_name', 'like', '%'.Request::get('student_last_name').'%');
                       
                        }

                        if(!empty(Request::get('class_id')))
                        {
                            $return = $return->where('student_fees.class_id', '=', Request::get('class_id'));
                       
                        }

                        if(!empty(Request::get('created_date_from')))
                        {
                            $return = $return->whereDate('student_fees.created_at', '>=', Request::get('created_date_from'));
                    
                        }



                        if(!empty(Request::get('created_date_to')))
                        {
                            $return = $return->whereDate('student_fees.created_at', '<=', Request::get('created_date_to'));
                    
                        }

                        if(!empty(Request::get('payment_type')))
                        {
                            $return = $return->where('student_fees.payment_type', '=', Request::get('payment_type'));
                       
                        }


        $return = $return->orderBy('student_fees.id', 'desc')
                            ->paginate(50);

        return $return;
    }



    static public function getFees($student_id)
    {
        return self::select('student_fees.*', 'classes.name as class_name', 'users.name as created_by')
                    ->join('classes', 'classes.id', '=', 'student_fees.class_id')
                    ->join('users', 'users.id', '=', 'student_fees.created_by')
                    ->where('student_fees.student_id', '=', $student_id)
                    ->where('student_fees.is_paid', '=', 1)
                    ->get();
    }



    static public function getPaidAmount($student_id, $class_id)
    {
        return self::where('student_fees.class_id', '=', $class_id)
                    ->where('student_fees.student_id', '=', $student_id)
                    ->where('student_fees.is_paid', '=', 1)
                    ->sum('student_fees.paid_amount');
    }




    
    static public function getTotalFees()
    {
        return self::where('student_fees.is_paid', '=', 1)
                    ->sum('student_fees.paid_amount');
    }


    static public function totalPaidAmountStudent($student_id)
    {
        return self::where('student_fees.is_paid', '=', 1)
                    ->where('student_fees.student_id', '=', $student_id)
                    ->sum('student_fees.paid_amount');
    }


    static public function totalPaidAmountStudentParent($student_ids)
    {
        return self::where('student_fees.is_paid', '=', 1)
                    ->whereIn('student_fees.student_id', $student_ids)
                    ->sum('student_fees.paid_amount');
    }



    static public function getTotalMonthFees()
    {
        return self::where('student_fees.is_paid', '=', 1)
                    ->whereMonth('student_fees.created_at', '=', date('m'))
                    ->sum('student_fees.paid_amount');
    }


    static public function getTotalTodayFees()
    {
        return self::where('student_fees.is_paid', '=', 1)
                    ->whereDate('student_fees.created_at', '=', date('Y-m-d'))
                    ->sum('student_fees.paid_amount');
    }


}
