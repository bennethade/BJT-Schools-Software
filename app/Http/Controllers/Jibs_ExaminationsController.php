<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\AssignStudent;
use App\Models\BehaviorChart;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\GoalRegister;
use App\Models\MarksGrade;
use App\Models\MarksRegister;
use App\Models\NurseryMidTermGoalRegister;
use App\Models\NurseryMidtermSubject;
use App\Models\NurserySubject;
use App\Models\NurserySubjectComment;
use App\Models\Setting;
use App\Models\StudentSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class ExaminationsController extends Controller
{
    public function examList()
    {
        $data['getRecord'] = Exam::getRecord();

        $data['header_title'] = "Exam List";
        return view('admin.examinations.exam.list', $data);
    }



    public function examAdd()
    {
        $data['header_title'] = "Add New Exam";
        return view('admin.examinations.exam.add', $data);
    }


    public function examInsert(Request $request)
    {
        // dd($request->all());

        $exam = new Exam();
        $exam->name                             = trim($request->name);
        $exam->session                          = trim($request->exam_session);
        $exam->note                             = trim($request->note);
        $exam->no_of_times_school_opened	    = trim($request->no_of_times_school_opened);


        
        if(!empty($request->file('school_stamp')))
        {
            $ext = $request->file('school_stamp')->getClientOriginalExtension();
            $file = $request->file('school_stamp');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/school_stamp/', $filename);       //Tutor's Line

            $file = Image::read($request->file('school_stamp'));     //Image Intervention Lines
            $file->resize(500, 400);
            $file->save('upload/school_stamp/'.$filename); 

            $exam->school_stamp = $filename;      //For the DB Fields
        }


        $exam->this_term_commenced	            = trim($request->this_term_commenced);
        $exam->this_term_ends	                = trim($request->this_term_ends);
        $exam->next_term_begins                 = trim($request->next_term_begins);
        $exam->jss1_number                      = trim($request->jss1_number);
        $exam->jss2_number                      = trim($request->jss2_number);
        $exam->jss3_number                      = trim($request->jss3_number);
        $exam->sss1_number                      = trim($request->sss1_number);
        $exam->sss2_number                      = trim($request->sss2_number);
        $exam->sss3_number                      = trim($request->sss3_number);
        $exam->grade1_number                    = trim($request->grade1_number);
        $exam->grade2_number                    = trim($request->grade2_number);
        $exam->grade3_number                    = trim($request->grade3_number);
        $exam->grade4_number                    = trim($request->grade4_number);
        $exam->grade5_number                    = trim($request->grade5_number);
        $exam->grade6_number                    = trim($request->grade6_number);

        $exam->explorer2_number                 = trim($request->explorer2_number);
        $exam->explorer1_number                 = trim($request->explorer1_number);
        $exam->pre_nursery_number               = trim($request->pre_nursery_number);
        $exam->play_pen_number                  = trim($request->play_pen_number);

        $exam->created_by                       = Auth::user()->id;
        $exam->save();

        return redirect()->route('examinations.list')->with('success', 'Exam Successfully Created!');
    }


    public function examEdit($id)
    {
        $data['getRecord'] = Exam::getSingle($id);

        $data['header_title'] = "Edit Exam";
        return view('admin.examinations.exam.edit', $data);
    }



    public function examUpdate(Request $request, $id)
    {
        $exam                                   = Exam::getSingle($id);
        $exam->name                             = trim($request->name);
        $exam->session                          = $request->exam_session;
        $exam->note                             = trim($request->note);
        $exam->no_of_times_school_opened	    = trim($request->no_of_times_school_opened	);


        if(!empty($request->file('school_stamp')))
        {
            if(!empty($exam->getSchoolStamp()))
            {
                unlink('upload/school_stamp/'.$exam->school_stamp);
            }

            $ext = $request->file('school_stamp')->getClientOriginalExtension();
            $file = $request->file('school_stamp');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/school_stamp/', $filename);       //Tutor's Line

            $file = Image::read($request->file('school_stamp'));     //Image Intervention Lines
            $file->resize(500, 400);
            $file->save('upload/school_stamp/'.$filename); 

            $exam->school_stamp = $filename;      //For the DB Fields
        }


        $exam->this_term_commenced	            = trim($request->this_term_commenced	);
        $exam->this_term_ends	                = trim($request->this_term_ends	);
        $exam->next_term_begins                 = trim($request->next_term_begins);
        $exam->jss1_number                      = trim($request->jss1_number);
        $exam->jss2_number                      = trim($request->jss2_number);
        $exam->jss3_number                      = trim($request->jss3_number);
        $exam->sss1_number                      = trim($request->sss1_number);
        $exam->sss2_number                      = trim($request->sss2_number);
        $exam->sss3_number                      = trim($request->sss3_number);
        $exam->grade1_number                    = trim($request->grade1_number);
        $exam->grade2_number                    = trim($request->grade2_number);
        $exam->grade3_number                    = trim($request->grade3_number);
        $exam->grade4_number                    = trim($request->grade4_number);
        $exam->grade5_number                    = trim($request->grade5_number);
        $exam->grade6_number                    = trim($request->grade6_number);

        $exam->explorer2_number                 = trim($request->explorer2_number);
        $exam->explorer1_number                 = trim($request->explorer1_number);
        $exam->pre_nursery_number               = trim($request->pre_nursery_number);
        $exam->play_pen_number                  = trim($request->play_pen_number);

        $exam->save();

        return redirect()->route('examinations.list')->with('success', 'Exam Successfully Updated!');
    }





    public function examDelete($id)
    {
        $exam = Exam::getSingle($id);
        $exam->delete();

        return redirect()->back()->with('success', 'Exam Successfully Deleted!');
    }



    public function examSchedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        $result = array();

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $getSubject = ClassSubject::mySubject_ByTutor($request->get('class_id'));
            foreach($getSubject as $value)
            {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;

                $examSchedule = ExamSchedule::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);
                if(!empty($examSchedule))
                {
                    $dataS['exam_date'] = $examSchedule->exam_date;
                    $dataS['start_time'] = $examSchedule->start_time;
                    $dataS['end_time'] = $examSchedule->end_time;
                    $dataS['room_number'] = $examSchedule->room_number;
                    $dataS['full_mark'] = $examSchedule->full_mark;
                    $dataS['pass_mark'] = $examSchedule->pass_mark;
                }
                else
                {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['pass_mark'] = '';
                }

                $result[] = $dataS;
            }
        }

        // dd($result); 
        $data['getRecord'] = $result;



        $data['header_title'] = "Exam Schedule";
        return view('admin.examinations.exam_schedule', $data);
    }



    public function examScheduleInsert(Request $request)
    {
        // dd($request->all());

        ExamSchedule::deleteRecord($request->exam_id, $request->class_id); 

        if(!empty($request->schedule))
        {
            foreach($request->schedule as $schedule)
            {
                // dd($schedule['subject_id']);

                // if(!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) && !empty($schedule['full_mark']) && !empty($schedule['pass_mark']))
                if(!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) )
                {
                    $exam = new ExamSchedule;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->room_number = $schedule['room_number'];
                    // $exam->full_mark = $schedule['full_mark'];
                    // $exam->pass_mark = $schedule['pass_mark'];
                    $exam->full_mark = 100;
                    $exam->pass_mark = 40;
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
 
            }
        }

        return redirect()->back()->with('success', 'Exam Schedule Successfully Saved!');

    }




    public function marksRegister(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        

        $data['getSingleExamName'] = Exam::getSingleExamName($request->get('exam_id'));

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->get('class_id'));


        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            // $data['getSubject'] = ExamSchedule::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getSubject'] = ExamSchedule::getExamSubject($request->get('exam_id'), $request->get('class_id'));

            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));

        }

        $data['header_title'] = "Marks Register";
        
        if(Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 1)
        {
            return view('admin.examinations.marks_register', $data);
        }else{
            return view('other_roles.marks_register', $data);
        }
    }





    //FOR TEACHER
    public function marksRegisterTeacher(Request $request)
    {
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id); //This line get only the class assigned to a teacher
        $data['getExam'] = ExamSchedule::getExamTeacher(Auth::user()->id);

        $data['getSingleExamName'] = Exam::getSingleExamName($request->get('exam_id'));

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->get('class_id'));


        
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getSubject'] = ExamSchedule::getSubject($request->get('exam_id'), $request->get('class_id'));

            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
            // dd($data['getStudent']);
        }

        $data['header_title'] = "Marks Register";
        return view('teacher.marks_register', $data);
    }



    public function submitMarksRegister(Request $request)
    {
        $validation = 0;
        if(!empty($request->mark))
        {
            foreach($request->mark as $mark)
            {
                $getExamSchedule = ExamSchedule::getSingle($mark['id']);
                $full_mark = $getExamSchedule->full_mark;


                $ca                         = !empty($mark['ca']) ? $mark['ca'] : 0;
                $home_fun                   = !empty($mark['home_fun']) ? $mark['home_fun'] : 0;
                $attendance                 = !empty($mark['attendance']) ? $mark['attendance'] : 0;
                $class_work                 = !empty($mark['class_work']) ? $mark['class_work'] : 0;
                $ca2                        = !empty($mark['ca2']) ? $mark['ca2'] : 0;
                $exam                       = !empty($mark['exam']) ? $mark['exam'] : 0;
                $teacher_remark             = !empty($mark['teacher_remark']) ? $mark['teacher_remark'] : '';

                // $full_mark               = !empty($mark['full_mark']) ? $mark['full_mark'] : 0;
                // $pass_mark               = !empty($mark['pass_mark']) ? $mark['pass_mark'] : 0;

                $full_mark                  = $getExamSchedule->full_mark;
                $pass_mark                  = $getExamSchedule->pass_mark;


                $total_mark = $ca + $home_fun +$attendance +$class_work +$ca2 + $exam;

                if($full_mark >= $total_mark)
                {
                    $getMark = MarksRegister::checkAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
                    if(!empty($getMark))
                    {
                        $save = $getMark;
                        echo json_encode(['message' => 'Score Updated Successfully!']);
                    }
                    else
                    {
                        $save               = new MarksRegister;
                        $save->created_by   = Auth::user()->id;

                        $save->student_id           = $request->student_id;
                        $save->exam_id              = $request->exam_id;
                        $save->class_id             = $request->class_id;
                        $save->subject_id           = $mark['subject_id'];
                        $save->ca                   = $ca;
                        $save->home_fun             = $home_fun;
                        $save->attendance           = $attendance;
                        $save->class_work           = $class_work;
                        $save->ca2                  = $ca2;
                        $save->exam                 = $exam;
                        $save->teacher_remark       = $teacher_remark;
                        $save->subject_total        = $total_mark;

                        $save->full_mark            = $full_mark;
                        $save->pass_mark            = $pass_mark;

                        $save->save();

                    }
                        
                      
                }
                else
                {
                    $validation = 1;
                }
                
            }
        }

        if($validation == 0)
        {
            $json['message'] = "Marks Successfully Saved";
        }
        else
        {
            $json['message'] = "Marks Saved Successfully!... But you need to cross-check, as one or more of your subject's total mark is currently greater than the expected full mark. HENCE, NOT SAVED!";
        }

        echo json_encode($json); 

    }

    //OLD FUNCTION TO SUBMIT MARKS
    // public function submitMarksRegister(Request $request)
    // {
    //     $validation = 0;
    //     if(!empty($request->mark))
    //     {
    //         foreach($request->mark as $mark)
    //         {
    //             $getExamSchedule = ExamSchedule::getSingle($mark['id']);
    //             $full_mark = $getExamSchedule->full_mark;


    //             $ca1     = !empty($mark['ca1']) ? $mark['ca1'] : 0;
    //             $ca2      = !empty($mark['ca2']) ? $mark['ca2'] : 0;
    //             $ca3           = !empty($mark['ca3']) ? $mark['ca3'] : 0;
    //             $exam           = !empty($mark['exam']) ? $mark['exam'] : 0;

    //             $full_mark           = !empty($mark['full_mark']) ? $mark['full_mark'] : 0;
    //             $pass_mark           = !empty($mark['pass_mark']) ? $mark['pass_mark'] : 0;


    //             $total_mark = $ca1 + $ca2 + $ca3 + $exam;

    //             if($full_mark >= $total_mark)
    //             {
    //                 $getMark = MarksRegister::checkAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
    //                 if(!empty($getMark))
    //                 {
    //                     $save = $getMark;
    //                 }
    //                 else
    //                 {
    //                     $save               = new MarksRegister;
    //                     $save->created_by   = Auth::user()->id;
                        
    //                 }
    //                 $save->student_id           = $request->student_id;
    //                 $save->exam_id              = $request->exam_id;
    //                 $save->class_id             = $request->class_id;
    //                 $save->subject_id           = $mark['subject_id'];
    //                 $save->ca1           = $ca1;
    //                 $save->ca2            = $ca2;
    //                 $save->ca3                 = $ca3;
    //                 $save->exam                 = $exam;
    //                 $save->subject_total        = $total_mark;

    //                 $save->full_mark    = $full_mark;
    //                 $save->pass_mark    = $pass_mark;

    //                 $save->save();
    //             }
    //             else
    //             {
    //                 $validation = 1;
    //             }
                
    //         }
    //     }

    //     if($validation == 0)
    //     {
    //         $json['message'] = "Marks Successfully Saved";
    //     }
    //     else
    //     {
    //         $json['message'] = "Marks Saved Successfully!... But you need to cross check, as one or more of your subject's total mark is currently greater than the expected full mark. HENCE, NOT SAVED!";
    //     }

    //     echo json_encode($json); 

    // }



    public function singleSubmitMarksRegister(Request $request)
    {
        $id = $request->id;
        $getExamSchedule = ExamSchedule::getSingle($id);

        $full_mark = $getExamSchedule->full_mark;

        $ca                 = !empty($request->ca) ? $request->ca : 0;
        $home_fun           = !empty($request->home_fun) ? $request->home_fun : 0;
        $attendance         = !empty($request->attendance) ? $request->attendance : 0;
        $class_work         = !empty($request->class_work) ? $request->class_work : 0;
        $ca2                = !empty($request->ca2) ? $request->ca2 : 0;
        $exam               = !empty($request->exam) ? $request->exam : 0;
        $teacher_remark     = !empty($request->teacher_remark) ? $request->teacher_remark : '';
        $ca_comment         = !empty($request->ca_comment) ? $request->ca_comment : '';

        $total_mark = $ca + $home_fun + $attendance + $class_work + $ca2 + $exam;

        if($full_mark >= $total_mark)
        {
            $getMark = MarksRegister::checkAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id);
            if(!empty($getMark))
            {
                $save = $getMark;
            }
            else
            {
                if(!empty($ca) || !empty($home_fun) || !empty($attendance) || !empty($class_work) || !empty($ca2) || !empty($exam))
                {
                    $save               = new MarksRegister;
                    $save->created_by   = Auth::user()->id;
                }
                
            }
            
            if(!empty($ca)  || !empty($home_fun) || !empty($attendance) || !empty($class_work) || !empty($ca2) || !empty($exam))
            {
                $save->student_id           = $request->student_id;
                $save->exam_id              = $request->exam_id;
                $save->class_id             = $request->class_id;
                $save->subject_id           = $request->subject_id;

                $save->ca                   = $ca;
                $save->home_fun             = $home_fun;
                $save->attendance           = $attendance;
                $save->class_work           = $class_work;
                $save->ca2                  = $ca2;
                $save->exam                 = $exam;
                $save->teacher_remark       = $teacher_remark;
                $save->ca_comment           = $ca_comment;

                $save->subject_total        = $total_mark;

                $save->full_mark            = $getExamSchedule->full_mark;
                $save->pass_mark            = $getExamSchedule->pass_mark;

            }
            

            $save->save();
    
            $json['message'] = "MARKS SUCCESSFULLY SAVED!";
        }
        else
        {
            $json['message'] = "Please check... Your total mark is currently greater than the expected full mark";
        }

        
        echo json_encode($json); 
   
    }

    //OLD FUNCTION FOR SINGLE SUBMIT
    // public function singleSubmitMarksRegister(Request $request)
    // {
    //     $id = $request->id;
    //     $getExamSchedule = ExamSchedule::getSingle($id);

    //     $full_mark = $getExamSchedule->full_mark;

    //     $ca1     = !empty($request->ca1) ? $request->ca1 : 0;
    //     $ca2     = !empty($request->ca2) ? $request->ca2 : 0;
    //     $ca3     = !empty($request->ca3) ? $request->ca3 : 0;
    //     $exam     = !empty($request->exam) ? $request->exam : 0;

    //     $total_mark = $ca1 + $ca2 + $ca3 + $exam;

    //     if($full_mark >= $total_mark)
    //     {
    //         $getMark = MarksRegister::checkAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id);
    //         if(!empty($getMark))
    //         {
    //             $save = $getMark;
    //         }
    //         else
    //         {
    //             $save               = new MarksRegister;
    //             $save->created_by   = Auth::user()->id;
                
    //         }
    //         $save->student_id   = $request->student_id;
    //         $save->exam_id      = $request->exam_id;
    //         $save->class_id     = $request->class_id;
    //         $save->subject_id   = $request->subject_id;
    //         $save->ca1   = $ca1;
    //         $save->ca2    = $ca2;
    //         $save->ca3         = $ca3;
    //         $save->exam         = $exam;
    //         $save->subject_total        = $total_mark;

    //         $save->full_mark    = $getExamSchedule->full_mark;
    //         $save->pass_mark    = $getExamSchedule->pass_mark;


    //         $save->save();
    
    //         $json['message'] = "Marks Column Successfully Saved";
    //     }
    //     else
    //     {
    //         $json['message'] = "Please check... Your total mark is currently greater than the expected full mark";
    //     }

        
    //     echo json_encode($json); 
   
    // }


    
    public function behaviorChart(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }

        //To fetch Behavior chart data from the db
        if (!empty($data['getStudent']) && $data['getStudent']->count() > 0) {
            $behaviorRecords = []; // Array to store behavior chart records

            foreach ($data['getStudent'] as $value) {
                $record = BehaviorChart::where('exam_id', $request->exam_id)
                    ->where('class_id', $request->class_id)
                    ->where('student_id', $value->id)
                    ->first();
                // Add behavior chart record to the array
                $behaviorRecords[$value->id] = $record;
            }
            
            // Pass the behavior records array to the view
            $data['behaviorRecords'] = $behaviorRecords;
        }
        

        $data['header_title'] = "Behavior Chart";
        return view('admin.examinations.behavior_chart', $data);
    }



    public function behaviorChartSubmit(Request $request)
    {
        // dd($request->all());
        $getChart = BehaviorChart::checkAlreadyBehaviorChart($request->student_id, $request->exam_id, $request->class_id);

        if($getChart)        
        {
            $behavior = $getChart;
        }
        else
        {
            $behavior               = new BehaviorChart();
            $behavior->created_by   = Auth::user()->id;
        }

        $behavior->student_id                       = $request->student_id;
        $behavior->exam_id                          = $request->exam_id;
        $behavior->class_id                         = $request->class_id;
        
        $behavior->generosity                       = $request->generosity;
        $behavior->punctuality                      = $request->punctuality;
        $behavior->class_attendance                 = $request->class_attendance;
        $behavior->responsibility_in_assignments    = $request->responsibility_in_assignments;
        $behavior->attentiveness                    = $request->attentiveness;
        $behavior->initiative                       = $request->initiative;
        $behavior->neatness                         = $request->neatness;
        $behavior->self_control                     = $request->self_control;
        $behavior->relationship_with_staff          = $request->relationship_with_staff;
        $behavior->relationship_with_students       = $request->relationship_with_students;
        $behavior->merits                           = $request->merits;
        $behavior->demerits_detention               = $request->demerits_detention;
        $behavior->class_tutor_comment              = $request->class_tutor_comment;
        $behavior->class_tutor_midterm_comment      = $request->class_tutor_midterm_comment;

        
        $behavior->save();

        return redirect()->back()->with('success', 'Behavior Inserted Successfully!');
    }





    public function nurseryGoals(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        if ($request->has('class_id') && $request->has('exam_id')) {
            $data['getStudentList'] = AssignStudent::getAssignedClassStudent($request->class_id, $request->exam_id);
            $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);
        } else {
            $data['getStudentList'] = [];
        }

        if (!empty($request->get('class_id')) && !empty($request->get('exam_id')) && !empty($request->get('student_id'))) {
            $data['getSubject'] = NurserySubject::getSubject($request->get('class_id'), $request->get('exam_id'));
            
            // Fetch existing goals for the student, class, and exam
            $data['existingGoals'] = GoalRegister::where([
                'class_id'      => $request->get('class_id'),
                'exam_id'       => $request->get('exam_id'),
                'student_id'    => $request->get('student_id'),
            ])->get()->keyBy('subject_id');
        } else {
            $data['getSubject'] = [];
            $data['existingGoals'] = [];
        }

        $data['header_title'] = "Nursery Goals";
        return view('admin.examinations.nursery_goals_register', $data);
    }


    




    public function ajax_get_student(Request $request)
    {
        // Validate request to avoid errors
        $request->validate([
            'class_id' => 'required|integer',
            'exam_id'  => 'required|integer',
        ]);

        $getStudent = AssignStudent::getNurseryGoalClassStudent($request->class_id, $request->exam_id);

        if ($getStudent->isEmpty()) {
            return response()->json(['success' => '<option value="">No students found</option>']);
        }

        $html = '<option value="">Select</option>';

        foreach ($getStudent as $value) {
            $html .= "<option value='".$value->student_id."'>".$value->user_name . ' ' . $value->user_last_name . ' ' . $value->user_other_name."</option>";
        }

        return response()->json(['success' => $html]);
    }



    public function saveSubjectGoal(Request $request)
    {
        // Validate the request
        $request->validate([
            'class_id'          => 'required|integer',
            'exam_id'           => 'required|integer',
            'student_id'        => 'required|integer',
            'subject_id'        => 'required|integer',
            'category_id'       => 'required|integer',
            'learning_outcome'  => 'required|string',
        ]);

        // Check if the record already exists
        $existingGoal       = GoalRegister::where([
            'class_id'      => $request->class_id,
            'exam_id'       => $request->exam_id,
            'student_id'    => $request->student_id,
            'subject_id'    => $request->subject_id,
            'category_id'   => $request->category_id
        ])->first();

        if ($existingGoal) {
            // If the record exists, update the learning outcome
            $existingGoal->learning_outcome = $request->learning_outcome;
            $existingGoal->save();
            return response()->json(['success' => 'Goal Updated Successfully!']);
        } else {
            // If it doesn't exist, create a new record
            $goal                   = new GoalRegister();
            $goal->class_id         = $request->class_id;
            $goal->exam_id          = $request->exam_id;
            $goal->student_id       = $request->student_id;
            $goal->subject_id       = $request->subject_id;
            $goal->category_id      = $request->category_id;
            $goal->learning_outcome = $request->learning_outcome;
            $goal->save();

            return response()->json(['success' => 'Goal Saved Successfully!']);
        }
    }
    




    public function subjectComment(Request $request)
    {
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
            if($data['getSingleClassName']->class_section == 'Nursery School')
            {
                $data['getSubject'] = ClassSubject::getAssignedClassSubject($request->get('class_id'));

                $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
            }

        }

        $data['header_title'] = "Subject Comment";
        
        if(Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == 1)
        {
            return view('admin.examinations.subject_comment.view', $data);
        }else{
            return view('teacher.subject_comment.view', $data);
        }

    }





    public function saveSingleSubjectComment(Request $request)
    {
        // $id = $request->id;

        $comment     = !empty($request->comment) ? $request->comment : '';
     

        $getComment = NurserySubjectComment::checkAlreadyExisting( $request->class_id, $request->exam_id, $request->student_id,$request->subject_id);

        if(!empty($getComment))
        {
            $save = $getComment;
        }
        else
        {
            if(!empty($comment))
            {
                $save               = new NurserySubjectComment;
                $save->created_by   = Auth::user()->id;
            }
            
        }
        
        if(!empty($comment) )
        {
            $save->student_id           = $request->student_id;
            $save->exam_id              = $request->exam_id;
            $save->class_id             = $request->class_id;
            $save->subject_id           = $request->subject_id;
            $save->comment              = $comment;

        }
        

        $save->save();

        $json['message'] = "COMMENT SUCCESSFULLY SAVED!";
        
        echo json_encode($json); 
    }









    //FOR TEACHER DASHBOARD
    public function nurseryGoalsTeacher(Request $request)
    {
        
        $data['getClass'] = ClassModel::getMyClassList(Auth::user()->id); //This line get only the class assigned to a teacher
        $data['getExam'] = Exam::getMyTermList(Auth::user()->id);


        if ($request->has('class_id') && $request->has('exam_id')) {
            $data['getStudentList'] = AssignStudent::getAssignedClassStudent($request->class_id, $request->exam_id);
            $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);

        } else {
            $data['getStudentList'] = [];
        }

        if (!empty($request->get('class_id')) && !empty($request->get('exam_id')) && !empty($request->get('student_id'))) {
            $data['getSubject'] = NurserySubject::getSubject($request->get('class_id'), $request->get('exam_id'));
            
            // Fetch existing goals for the student, class, and exam
            $data['existingGoals'] = GoalRegister::where([
                'class_id'      => $request->get('class_id'),
                'exam_id'       => $request->get('exam_id'),
                'student_id'    => $request->get('student_id'),
            ])->get()->keyBy('subject_id');
        } else {
            $data['getSubject'] = [];
            $data['existingGoals'] = [];
        }
        

        $data['header_title'] = "Nursery Goals";
        return view('teacher.goals_register', $data);
    }






    public function marksGrade()
    {
        $data['getRecord'] = MarksGrade::getRecord();

        $data['header_title'] = "Marks Grade";
        return view('admin.examinations.marks_grade.list', $data);
    }


    public function marksGradeAdd()
    {
        $data['header_title'] = "Add New Marks Grade";
        return view('admin.examinations.marks_grade.add', $data);
    }



    public function marksGradeInsert(Request $request)
    {
        $mark = new MarksGrade();
        $mark->name = trim($request->name);
        $mark->description = trim($request->description);
        $mark->percent_from = trim($request->percent_from);
        $mark->percent_to = trim($request->percent_to);
        $mark->section = trim($request->section);
        $mark->created_by = Auth::user()->id;
        $mark->save();

        return redirect()->route('examinations.marks_grade')->with('success', 'Grade system inserted successfully!');
    }



    public function marksGradeEdit($id)
    {
        $data['getRecord'] = MarksGrade::getSingle($id);
        $data['header_title'] = "Edit Marks Grade";
        return view('admin.examinations.marks_grade.edit', $data);
    }



    public function marksGradeUpdate(Request $request, $id)
    {
        $mark = MarksGrade::getSingle($id);
        $mark->name = trim($request->name);
        $mark->percent_from = trim($request->percent_from);
        $mark->percent_to = trim($request->percent_to);
        $mark->save();

        return redirect()->route('examinations.marks_grade')->with('success', 'Grade system Updated successfully!');
    }


    public function marksGradeDelete($id)
    {
        $mark = MarksGrade::getSingle($id);
        $mark->delete();

        return redirect()->route('examinations.marks_grade')->with('success', 'Grade system Deleted successfully!');

    }







    // STUDENT SIDE
    public function myExamTimetable(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $getExam = ExamSchedule::getExam($class_id);
        $result = array();
        foreach($getExam as $value)
        {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamSchedule::getExamTimetable($value->exam_id, $class_id);
            // dd($getExamTimetable);
            $resultS = array();
            foreach($getExamTimetable as $valueS)
            {
                $dataS = array();
                $dataS['subject_name']      = $valueS->subject_name;
                $dataS['exam_date']         = $valueS->exam_date;
                $dataS['start_time']        = $valueS->start_time;
                $dataS['end_time']          = $valueS->end_time;
                $dataS['room_number']       = $valueS->room_number;
                $dataS['full_mark']         = $valueS->full_mark;
                $dataS['pass_mark']         = $valueS->pass_mark;
                $resultS[] = $dataS;
            }

            $dataE['exam']  = $resultS;
            $result[]       = $dataE;
        }

        // dd($result);

        $data['getRecord'] = $result;

        $data['header_title'] = "My Exam Timetable";
        return view('student.my_exam_timetable', $data);
    }



    public function myExamResult()
    {  
        $result = array();
        $getExam = MarksRegister::getExam(Auth::user()->id);
        foreach($getExam as $value)
        {
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $dataE['exam_id'] = $value->exam_id;
            $dataE['exam_session'] = $value->exam_session;
            
            $getExamSubject = MarksRegister::getExamSubject($value->exam_id, Auth::user()->id);

            $dataSubject = array();
            foreach($getExamSubject as $exam)
            {
                $total_score                = $exam['ca'] + $exam['exam'];
                $dataS                      = array();
                $dataS['subject_name']      = $exam['subject_name'];
                $dataS['ca']               = $exam['ca'];
                $dataS['exam']              = $exam['exam'];
                $dataS['total_score']       = $total_score;
                $dataS['full_mark']         = $exam['full_mark'];
                $dataS['pass_mark']         = $exam['pass_mark'];
                $dataSubject[]              = $dataS;
            }
            $dataE['subject']   = $dataSubject;
            $result[]           = $dataE;
        }

        // dd($result);
        $data['getRecord'] = $result;

            

        $student = AssignStudent::where('student_id', Auth::user()->id)->where('lock_student', 0)->first();

        
        if($student)
        {
            $data['header_title'] = "My Exam Result";
            return view('student.my_exam_result', $data);
        }
        else
        {
            $data['header_title'] = "My Exam Result";
            return view('student.profile_not_validated', $data);
        }      
          
    }



    


    //TEACHER SIDE
    public function behaviorChartTeacher(Request $request)
    {
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id); //This line gets only the class assigned to a teacher
        // $data['getExam'] = ExamSchedule::getExamTeacher(Auth::user()->id);
        $data['getExam'] = Exam::getMyTermList(Auth::user()->id);

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'), $request->get('exam_id'));
        }


        //To fetch Behavior chart data from the db
        if (!empty($data['getStudent']) && $data['getStudent']->count() > 0) {
            $behaviorRecords = []; // Array to store behavior chart records
            foreach ($data['getStudent'] as $value) {
                // Fetch behavior chart record for each student
                $record = BehaviorChart::where('exam_id', $request->exam_id)
                    ->where('class_id', $request->class_id)
                    ->where('student_id', $value->id)
                    ->first();
                // Add behavior chart record to the array
                $behaviorRecords[$value->id] = $record;
            }
            // Pass the behavior records array to the view
            $data['behaviorRecords'] = $behaviorRecords;
        }


        $data['header_title'] = "Behavior Chart";
        return view('teacher.behavior_chart', $data);
    }



    public function myExamTimetableTeacher()
    {
        $result = array();
        $getClass = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);
        // dd($getClass);
        foreach($getClass as $class)
        {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $dataC['class_description'] = $class->class_description;

            $getExam = ExamSchedule::getExam($class->class_id);
            $examArray = array();
            foreach($getExam as $exam)
            {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;
                $dataE['exam_session'] = $exam->exam_session;

                $getExamTimetable = ExamSchedule::getExamTimetable($exam->exam_id, $class->class_id);
                $subjectArray = array();
                foreach($getExamTimetable as $valueS)
                {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_mark'] = $valueS->full_mark;
                    $dataS['pass_mark'] = $valueS->pass_mark;
                    $subjectArray[] = $dataS;
                }
                
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray; 

            $result[] = $dataC;
        }

        // dd($result);
        $data['getRecord'] = $result;

        $data['header_title'] = "My Exam Timetable";
        return view('teacher.my_exam_timetable', $data);
    }



    //PARENT SIDE

    public function parentMyExamTimetable($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id = $getStudent->class_id;
        $getExam = ExamSchedule::getExam($class_id);
        $result = array();
        foreach($getExam as $value)
        {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamSchedule::getExamTimetable($value->exam_id, $class_id);
            // dd($getExamTimetable);
            $resultS = array();
            foreach($getExamTimetable as $valueS)
            {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['pass_mark'] = $valueS->pass_mark;
                $resultS[] = $dataS;
            }

            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }

        // dd($result);

        $data['getRecord'] = $result;
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Exam Timetable";
        
        return view('parent.my_exam_timetable', $data);
    }



    public function parentMyExamResult($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);

        $result = array();
        $getExam = MarksRegister::getExam($student_id);
        foreach($getExam as $value)
        {
            $dataE = array();
            $dataE['exam_id'] = $value->exam_id;
            $dataE['exam_name'] = $value->exam_name;
            $dataE['exam_session'] = $value->exam_session;
            $getExamSubject = MarksRegister::getExamSubject($value->exam_id, $student_id);

            $dataSubject = array();
            foreach($getExamSubject as $exam)
            {
                $total_score = $exam['ca'] + $exam['exam'];
                $dataS = array();
                $dataS['subject_name'] = $exam['subject_name'];
                $dataS['ca'] = $exam['ca'];
                $dataS['exam'] = $exam['exam'];
                $dataS['total_score'] = $total_score;
                $dataS['full_mark'] = $exam['full_mark'];
                $dataS['pass_mark'] = $exam['pass_mark'];
                $dataSubject[] = $dataS;
            }
            $dataE['subject'] = $dataSubject;
            $result[] = $dataE;
        }

        // dd($result);
        $data['getRecord'] = $result;

        $data['header_title'] = "My Exam Result";
        return view('parent.my_exam_result', $data);
    }



    public function myStudentResultParentSide(Request $request)
    {
        $parent_id = Auth::user()->id;

        $data['getClass'] = ClassModel::getClass();

        $data['getExam'] = Exam::getExam();

        $data['getSingleExamName'] = Exam::getSingleExamName($request->get('exam_id'));

        $data['getSingleClassName'] = ClassModel::getSingleClassName($request->get('class_id'));

        // dd($data['getSingleClassName']);

        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            // $data['getRecord'] = User::getMyStudent($parent_id); ///NOT GOOD ENOUGH
            $data['getRecord'] = User::getParentStudents($request->get('class_id'), $request->get('exam_id'), $parent_id);
        }
    
        $data['header_title'] = "Student Result";
        return view('parent.result_page.view_result', $data);
    }




    //PRINTING OF EXAM REPORT CARD
    public function myExamResultPrint(Request $request)
    {
        $exam_id = $request->exam_id;
        $student_id = $request->student_id;
        

        $data['getExam'] = Exam::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);

        $data['getClass'] = MarksRegister::getClass($exam_id, $student_id);
        

        $data['getSetting'] = Setting::getSingle();

        // $getExamSubject = MarksRegister::getExamSubject($exam_id, $student_id);
        $getExamSubject = StudentSubject::getExamSubject($exam_id, $student_id);

        $dataSubject = array();
        foreach($getExamSubject as $exam)
        {
            $total_score = $exam['ca'] + $exam['home_fun'] + $exam['attendance'] + $exam['class_work'] + $exam['ca2'] + $exam['exam'];

            $dataS                      = array();
            $dataS['subject_name']      = $exam['subject_name'];
            $dataS['subject_id']        = $exam['subject_id'];
            $dataS['ca']                = $exam['ca'];
            $dataS['home_fun']          = $exam['home_fun'];
            $dataS['attendance']        = $exam['attendance'];
            $dataS['class_work']        = $exam['class_work'];
            $dataS['ca2']               = $exam['ca2'];
            $dataS['exam']              = $exam['exam'];
            $dataS['teacher_remark']    = $exam['teacher_remark'];
            $dataS['total_score']       = $total_score;
            $dataS['full_mark']         = $exam['full_mark'];
            $dataS['pass_mark']         = $exam['pass_mark'];
            $dataSubject[]              = $dataS;
        }
        $data['getExamMark'] = $dataSubject;

        // $data['getAverage'] = MarksRegister::marksSubjectCount($exam_id, $student_id);
        $data['getSubjectCount'] = MarksRegister::marksSubjectCount($exam_id, $student_id);
        
        $data['getBehaviorChart'] = BehaviorChart::where('student_id', $request->student_id)->where('exam_id', $request->exam_id)->get();



        $user = User::find($student_id); // Retrieve the user by ID
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


        // $data['getClassTeacher'] = AssignClassTeacher::getClassTeacher($exam_id, $student_id);

        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($data['getClass']->class_id, $exam_id, $student_id);

        $data['getHeadTeacher'] = User::where('user_type', 'Principal')->orWhere('user_type', 'Head Teacher')->first();

        $data['classAverage'] = MarksRegister::classAverage($data['getClass']->class_id, $exam_id);



        $data['getSubjectId'] = ExamSchedule::getExamSubject($exam_id, $data['getClass']->class_id);


        $subjectHighestScores = [];
        $subjectLowestScores = [];

        foreach ($data['getExamMark'] as $exam) {
            $subjectHighestScores[$exam['subject_id']] = MarksRegister::subjectHighestScores($data['getClass']->class_id, $data['getExam']->id, $exam['subject_id']);

            $subjectLowestScores[$exam['subject_id']] = MarksRegister::subjectLowestScores($data['getClass']->class_id, $data['getExam']->id, $exam['subject_id']);
        }
        $data['subjectHighestScores'] = $subjectHighestScores;

        $data['subjectLowestScores'] = $subjectLowestScores;

        
        
        if(!empty($data['getClass']))
        {
            return view('report_card.jibs_primary_report_card', $data);
            
            // if($data['getClass']->section == 'Primary School')
            // {
            //     return view('report_card.jibs_primary_report_card', $data);
            // }
            // else{
            //     return view('report_card.jibs_nursery_report_card', $data);
            // }
        }
        
    }





    public function myCaResultPrint(Request $request)
    {
        
        $exam_id = $request->exam_id;
        $student_id = $request->student_id;
        

        $data['getExam'] = Exam::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);

        $data['getClass'] = MarksRegister::getClass($exam_id, $student_id);
        

        $data['getSetting'] = Setting::getSingle();

        // $getExamSubject = MarksRegister::getExamSubject($exam_id, $student_id);
        $getExamSubject = StudentSubject::getExamSubject($exam_id, $student_id);

        $dataSubject = array();
        foreach($getExamSubject as $exam)
        {
            $total_score = $exam['ca'] + $exam['home_fun'] + $exam['attendance'] + $exam['class_work'];

            $dataS                      = array();
            $dataS['subject_name']      = $exam['subject_name'];
            $dataS['subject_id']        = $exam['subject_id'];
            $dataS['ca']                = $exam['ca'];
            $dataS['home_fun']          = $exam['home_fun'];
            $dataS['attendance']        = $exam['attendance'];
            $dataS['class_work']        = $exam['class_work'];
            // $dataS['exam']              = $exam['exam'];
            // $dataS['teacher_remark']    = $exam['teacher_remark'];
            $dataS['ca_comment']        = $exam['ca_comment'];
            $dataS['total_score']       = $total_score;
            
            $dataSubject[]              = $dataS;
        }
        $data['getExamMark'] = $dataSubject;

        // $data['getAverage'] = MarksRegister::marksSubjectCount($exam_id, $student_id);
        $data['getSubjectCount'] = MarksRegister::marksSubjectCount($exam_id, $student_id);
        


        $user = User::find($student_id); // Retrieve the user by ID
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


        // $data['getClassTeacher'] = AssignClassTeacher::getClassTeacher($exam_id, $student_id);
        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($data['getClass']->class_id, $exam_id, $student_id);

        // $data['getHeadTeacher'] = User::where('user_type', 'Principal')->orWhere('user_type', 'Head Teacher')->first();

        // $data['classAverage'] = MarksRegister::classAverage($data['getClass']->class_id, $exam_id);



        $data['getSubjectId'] = ExamSchedule::getExamSubject($exam_id, $data['getClass']->class_id);


        $subjectHighestScores = [];
        $subjectLowestScores = [];

        foreach ($data['getExamMark'] as $exam) {
            $subjectHighestScores[$exam['subject_id']] = MarksRegister::caHighestScore($data['getClass']->class_id, $data['getExam']->id, $exam['subject_id']);

            $subjectLowestScores[$exam['subject_id']] = MarksRegister::caLowestScore($data['getClass']->class_id, $data['getExam']->id, $exam['subject_id']);
        }
        $data['subjectHighestScores'] = $subjectHighestScores;

        $data['subjectLowestScores'] = $subjectLowestScores;

        
        
        if(!empty($data['getClass']))
        {
            
            if($data['getClass']->section == 'Primary School')
            {
                return view('report_card.jibs_primary_ca', $data);
            }
            else{
                return view('report_card.jibs_nursery_ca', $data);
            }
        }
        
    }



    ///FOR CUMULATIVE RESULT PRINTING
    public function myCumulativeExamResultPrint(Request $request)
    {
        
        $exam_id = $request->exam_id;
        $class_id = $request->class_id;
        $student_id = $request->student_id;
        

        $data['getExam'] = Exam::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);

        $data['getClass'] = MarksRegister::getClass($exam_id, $student_id);
        
        $data['getSetting'] = Setting::getSingle();

        // $getExamSubject = MarksRegister::getExamSubject($exam_id, $student_id);
        $getExamSubject = StudentSubject::getExamSubject($exam_id, $student_id);

        $dataSubject = array();
        foreach($getExamSubject as $exam)
        {
            $total_score = $exam['ca'] + $exam['project'] + $exam['exam'];

            $dataS                      = array();
            $dataS['subject_name']      = $exam['subject_name'];
            $dataS['subject_id']        = $exam['subject_id'];
            $dataS['ca']                = $exam['ca'];
            $dataS['project']           = $exam['project'];
            $dataS['exam']              = $exam['exam'];
            $dataS['teacher_remark']    = $exam['teacher_remark'];
            $dataS['total_score']       = $total_score;
            $dataS['full_mark']         = $exam['full_mark'];
            $dataS['pass_mark']         = $exam['pass_mark'];
            $dataSubject[]              = $dataS;
        }
        $data['getExamMark'] = $dataSubject;

        // $data['getAverage'] = MarksRegister::marksSubjectCount($exam_id, $student_id);
        $data['getSubjectCount'] = MarksRegister::marksSubjectCount($exam_id, $student_id);
        
        $data['getBehaviorChart'] = BehaviorChart::where('student_id', $request->student_id)->where('exam_id', $request->exam_id)->get();



        $user = User::find($student_id); // Retrieve the user by ID
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


        $data['getClassTeacher'] = AssignClassTeacher::getClassTeacher($exam_id, $student_id);

        $data['getHeadTeacher'] = User::where('user_type', 'Principal')->orWhere('user_type', 'Head Teacher')->first();

        $data['classAverage'] = MarksRegister::classAverage($data['getClass']->class_id, $exam_id);



        $data['getSubjectId'] = ExamSchedule::getExamSubject($exam_id, $data['getClass']->class_id);


        $subjectHighestScores = [];
        $subjectLowestScores = [];

        foreach ($data['getExamMark'] as $exam) {
            $subjectHighestScores[$exam['subject_id']] = MarksRegister::subjectHighestScores($data['getClass']->class_id, $data['getExam']->id, $exam['subject_id']);

            $subjectLowestScores[$exam['subject_id']] = MarksRegister::subjectLowestScores($data['getClass']->class_id, $data['getExam']->id, $exam['subject_id']);
        }
        $data['subjectHighestScores'] = $subjectHighestScores;

        $data['subjectLowestScores'] = $subjectLowestScores;

        
        
        if(!empty($data['getClass']))
        {
            return view('report_card.cobena_cumulative_report_card', $data);
            // return view('report_card.cobena_nursery_report_card', $data);
            
            // if($data['getClass']->section == 'Primary School')
            // {
            //     return view('report_card.cobena_primary_report_card', $data);
            // }
            // else{
            //     return view('report_card.cobena_nursery_report_card', $data);
            // }
        }
        
    }



    ///PRINTING OF NURSERY SCHOOLS RESULTS
    public function printNurseryGoal(Request $request)
    {
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $student_id = $request->student_id;
        

        $data['getExam'] = Exam::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);

        $data['getClass'] = GoalRegister::getClass($exam_id, $student_id);
        
        $data['getSetting'] = Setting::getSingle();

        $data['getBehaviorChart'] = BehaviorChart::where('student_id', $request->student_id)->where('exam_id', $request->exam_id)->get();

        $data['getSubjectComment'] = NurserySubjectComment::getComment($request->exam_id, $request->student_id);


        //For Age Calculation
        $user = User::find($student_id); 
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


        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($class_id, $exam_id, $student_id);

        // $data['getClassTeacher'] = AssignClassTeacher::nurseryClassTeacher($class_id, $exam_id);

        $data['getHeadTeacher'] = User::where('user_type', 'Principal')->orWhere('user_type', 'Head Teacher')->orWhere('user_type', 'School Admin')->first();


        $goals = GoalRegister::where('exam_id', $exam_id)
                            ->where('student_id', $student_id)
                            ->with('subject', 'category') // Assuming relationships exist
                            ->get()
                            ->groupBy('category_id')
                            ->sortKeys(); // Sort by category_id

        $data['categories'] = $goals;


        // return view('report_card.cobena_nursery_report_card', $data);
        return view('report_card.jibs_nursery_report_card', $data);

    }



    public function printNurseryMidtermGoal(Request $request)
    {
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $student_id = $request->student_id;
        

        $data['getExam'] = Exam::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);

        // $data['getClass'] = GoalRegister::getClass($exam_id, $student_id);

        $data['getClass'] = NurseryMidTermGoalRegister::getClass($exam_id, $student_id);
        
        $data['getSetting'] = Setting::getSingle();

        $data['getBehaviorChart'] = BehaviorChart::where('student_id', $request->student_id)->where('exam_id', $request->exam_id)->get();

        // $data['getSubjectComment'] = NurserySubjectComment::getComment($request->exam_id, $request->student_id);


        //For Age Calculation
        $user = User::find($student_id); 
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


        // $data['getClassTeacher'] = AssignClassTeacher::getClassTeacher($exam_id, $student_id);

        $data['getClassTeacher'] = AssignClassTeacher::fetchClassTeacher($class_id, $exam_id, $student_id);

        $data['getHeadTeacher'] = User::where('user_type', 'Principal')->orWhere('user_type', 'Head Teacher')->orWhere('user_type', 'School Admin')->first();


        $goals = NurseryMidTermGoalRegister::where('exam_id', $exam_id)
                            ->where('student_id', $student_id)
                            ->with('subject', 'category') 
                            ->get()
                            ->groupBy('category_id')
                            ->sortKeys(); // Sort by category_id

        $data['categories'] = $goals;


        return view('report_card.jibs_nursery_midterm_report_card', $data);

    }





    public function nurseryMidtermGoal(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        if ($request->has('class_id') && $request->has('exam_id')) {
            $data['getStudentList'] = AssignStudent::getAssignedClassStudent($request->class_id, $request->exam_id);
            $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);

        } else {
            $data['getStudentList'] = [];
        }

        if (!empty($request->get('class_id')) && !empty($request->get('exam_id')) && !empty($request->get('student_id'))) {
            $data['getSubject'] = NurseryMidtermSubject::getSubject($request->get('class_id'), $request->get('exam_id'));


            
            // Fetch existing goals for the student, class, and exam
            $data['existingGoals'] = NurseryMidTermGoalRegister::where([
                'class_id'      => $request->get('class_id'),
                'exam_id'       => $request->get('exam_id'),
                'student_id'    => $request->get('student_id'),
            ])->get()->keyBy('subject_id');
        } else {
            $data['getSubject'] = [];
            $data['existingGoals'] = [];
        }

        $data['header_title'] = "Midterm Goals";
        return view('admin.examinations.nursery_midterm_goals_register', $data);
    }


    public function nurseryMidtermGoalTeacher(Request $request)
    {
        // $data['getClass'] = ClassModel::getClass();
        // $data['getExam'] = Exam::getExam();

        $data['getClass'] = ClassModel::getMyClassList(Auth::user()->id);

        $data['getExam'] = Exam::getMyTermList(Auth::user()->id);

        if ($request->has('class_id') && $request->has('exam_id')) {
            $data['getStudentList'] = AssignStudent::getAssignedClassStudent($request->class_id, $request->exam_id);
            $data['getSingleClassName'] = ClassModel::getSingleClassName($request->class_id);

        } else {
            $data['getStudentList'] = [];
        }

        if (!empty($request->get('class_id')) && !empty($request->get('exam_id')) && !empty($request->get('student_id'))) {
            $data['getSubject'] = NurseryMidtermSubject::getSubject($request->get('class_id'), $request->get('exam_id'));


            
            // Fetch existing goals for the student, class, and exam
            $data['existingGoals'] = NurseryMidTermGoalRegister::where([
                'class_id'      => $request->get('class_id'),
                'exam_id'       => $request->get('exam_id'),
                'student_id'    => $request->get('student_id'),
            ])->get()->keyBy('subject_id');
        } else {
            $data['getSubject'] = [];
            $data['existingGoals'] = [];
        }

        $data['header_title'] = "Midterm Goals";
        return view('teacher.nursery_midterm_goals_register', $data);
    }




    public function saveMidtermGoal(Request $request)
    {
        // Validate the request
        $request->validate([
            'class_id'          => 'required|integer',
            'exam_id'           => 'required|integer',
            'student_id'        => 'required|integer',
            'subject_id'        => 'required|integer',
            'category_id'       => 'required|integer',
            'learning_outcome'  => 'required|string',
        ]);

        // Check if the record already exists
        $existingGoal       = NurseryMidTermGoalRegister::where([
            'class_id'      => $request->class_id,
            'exam_id'       => $request->exam_id,
            'student_id'    => $request->student_id,
            'subject_id'    => $request->subject_id,
            'category_id'   => $request->category_id
        ])->first();

        if ($existingGoal) {
            // If the record exists, update the learning outcome
            $existingGoal->learning_outcome = $request->learning_outcome;
            $existingGoal->save();
            return response()->json(['success' => 'Goal Updated Successfully!']);
        } else {
            // If it doesn't exist, create a new record
            $goal                   = new NurseryMidTermGoalRegister();
            $goal->class_id         = $request->class_id;
            $goal->exam_id          = $request->exam_id;
            $goal->student_id       = $request->student_id;
            $goal->subject_id       = $request->subject_id;
            $goal->category_id      = $request->category_id;
            $goal->learning_outcome = $request->learning_outcome;
            $goal->save();

            return response()->json(['success' => 'Goal Saved Successfully!']);
        }
    }
   










}
