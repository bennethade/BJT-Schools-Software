<?php

namespace App\Http\Controllers;

use App\Models\AssignStudent;
use App\Models\ClassFee;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\ExtraFee;
use App\Models\MarksRegister;
use App\Models\Setting;
use App\Models\StudentFees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeesCollectionController extends Controller
{
    public function collectFees(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        if(!empty($request->all()))
        {
            // $data['getRecord'] = User::getCollectFeesStudent(); //Tutor's Method

            $data['getRecord'] = AssignStudent::getAssignedClassStudent($request->class_id, $request->exam_id); //MINE
        }

        $data['header_title'] = "Collect Fees";
        return view('admin.fees_collection.collect_fees', $data);
    }



    public function collectFeesReport()
    {
        $data['getClass'] = ClassModel::getClass();

        
        $data['getRecord'] = StudentFees::getRecord();
        $data['header_title'] = "Collect Fees Report";
        return view('admin.fees_collection.collect_fees_report', $data);
    }



    public function addFeesCollection($student_id)
    {
        $data['getFees'] = StudentFees::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Add Collect Fees";
        $data['paid_amount'] = StudentFees::getPaidAmount($student_id, $getStudent->class_id);
        return view('admin.fees_collection.add_collect_fees', $data);
    }


    public function addFeesInsert(Request $request, $student_id)
    {
        $getStudent = User::getSingleClass($student_id);

        $paid_amount = StudentFees::getPaidAmount($student_id, $getStudent->class_id);

        if(!empty($request->amount))
        {
            $remainingAmount = $getStudent->amount - $paid_amount;

            if($remainingAmount >= $request->amount)
            {
                $remaining_amount_user = $remainingAmount - $request->amount;
    
                $payment = new StudentFees;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $remainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->is_paid = 1;
                $payment->created_by = Auth::user()->id;
                $payment->save();
    
                return redirect()->back()->with('success', 'Fees Successfully Added!');
            }
            else
            {
                return redirect()->back()->with('error', 'The amount you entered is greater than the remaining amount to be paid');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please add an amount greater than N1.00');
        }
        
    }



    //Student Side
    public function collectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;

        $data['getFees'] = StudentFees::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['header_title'] = "Fees Collection";

        $data['paid_amount'] = StudentFees::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        return view('student.my_fees_collection', $data);
    }


    public function collectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);

        $paid_amount = StudentFees::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        if(!empty($request->amount))
        {
            $remainingAmount = $getStudent->amount - $paid_amount;

            if($remainingAmount >= $request->amount)
            {
                $remaining_amount_user = $remainingAmount - $request->amount;
    
                $payment = new StudentFees;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $remainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = Setting::getSingle();

                if($request->payment_type == 'Paypal')
                {
                    $query = array();
                    $query['business']          =   $getSetting->paypal_email;
                    $query['cmd']               =   '_xclick';
                    $query['item_name']         =   "Student Fees";
                    $query['no_shipping']       =   '1';
                    $query['item_number']       =   $payment->id;
                    $query['amount']            =   $request->amount;
                    $query['currency_code']     =   'NGN';
                    $query['cancel_return']     =   url('student/paypal/payment-error');
                    $query['return']            =   url('student/paypal/payment-success');

                    $query_string = http_build_query($query);
                    

                    // header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    exit();

                }
                elseif($request->payment_type == 'Stripe')
                {

                }

                // return redirect()->back()->with('success', 'Fees Successfully Paid!');
            }
            else
            {
                return redirect()->back()->with('error', 'The amount you entered is greater than the remaining amount to be paid'); 
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please add an amount greater than N1');
        }

    }



    public function paymentError()
    {
        return redirect('student/fees_collection')->with('error', 'Payment not initiated. Please try again');
    }


    public function paymentSuccess(Request $request)
    {
        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $fees = StudentFees::getSingle($request->item_number);
            if(!empty($fees))
            {
                $fees->is_paid = 1;
                $fees->payment_data = json_encode($request->all());
                $fees->save();

                return redirect('student/fees_collection')->with('success', 'Payment Successfully Made!!!');
            }
            else
            {
                return redirect('student/fees_collection')->with('error', 'Payment not initiated due to some errors Please try again');
            }
        }
        else
        {
            return redirect('student/fees_collection')->with('error', 'Payment not initiated due to some errors Please try again');
        }
    }



    public function classFeeView(Request $request)
    {
        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('exam_id')))
        {
            $data['getClass'] = ClassModel::getClass();
        }

        // To fetch Class Fee Data from the db
        if (!empty($data['getClass'])) {

            $classFeeRecord = []; 

            foreach ($data['getClass'] as $value) {
                $record = ClassFee::where('exam_id', $request->exam_id)->where('class_id', $value->id)->first();
                $classFeeRecord[$value->id] = $record;
            }
            
            $data['classFeeRecord'] = $classFeeRecord;
        }
        
        $data['header_title'] = "Class Fee View";
        return view('admin.fees_collection.class_fees.class_fee_view', $data);
    }


    public function classFeeSubmit(Request $request)
    {
        // dd($request->all());

        $getFee = ClassFee::checkAlreadyExistingData($request->class_id, $request->exam_id);

        if($getFee)        
        {
            $fee = $getFee;
        }
        else
        {
            $fee               = new ClassFee();
            $fee->created_by   = Auth::user()->id;
        }

        $fee->class_id = $request->class_id;
        $fee->exam_id = $request->exam_id;
        $fee->tuition_fee = $request->tuition_fee;
        $fee->save();

        return redirect()->back()->with('success', 'Class Fee Inserted Successfully!');

    }


    public function extraFeesView(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }

        //To fetch Extra Fee data from the db
        if (!empty($data['getStudent']) && $data['getStudent']->count() > 0) {
            $extraFeeRecords = []; 

            foreach ($data['getStudent'] as $value) {
                $record = ExtraFee::where('exam_id', $request->exam_id)
                    ->where('class_id', $request->class_id)
                    ->where('student_id', $value->id)
                    ->first();

                $extraFeeRecords[$value->id] = $record;
            }
            
            $data['extraFeeRecords'] = $extraFeeRecords;
        }
        
        $data['header_title'] = "Extra Fees";
        return view('admin.fees_collection.class_fees.extra_fee_view', $data);
    }




    public function extraFeesSubmit(Request $request)
    {
        // dd($request->all());
        $getExtraFee = ExtraFee::checkAlreadyExistingData($request->class_id, $request->exam_id, $request->student_id);

        if($getExtraFee)        
        {
            $fee = $getExtraFee;
        }
        else
        {
            $fee               = new ExtraFee();
            $fee->created_by   = Auth::user()->id;
        }

        $fee->student_id                        = $request->student_id;
        $fee->class_id                          = $request->class_id;
        $fee->exam_id                           = $request->exam_id;
        
        $fee->outstanding                       = $request->outstanding;
        $fee->resources                         = $request->resources;
        $fee->after_school_care                 = $request->after_school_care;
        $fee->uniform                           = $request->uniform;
        $fee->club                              = $request->club;
        $fee->school_lunch                      = $request->school_lunch;
        $fee->school_bus                        = $request->school_bus;
        $fee->end_of_session                    = $request->end_of_session;
        $fee->miscellaneous                     = $request->miscellaneous;
        $fee->discount                          = $request->discount;


        $tuition = ClassFee::where('class_id', $request->class_id)->where('exam_id', $request->exam_id)->pluck('tuition_fee')->first();

        $fee->tuition_fee = $tuition;  //For the db field

        $fee->subtotal  =   $tuition + $request->outstanding + $request->resources + $request->after_school_care + $request->uniform + $request->club + $request->school_lunch + $request->school_bus + $request->end_of_session + $request->miscellaneous; 
        
        $discountedTuition =  $tuition - ((($request->discount) / 100) * $tuition); //For discount calculation on the tuition amount

        $grandTotal = $discountedTuition + $request->outstanding + $request->resources + $request->after_school_care + $request->uniform + $request->club + $request->school_lunch + $request->school_bus + $request->end_of_session + $request->miscellaneous;

        $fee->grand_total = $grandTotal; //For the db field


        $fee->save();

        return redirect()->back()->with('success', "Student's Extra Inserted Successfully!");
    }


    public function feesBreakdown(Request $request)
    {
        // dd($request->all());

        $exam_id = $request->exam_id;
        $student_id = $request->student_id;

        if(!empty($exam_id) && !empty($student_id))
        {
            $data['getStudent'] = User::getSingle($student_id);

            // $data['getClass'] = MarksRegister::getClass($exam_id, $student_id);

            $data['getClass'] = ExtraFee::getClass($exam_id, $student_id);

            $data['getExamName'] = AssignStudent::getSingleExamName($exam_id);

            $data['getFees'] = ExtraFee::getStudentFees($exam_id, $student_id);

            $data['getParent'] = AssignStudent::getStudentParent($student_id);

            $data['getSetting'] = Setting::getSingle();
        }

        return view('admin.fees_collection.class_fees.fees_breakdown', $data);
    }








}
