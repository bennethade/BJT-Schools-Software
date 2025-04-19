<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\AssignStudent;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\PTC;
use App\Models\Setting;
use App\Models\SubjectCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PTCController extends Controller
{
    public function ptcView(Request $request)
    {
        // $data['getClass'] = ClassModel::getClass();
        // $data['getExam'] = Exam::getExam();

        if(Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 1)
        {
            $data['getClass'] = ClassModel::getClass();
            $data['getExam'] = Exam::getExam();
        }else{
            $data['getClass'] = ClassModel::getMyClassList(Auth::user()->id);
            $data['getExam'] = Exam::getMyTermList(Auth::user()->id);
        }

        

        $data['getSingleExamName'] = Exam::getSingleExamName($request->get('exam_id'));

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->get('class_id'));


        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            if($data['getSingleClassName']->class_section == "Nursery School" )
            {
                $data['getSubject'] = ClassSubject::getAssignedClassSubject($request->class_id);
            }
            else
            {
                $data['getSubject'] = ExamSchedule::getExamSubject($request->get('exam_id'), $request->get('class_id'));
            }

            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }



        $data['header_title'] = "PTC";
        
        if(Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 1)
        {
            return view('admin.ptc.view', $data);
        }else{
            return view('teacher.ptc.view', $data);
        }

    }





    public function saveSinglePTC(Request $request)
    {
        // $id = $request->id;

        $comment     = !empty($request->comment) ? $request->comment : '';
     

        $getComment = PTC::checkExistingPTC( $request->class_id, $request->exam_id, $request->student_id,$request->subject_id);

        if(!empty($getComment))
        {
            $save = $getComment;
        }
        else
        {
            if(!empty($comment))
            {
                $save               = new PTC();
                $save->created_by   = Auth::user()->id;
            }
            
        }
        
        if(!empty($comment) )
        {
            $save->class_id             = $request->class_id;
            $save->exam_id              = $request->exam_id;
            $save->student_id           = $request->student_id;
            $save->subject_id           = $request->subject_id;
            $save->comment              = $comment;

        }
        

        $save->save();

        $json['message'] = "PTC FEEDBACK SUCCESSFULLY SAVED!";
        
        echo json_encode($json); 
    }



    public function ptcViewSingle(Request $request)
    {

        $data['getStudentPTC'] = PTC::getStudentPTC($request->class_id, $request->exam_id, $request->student_id);

        $data['getStudent'] = PTC::getStudent($request->student_id);
        // dd($data['getStudent']);

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);

        $data['getSingleExamName'] = Exam::getSingleExamName($request->exam_id);

        $data['getPTCGeneralComment'] = DB::table('ptc_general_comments')
                                            ->where([
                                                'class_id' => $request->class_id,
                                                'exam_id' => $request->exam_id,
                                                'student_id' => $request->student_id,
                                            ])->first();

        $data['header_title'] = "View PTC";
        if(Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 1)
        {
            return view('admin.ptc.view_single', $data);
        }
        else if(Auth::user()->user_type == '4' || Auth::user()->user_type == 'Parent')
        {
            return view('parent.ptc.view_single', $data);
        }
        else
        {
            return view('teacher.ptc.view_single', $data);
        }
    }



    public function ptcViewSingleUpdate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'class_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'student_id' => 'required|integer',
            'teacher_comment' => 'nullable|string', // Include the comments in validation
            'parent_comment' => 'nullable|string',
        ]);

        // Check if a record exists with the given class_id, exam_id, and student_id
        $ptc = DB::table('ptc_general_comments')
            ->where([
                ['class_id', '=', $request->class_id],
                ['exam_id', '=', $request->exam_id],
                ['student_id', '=', $request->student_id]
            ])->first();

        if($ptc) {
            // Update the existing record
            DB::table('ptc_general_comments')
                ->where('id', $ptc->id) 
                ->update([
                    'teacher_comment' => $request->teacher_comment,
                    'parent_comment' => $request->parent_comment,
                    'updated_at' => now(),
                    'updated_by' => Auth::user()->id, 
                ]);
        } else {
            // Insert a new record if it doesn't exist
            DB::table('ptc_general_comments')->insert([
                'class_id' => $request->class_id,
                'exam_id' => $request->exam_id,
                'student_id' => $request->student_id,
                'teacher_comment' => $request->teacher_comment,
                'parent_comment' => $request->parent_comment,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'PTC Comment Updated Successfully!');
    }
    


    public function ptcPrintSingle(Request $request)
    {
        $data['getStudent'] = PTC::getStudent($request->student_id);

        $data['getClass'] = AssignStudent::getStudentClass($request->exam_id, $request->student_id);

        $data['getExam'] = Exam::getSingle($request->exam_id);

        $data['getSetting'] = Setting::getSingle();

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);

        $data['getSingleExamName'] = Exam::getSingleExamName($request->exam_id);

        $data['getParent'] = AssignStudent::getStudentParent($request->student_id);

        $data['getClassTeacher'] = AssignClassTeacher::nurseryClassTeacher($request->class_id, $request->exam_id);

        
        $data['getStudentPTC'] = PTC::getStudentPTC($request->class_id, $request->exam_id, $request->student_id);


        $data['getPTCGeneralComment'] = DB::table('ptc_general_comments')
                                            ->where([
                                                'class_id' => $request->class_id,
                                                'exam_id' => $request->exam_id,
                                                'student_id' => $request->student_id,
                                            ])->first();


        //For Age Calculation
        $user = User::find($request->student_id); 
        if ($user) {
            $dateOfBirth = $user->date_of_birth; 

            $diff = strtotime('now') - strtotime($dateOfBirth);
            
            $age = floor($diff / (60 * 60 * 24 * 365.25));
            $data['integerAge']  = (int)$age;

        } 
        else 
        {
            '';
        }



        return view('admin.ptc.print_ptc', $data);
    }


    public function parentPtcView(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();


        $data['getSingleExamName'] = Exam::getSingleExamName($request->get('exam_id'));

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->get('class_id'));


        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            if($data['getSingleClassName']->class_section == "Nursery School" )
            {
                $data['getSubject'] = ClassSubject::getAssignedClassSubject($request->class_id);
            }
            else
            {
                $data['getSubject'] = ExamSchedule::getExamSubject($request->get('exam_id'), $request->get('class_id'));
            }

            // $data['getStudent'] = User::getMyStudent(Auth::user()->id);  //NOT GOOD ENOUGH
            $data['getStudent'] = User::getParentStudents($request->get('class_id'), $request->get('exam_id'), Auth::user()->id);
        }



        $data['header_title'] = "PTC";
        
        
        return view('parent.ptc.view', $data);
        
    }



    public function parentUpdatePTC(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'class_id' => 'required|integer',
            'exam_id' => 'required|integer',
            'student_id' => 'required|integer',
            'parent_comment' => 'nullable|string',
        ]);

        // Check if a record exists with the given class_id, exam_id, and student_id
        $ptc = DB::table('ptc_general_comments')
            ->where([
                ['class_id', '=', $request->class_id],
                ['exam_id', '=', $request->exam_id],
                ['student_id', '=', $request->student_id]
            ])->first();

        if($ptc) {
            // Update the existing record
            DB::table('ptc_general_comments')
                ->where('id', $ptc->id) 
                ->update([
                    'parent_comment' => $request->parent_comment,
                    'updated_at' => now(),
                    'updated_by' => Auth::user()->id, 
                ]);
        } else {
            // Insert a new record if it doesn't exist
            DB::table('ptc_general_comments')->insert([
                'class_id' => $request->class_id,
                'exam_id' => $request->exam_id,
                'student_id' => $request->student_id,
                'parent_comment' => $request->parent_comment,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'PTC Comment Updated Successfully!');
    }








}
