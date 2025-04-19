<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\Award;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{
    public function view(Request $request)
    {
        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 4 || Auth::user()->user_type == 'Parent')
        {
            $data['getClass'] = ClassModel::getClass();
            $data['getExam'] = Exam::getExam();
        }
        elseif(Auth::user()->user_type == 2) 
        {
            $data['getClass'] = AssignClassTeacher::getTeacherClassList(Auth::user()->id);
            $data['getExam'] = AssignClassTeacher::getTeacherTermList(Auth::id());
        }
        else {
            '';
        }

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }

        //To fetch award chart data from the db
        if (!empty($data['getStudent']) && $data['getStudent']->count() > 0) 
        {
            $awards = []; // Array to store Awards

            foreach ($data['getStudent'] as $value) {
                $record = Award::where('exam_id', $request->exam_id)
                    ->where('class_id', $request->class_id)
                    ->where('student_id', $value->id)
                    ->first();
                // Add Award record to the array
                $awards[$value->id] = $record;
            }
            
            // Pass the award records array to the view
            $data['awards'] = $awards;
        }


        $data['getParentStudent'] = User::getParentStudents($request->get('class_id'), $request->get('exam_id'), Auth::user()->id);


        $data['header_title'] = "Awards";
        
        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return view('admin.award.view', $data);
        }
        elseif(Auth::user()->user_type == 2) 
        {
            return view('teacher.award.view', $data);
        }
        else
        {
            return view('parent.award.view', $data);
        }
    }


    public function awardSubmit(Request $request)
    {
        // dd($request->all());
        $getAward = Award::checkAlreadyExisting($request->class_id, $request->exam_id, $request->student_id);

        if($getAward)        
        {
            $award = $getAward;
        }
        else
        {
            $award               = new Award();
            $award->created_by   = Auth::user()->id;
        }
        
        $award->class_id                         = $request->class_id;
        $award->exam_id                          = $request->exam_id;
        $award->student_id                       = $request->student_id;
        
        
        $award->early_bird                       = $request->early_bird;
        $award->neatest_pupil                    = $request->neatest_pupil;
        $award->best_behaved_pupil               = $request->best_behaved_pupil;
                
        $award->save();

        return redirect()->back()->with('success', 'Student Award Given Successfully!');
    }


    public function viewSingle(Request $request)
    {
        $data['getStudent'] = User::getSingle($request->student_id);

        $data['getAwards'] = Award::where('class_id', $request->class_id)->where('exam_id', $request->exam_id)->where('student_id', $request->student_id)->first();

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);
        $data['getSingleExamName'] = Exam::getSingleExamName($request->exam_id);

        $data['header_title'] = "View Award";

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return view('admin.award.view_single', $data);
        }
        elseif(Auth::user()->user_type == 2) 
        {
            return view('teacher.award.view_single', $data);
        }
        else
        {
            return view('parent.award.view_single', $data);
        }
        
    }



    public function printEarlyBird(Request $request)
    {
        $data['getSetting'] = Setting::getSingle();
        $data['getStudent']  = User::getSingle($request->student_id);
        $data['getClass'] = ClassModel::getSingleClassName($request->class_id);
        $data['getExam'] = Exam::getSingleExamName($request->exam_id);
        $data['getHeadTeacher'] = User::where('user_type', 'School Admin')->first();
        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($request->class_id, $request->exam_id, $request->student_id);

        return view('admin.award.print_early_bird', $data);
    }


    public function printNeatestPupil(Request $request)
    {
        $data['getSetting'] = Setting::getSingle();
        $data['getStudent']  = User::getSingle($request->student_id);
        $data['getClass'] = ClassModel::getSingleClassName($request->class_id);
        $data['getExam'] = Exam::getSingleExamName($request->exam_id);
        $data['getHeadTeacher'] = User::where('user_type', 'School Admin')->first();
        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($request->class_id, $request->exam_id, $request->student_id);

        return view('admin.award.print_neatest_pupil', $data);
    }


    public function printBestBehavedPupil(Request $request)
    {
        $data['getSetting'] = Setting::getSingle();
        $data['getStudent']  = User::getSingle($request->student_id);
        $data['getClass'] = ClassModel::getSingleClassName($request->class_id);
        $data['getExam'] = Exam::getSingleExamName($request->exam_id);
        $data['getHeadTeacher'] = User::where('user_type', 'School Admin')->first();
        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($request->class_id, $request->exam_id, $request->student_id);

        return view('admin.award.print_best_behaved_pupil', $data);
    }



    




}
