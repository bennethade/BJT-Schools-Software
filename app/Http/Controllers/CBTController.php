<?php

namespace App\Http\Controllers;

use App\Models\CbtAssign;
use App\Models\CbtAttempt;
use App\Models\CbtExam;
use App\Models\CbtQuestion;
use App\Models\CbtResponse;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Intervention\Image\Laravel\Facades\Image;



use Illuminate\Support\Str;



class CBTController extends Controller
{

    public function viewAll()
    {
        $data['getClass'] = ClassModel::all();
        $data['getExam'] = Exam::getExam();
        $data['getSubject'] = Subject::all();

        $query = CbtExam::select('cbt_exams.*', 'exams.name as term_name', 'exams.session as term_session')
            ->leftJoin('classes', 'classes.id', '=', 'cbt_exams.class_id')
            ->leftJoin('exams', 'exams.id', '=', 'cbt_exams.exam_id')
            ->leftJoin('subjects', 'subjects.id', '=', 'cbt_exams.subject_id')
            ->orderBy('cbt_exams.exam_title', 'asc');

        // Apply search filters
        if (!empty(FacadesRequest::get('name'))) {
            $query->where(function ($q) {
                $searchTerm = '%' . FacadesRequest::get('name') . '%';
                $q->where('cbt_exams.exam_title', 'like', $searchTerm)
                    ->orWhere('classes.name', 'like', $searchTerm)
                    ->orWhere('exams.name', 'like', $searchTerm)
                    ->orWhere('subjects.name', 'like', $searchTerm)
                    ->orWhere('subjects.description', 'like', $searchTerm);
            });
        }

        $data['getRecord'] = $query->paginate(50);

        $data['header_title'] = 'All CBT';
        return view('admin.cbt.view_all', $data);
    }
    





    
    public function CBTSubmit(Request $request)
    {
        $request->validate([
            'exam_title'    => 'required',
            'class_id'      => 'required',
            'subject_id'    => 'required',
            'overall_score' => 'required',
            'duration'      => 'required',
            // 'status' => 'required|in:0,1',
        ]);
        
        $cbt = new CbtExam();

        $cbt->exam_title        = $request->exam_title;
        $cbt->class_id          = $request->class_id;
        $cbt->exam_id           = $request->exam_id;
        $cbt->subject_id        = $request->subject_id;
        $cbt->overall_score     = $request->overall_score;
        $cbt->duration          = $request->duration;
        $cbt->status            = $request->status;
        $cbt->created_by        = Auth::user()->id;
        $cbt->updated_by        = null;

        $cbt->save();

        // dd($request->all());

        return redirect()->back()->with('success', 'CBT Exam Added Successfully!');
    }



    public function editCBT($id)
    {
        $data['getRecord'] = CbtExam::findOrFail($id);
        $data['getClass'] = ClassModel::all();
        $data['getExam'] = Exam::getExam();
        $data['getSubject'] = Subject::all();

        $data['header_title'] = "Edit CBT";
        return view('admin.cbt.edit', $data);
    }



    public function updateCBT(Request $request, $id)
    {
        $request->validate([
            'exam_title'    => 'required',
            'class_id'      => 'required',
            'exam_id'       => 'required',
            'subject_id'    => 'required',
            'overall_score' => 'required',
            'duration'      => 'required',
            'status'        => 'required'
        ]);
        
        $cbt = CbtExam::findOrFail($id);

        $cbt->exam_title = $request->exam_title;
        $cbt->class_id = $request->class_id;
        $cbt->exam_id = $request->exam_id;
        $cbt->subject_id = $request->subject_id;
        $cbt->overall_score = $request->overall_score;
        $cbt->duration = $request->duration;
        $cbt->status = $request->status;
        $cbt->updated_by = Auth::user()->id;

        $cbt->save();

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return redirect()->route('cbt.view.all')->with('success', 'CBT Updated Successfully!');
        }else{
            return redirect()->route('teacher.cbt.view.all')->with('success', 'CBT Updated Successfully!');
        }

    }

    



    public function viewQuestions($id)
    {
        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = Subject::all();
        $data['getCbtTitle'] = CbtExam::findOrFail($id);

        // Fetch the questions associated with the exam
        $existingQuestions = CbtQuestion::where('cbt_exam_id', $id)->get();

        // Ensure at least one default question row
        $data['questions'] = $existingQuestions->isEmpty() ? [[
            'question' => '',
            'image' => '',
            'option_a' => '',
            'option_b' => '',
            'option_c' => '',
            'option_d' => '',
            'option_e' => '',
            'correct_option' => ''
        ]] : $existingQuestions->toArray();

        $data['header_title'] = 'Questions';
        return view('admin.cbt.questions', $data);
    }


    public function storeQuestions(Request $request, $id)
    {
        // Filter out empty questions
        $questions = array_filter($request->questions, fn($q) => isset($q['question']) && trim($q['question']) !== '');
        $request->merge(['questions' => $questions]);

        // Validate input
        $request->validate([
            'questions.*.id'             => 'nullable|exists:cbt_questions,id',
            'questions.*.question'       => 'required|string',
            'questions.*.image'          => 'nullable|file|mimes:jpeg,png,jpg,gif|max:3048',
            'questions.*.correct_option' => 'required|in:A,B,C,D,E',
            'questions.*.option_a'       => 'required|string',
            'questions.*.option_b'       => 'required|string',
            'questions.*.option_c'       => 'nullable|string',
            'questions.*.option_d'       => 'nullable|string',
            'questions.*.option_e'       => 'nullable|string',
        ]);

        $existingIds = [];
        foreach ($questions as $questionData) {
            // Initialize $filename as null (if no image is uploaded)
            $filename = null;

            if (!empty($questionData['id'])) {
                // For existing questions, get the current image path
                $existingQuestion = CbtQuestion::find($questionData['id']);
                $filename = $existingQuestion->image; // Keep the existing image by default
            }

            // If there's a new image uploaded
            if (isset($questionData['image']) && $questionData['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete the old image if it exists
                if ($filename && file_exists(public_path('upload/question_images/' . $filename))) {
                    unlink(public_path('upload/question_images/' . $filename));
                }

                // Generate a unique filename for the uploaded image
                $filename = date('Ymdhis') . Str::random(20) . '.' . $questionData['image']->getClientOriginalExtension();
                $imagePath = public_path('upload/question_images/' . $filename);

                // Process the image using GD (resize image)
                //MAKE SURE extension=gd IS ENABLED IN YOUR php.ini FILE
                $image = imagecreatefromstring(file_get_contents($questionData['image']->getPathname()));

                if ($image) {
                    // Resize the image (700x600)
                    list($originalWidth, $originalHeight) = getimagesize($questionData['image']->getPathname());
                    $resizedImage = imagescale($image, 700, 600);
                    imagejpeg($resizedImage, $imagePath);
                    imagedestroy($image);
                    imagedestroy($resizedImage);
                }
            }

            // Update or create a new question
            if (!empty($questionData['id'])) {
                // Update existing question
                $existingQuestion->update(array_merge($questionData, ['image' => $filename]));
                $existingIds[] = $existingQuestion->id;
            } else {
                // Create a new question
                $newQuestion = CbtQuestion::create(array_merge($questionData, [
                    'cbt_exam_id' => $id,
                    'image'       => $filename,
                ]));
                $existingIds[] = $newQuestion->id;
            }
        }

        // Delete removed questions
        CbtQuestion::where('cbt_exam_id', $id)->whereNotIn('id', $existingIds)->delete();

        return redirect()->back()->with('success', 'Questions saved successfully.');
    }



    public function deleteCBT($id)
    {
        $cbt = CbtExam::findOrFail($id);
        $cbt->delete();

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return redirect()->route('cbt.view.all')->with('warning', 'CBT Deleted Successfully!');
        }else{
            return back()->with('success', 'CBT Deleted Successfully!');
        }

    }


    public function assignedList()
    {
        $data['getRecord'] = CbtAssign::getRecord();
        
        $data['header_title'] = "Assigned CBT";
        return view('admin.cbt.assigned_list', $data);
    }

    



    public function assignCBT($id)
    {
        $data['getClass'] = ClassModel::all();
        $data['getTerm'] = Exam::getExam();

        $data['getRecord'] = CbtExam::findOrFail($id);

        $data['header_title'] = 'Assign CBT';
        return view('admin.cbt.assign', $data);
    }



    public function storeAssignCBT(Request $request, $cbt_exam_id)
    {
        // dd($request->all(), $cbt_exam_id);

        if (!empty($request->class_id)) 
        {
            foreach ($request->class_id as $class_id) 
            {
                $alreadyExistingData = CbtAssign::alreadyExistingData($cbt_exam_id, $request->exam_id, $class_id);

                if (!empty($alreadyExistingData)) 
                {
                    $alreadyExistingData->status = $request->status;
                    $alreadyExistingData->save();
                } 
                else {
                    $data = new CbtAssign();
                    $data->cbt_exam_id = $cbt_exam_id;
                    $data->exam_id = $request->exam_id;
                    $data->class_id = $class_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }
            }

            if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
            {
                return redirect()->route('cbt.assigned.list')->with('success', 'CBT Successfully Assigned to Class(es)');
            }else{
                return redirect()->route('teacher.cbt.assigned.list')->with('success', 'CBT Successfully Assigned to Class(es)');
            }

        } 
        else 
        {
            return redirect()->back()->with('error', 'Error! </br> Please Try Again with the right details');
        }
    }
    


  

    public function editAssignCBT($id)
    {
        $data['getClass'] = ClassModel::all();
        $data['getTerm'] = Exam::all();
        $data['getRecord'] = CbtAssign::findOrFail($id); // Fetch the specific assignment
        $data['getCbtExam'] = CbtExam::findOrFail($data['getRecord']->cbt_exam_id); // Fetch the CBT Exam details
        $data['header_title'] = 'Edit CBT Assignment';

        return view('admin.cbt.edit_assigned', $data);
    }


    public function updateAssignCBT(Request $request, $id)
    {
        $data = CbtAssign::findOrFail($id);

        // Check if the CBT exam has already been assigned to the chosen class and term
        $existingAssignment = CbtAssign::where('cbt_exam_id', $data->cbt_exam_id)
            ->where('class_id', $request->class_id)
            ->where('exam_id', $request->exam_id)
            ->where('id', '!=', $id) // Exclude the current record
            ->first();

        if ($existingAssignment) {
            return redirect()->back()->with('warning', 'This CBT has already been assigned to the selected class and term.');
        }

        // Update the record
        $data->exam_id = $request->exam_id;
        $data->class_id = $request->class_id;
        $data->status = $request->status;
        $data->save();


        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return redirect()->route('cbt.assigned.list')->with('success', 'CBT Assignment Updated Successfully');
        }else{
            return redirect()->route('teacher.cbt.assigned.list')->with('success', 'CBT Assignment Updated Successfully');
        }

    }


    


    public function deleteAssignedCBT($id)
    {
        $data = CbtAssign::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('warning', 'CBT has been unassigned Successfully!');
    }



    public function cbtScoreView(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        $data['getAllWrittenCBT'] = CbtAssign::getAllWrittenCBT($request->class_id, $request->exam_id);
   
        $data['header_title'] = "CBT Scores";
        return view('admin.cbt.score_view', $data);
    }



    public function cbtScoreList(Request $request)
    {
        $data['getCbtDetails'] = CbtAttempt::getCbtDetails($request->class_id, $request->exam_id, $request->cbt_exam_id);

        $data['getSingleCBTScores'] = CbtAttempt::getSingleCBTScores($request->class_id, $request->exam_id, $request->cbt_exam_id);
   
        $data['header_title'] = "CBT Scores";
        return view('admin.cbt.score_list', $data);
    }



    public function singleStudentCBTReset($class_id, $exam_id, $cbt_exam_id, $student_id)
    {
        // dd($class_id, $exam_id, $cbt_exam_id, $student_id);

        $attempt_id = CbtAttempt::where('class_id', $class_id)
                                ->where('exam_id', $exam_id)
                                ->where('cbt_exam_id', $cbt_exam_id)
                                ->where('student_id', $student_id)
                                ->value('id');

        // dd($attempt_id);

        if ($attempt_id) {
            CbtAttempt::findOrFail($attempt_id)->delete();

            CbtResponse::where('student_id', $student_id)
                    ->where('attempt_id', $attempt_id)
                    ->delete();

            return redirect()->back()->with('success', 'Student CBT Successfully Reset!');
        }

        return redirect()->back()->with('error', 'No CBT score found for this student.');
    }



    public function studentCBTResetAll($class_id, $exam_id, $cbt_exam_id)
    {
        $attempt_ids = CbtAttempt::where('class_id', $class_id)
                                ->where('exam_id', $exam_id)
                                ->where('cbt_exam_id', $cbt_exam_id)
                                ->pluck('id');

        if ($attempt_ids->isEmpty()) {
            return redirect()->back()->with('error', 'No CBT score found for this exam.');
        }

        foreach ($attempt_ids as $attempt_id) {
            CbtAttempt::findOrFail($attempt_id)->delete();

            CbtResponse::where('attempt_id', $attempt_id)->delete();
        }

        return redirect()->back()->with('success', 'All CBT Scores for this Exam Successfully Reset!');
    }





    

    //STUDENT DASHBOARD SIDE

    public function studentCbtList(Request $request)
    {
        $student_id = Auth::user()->id;

        $data['getClass'] = ClassModel::getStudentClassList($student_id);
        $data['getExam'] = Exam::getStudentTermList($student_id);

        $data['getCBT'] = CbtAssign::getStudentCBT($request->class_id, $request->exam_id);

        // We'll store all CBT attempts the student has already taken
        $alreadyTakenMap = [];

        foreach ($data['getCBT'] as $cbt) {
            $attempt = CbtAttempt::alreadyTaken(
                $request->class_id,
                $request->exam_id,
                $student_id,
                $cbt->cbt_exam_id
            );

            if ($attempt) {
                $alreadyTakenMap[$cbt->cbt_exam_id] = $attempt;
            }
        }

        $data['alreadyTakenMap'] = $alreadyTakenMap;

        $data['header_title'] = "CBT List";

        return view('student.cbt.cbt_list', $data);
    }




    public function studentTakeCBT(Request $request)
    {

        $data['class_id']       = $request->class_id;
        $data['exam_id']        = $request->exam_id;
        $data['subject_id']     = $request->subject_id;
        $data['cbt_exam_id']    = $request->cbt_exam_id;

        // dd($data['cbt_exam_id']);

        $data['getStudent'] = User::where('id', Auth::user()->id)->first();
        
        $data['header_title'] = "Take CBT";
        return view('student.cbt.take_cbt', $data);
    }



    public function studentTakeCBTBegin(Request $request)
    {
        $student = Auth::user();

        $data['getStudent'] = $student;
        $data['cbtExam'] = CbtExam::findOrFail($request->cbt_exam_id);
        $data['questions'] = CbtQuestion::where('cbt_exam_id', $request->cbt_exam_id)->get();

        $data['cbtAttempt'] = CbtAttempt::firstOrCreate([
            'student_id' => $student->id,
            'cbt_exam_id' => $request->cbt_exam_id,
            'class_id' => $request->class_id,
            'exam_id' => $request->exam_id,
        ], [
            'started_at' => Carbon::now(),
            'duration' => $data['cbtExam']->duration, // exam has a duration in minutes
        ]);


        // 👇 Get the student’s previous answers for this attempt
        $data['responses'] = CbtResponse::where('attempt_id', $data['cbtAttempt']->id)
            ->pluck('selected_option', 'question_id');

        $data['header_title'] = "Begin CBT";

        return view('student.cbt.cbt_begin', $data);
    }




    public function saveResponse(Request $request)
    {
        // $data = $request->json()->all();

        $request->validate([
            'attempt_id' => 'required|exists:cbt_attempts,id',
            'student_id' => 'required|exists:users,id',
            'question_id' => 'required|exists:cbt_questions,id',
            'selected_option' => 'required|in:A,B,C,D,E',
        ]);

        $question = CbtQuestion::find($request->question_id);
        $isCorrect = strtoupper($question->correct_option) === strtoupper($request->selected_option);

        CbtResponse::updateOrCreate(
            [
                'attempt_id' => $request->attempt_id,
                'student_id' => $request->student_id,
                'question_id' => $request->question_id,
            ],
            [
                'selected_option' => $request->selected_option,
                'is_correct' => $isCorrect,
            ]
        );

        return response()->json(['message' => 'Response saved successfully.']);
    }




    public function submitExam(Request $request)
    {
        $attempt = CbtAttempt::findOrFail($request->attempt_id);

        // Get total questions in this exam
        $totalQuestions = CbtQuestion::where('cbt_exam_id', $attempt->cbt_exam_id)->count();

        // Count how many correct responses the student has
        $correctAnswers = CbtResponse::where('attempt_id', $attempt->id)
            ->where('is_correct', true)
            ->count();


        //Fetch the overall maximum score from cbt_exams table
        $maxScore = CbtExam::where('id', $attempt->cbt_exam_id)->value('overall_score');

        

        // $scoreOver100 = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
        $scoreOver100 = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * $maxScore, 2) : 0;

        // Save score to attempt
        $attempt->update([
            'score' => $scoreOver100,
            'completed_at' => Carbon::now()
        ]);

        return response()->json([
            'message' => 'Exam submitted successfully.',
            'total_correct' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'total_fails' => $totalQuestions - $correctAnswers,
            'attempt_id' => $attempt->id,
            'score_over_100' => $scoreOver100
        ]);
    }




    public function viewResult($attemptId)
    {
        $attempt = CbtAttempt::findOrFail($attemptId);

        $totalQuestions = CbtQuestion::where('cbt_exam_id', $attempt->cbt_exam_id)->count();

        $correctAnswers = round(($attempt->score * $totalQuestions) / 100); // Reverse calculation for display

        $fails = $totalQuestions - $correctAnswers;

        $totalAnsweredQuestion = CbtResponse::where('attempt_id', $attemptId)->where('student_id', Auth::user()->id)->count();

        $unansweredQuestion = $totalQuestions - $totalAnsweredQuestion;


        return view('student.cbt.result', [
            'attempt' => $attempt,
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'fails' => $fails,
            'scoreOver100' => $attempt->score,
            'unansweredQuestion' => $unansweredQuestion
        ]);
    
    }



    public function studentCbtScores(Request $request)
    {
        $student_id = Auth::user()->id;

        $data['getClass'] = ClassModel::getStudentClassList($student_id);
        $data['getExam'] = Exam::getStudentTermList($student_id);

        $data['getStudentCBTScores'] = CbtAttempt::getStudentCBT($request->class_id, $request->exam_id, $student_id);


        $data['header_title'] = "CBT Scores";
        return view('student.cbt.cbt_scores', $data);
    }






    //PARENT DASHBOARD
    public function parentStudentCbtList(Request $request)
    {
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;

        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        // $data['getParentStudentCBTScores'] = CbtAttempt::getStudentCBT($request->class_id, $request->exam_id, $student_id);

        $data['getStudent'] = User::getParentStudents($class_id, $exam_id, Auth::user()->id);


        $data['header_title'] = "CBT Scores";
        return view('parent.cbt.cbt_list', $data);
    }


    public function parentStudentCbtScores(Request $request)
    {
        $class_id       = $request->class_id;
        $exam_id        = $request->exam_id;
        $student_id     = $request->student_id;

        $data['getStudentCBT'] = CbtAttempt::getStudentCBT($class_id, $exam_id, $student_id);

        $data['getStudent'] = User::where('id', $student_id)->first();


        $data['header_title'] = "CBT Scores";

        return view('parent.cbt.cbt_scores', $data);
    }





    ///TEACHER'S DASHBOARD

    public function teacherViewAll(Request $request)
    {
        $data['getClass'] = ClassModel::getMyClassList(Auth::id());
        $data['getExam'] = Exam::getMyTermList(Auth::id());
        $data['getSubject'] = ClassSubject::getAssignedClassSubject($request->class_id);



        $data['getRecord'] = CbtExam::getClassCbt($request->class_id, $request->exam_id);


        $data['header_title'] = 'All CBT';
        return view('teacher.cbt.view_all', $data);
    }




    public function teacherEditCBT($id, $class_id)
    {
        $data['getRecord'] = CbtExam::findOrFail($id);
        $data['getClass'] = ClassModel::getMyClassList(Auth::id());
        $data['getExam'] = Exam::getMyTermList(Auth::id());
        $data['getSubject'] = ClassSubject::getAssignedClassSubject($class_id);

        $data['header_title'] = "Edit CBT";
        return view('teacher.cbt.edit', $data);
    }
    



    public function teacherAssignedCbtList(Request $request)
    {
        $data['getClass'] = ClassModel::getMyClassList(Auth::id());
        $data['getExam'] = Exam::getMyTermList(Auth::id());

        $data['getRecord'] = CbtAssign::getClassAssignedCBTList($request->class_id, $request->exam_id);

        // $data['getRecord'] = CbtAssign::where('class_id', $request->class_id)->where('exam_id', $request->exam_id)->paginate(50);

        
        $data['header_title'] = "Assigned CBT";
        return view('teacher.cbt.assigned_list', $data);
    }




    public function teacherAssignCBT($id)
    {
        $data['getClass'] = ClassModel::getMyClassList(Auth::id());
        $data['getExam'] = Exam::getMyTermList(Auth::id());

        $data['getRecord'] = CbtExam::findOrFail($id);

        $data['header_title'] = 'Assign CBT';
        return view('teacher.cbt.assign', $data);
    }
    


    public function teacherEditAssignCBT($id)
    {
        $data['getClass'] = ClassModel::getMyClassList(Auth::id());
        $data['getExam'] = Exam::getMyTermList(Auth::id());
        
        $data['getRecord'] = CbtAssign::findOrFail($id); // Fetch the specific assignment
        $data['getCbtExam'] = CbtExam::findOrFail($data['getRecord']->cbt_exam_id); // Fetch the CBT Exam details

        $data['header_title'] = 'Edit CBT Assignment';
        return view('teacher.cbt.edit_assigned', $data);
    }



    public function teacherCbtScoreView(Request $request)
    {
        $data['getClass'] = ClassModel::getMyClassList(Auth::id());
        $data['getExam'] = Exam::getMyTermList(Auth::id());

        $data['getAllWrittenCBT'] = CbtAssign::getAllWrittenCBT($request->class_id, $request->exam_id);
   
        $data['header_title'] = "CBT Scores";
        return view('teacher.cbt.score_view', $data);
    }




    public function teacherCbtScoreList(Request $request)
    {
        $data['getCbtDetails'] = CbtAttempt::getCbtDetails($request->class_id, $request->exam_id, $request->cbt_exam_id);

        $data['getSingleCBTScores'] = CbtAttempt::getSingleCBTScores($request->class_id, $request->exam_id, $request->cbt_exam_id);
   
        $data['header_title'] = "CBT Scores";
        return view('teacher.cbt.score_list', $data);
    }




    ////SUBJECT TEACHER
    public function subjectTeacherViewAll(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        $data['getSubject'] = SubjectTeacher::getTeacherSubjects(Auth::id());

        $data['getRecord'] = CbtExam::getSubjectTeacherCbt($request->class_id, $request->exam_id, Auth::id());

        $data['header_title'] = 'All CBT';
        return view('teacher.subject_teacher.cbt.view_all', $data);
    }


    public function subjectTeacherEditCBT($id, $class_id)
    {
        $data['getRecord'] = CbtExam::findOrFail($id);
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        $data['getSubject'] = SubjectTeacher::getTeacherSubjects(Auth::id());

        $data['header_title'] = "Edit CBT";
        return view('teacher.subject_teacher.cbt.edit', $data);
    }



    public function subjectTeacherUpdateCBT(Request $request, $id)
    {
        $request->validate([
            'exam_title'    => 'required',
            'class_id'      => 'required',
            'exam_id'       => 'required',
            'subject_id'    => 'required',
            'overall_score' => 'required',
            'duration'      => 'required',
            'status'        => 'required'
        ]);
        
        $cbt = CbtExam::findOrFail($id);

        $cbt->exam_title = $request->exam_title;
        $cbt->class_id = $request->class_id;
        $cbt->exam_id = $request->exam_id;
        $cbt->subject_id = $request->subject_id;
        $cbt->overall_score = $request->overall_score;
        $cbt->duration = $request->duration;
        $cbt->status = $request->status;
        $cbt->updated_by = Auth::user()->id;

        $cbt->save();
        
        return redirect()->route('subject_teacher.cbt.view.all')->with('success', 'CBT Updated Successfully!');

    }



    public function subjectTeacherAssignedCbtList(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        $data['getRecord'] = CbtAssign::getSubjectTeacherCBTList($request->class_id, $request->exam_id, Auth::id());

        // $data['getRecord'] = CbtAssign::where('class_id', $request->class_id)->where('exam_id', $request->exam_id)->paginate(50);

        
        $data['header_title'] = "Assigned CBT";
        return view('teacher.subject_teacher.cbt.assigned_list', $data);
    }




    public function subjectTeacherAssignCBT($id)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        $data['getRecord'] = CbtExam::findOrFail($id);

        $data['header_title'] = 'Assign CBT';
        return view('teacher.subject_teacher.cbt.assign', $data);
    }




    public function subjectTeacherStoreAssignCBT(Request $request, $cbt_exam_id)
    {

        if (!empty($request->class_id)) 
        {
            foreach ($request->class_id as $class_id) 
            {
                $alreadyExistingData = CbtAssign::alreadyExistingData($cbt_exam_id, $request->exam_id, $class_id);

                if (!empty($alreadyExistingData)) 
                {
                    $alreadyExistingData->status = $request->status;
                    $alreadyExistingData->save();
                } 
                else {
                    $data = new CbtAssign();
                    $data->cbt_exam_id = $cbt_exam_id;
                    $data->exam_id = $request->exam_id;
                    $data->class_id = $class_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }
            }
            
            return redirect()->route('subject_teacher.cbt.assigned.list')->with('success', 'CBT Successfully Assigned to Class(es)');

        } 
        else 
        {
            return redirect()->back()->with('error', 'Error! </br> Please Try Again with the right details');
        }
    }



    public function subjectTeacherEditAssignCBT($id)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();
        
        $data['getRecord'] = CbtAssign::findOrFail($id); // Fetch the specific assignment
        $data['getCbtExam'] = CbtExam::findOrFail($data['getRecord']->cbt_exam_id); // Fetch the CBT Exam details

        $data['header_title'] = 'Edit CBT Assignment';
        return view('teacher.subject_teacher.cbt.edit_assigned', $data);
    }



    public function subjectTeacherUpdateAssignCBT(Request $request, $id)
    {
        $data = CbtAssign::findOrFail($id);

        $existingAssignment = CbtAssign::where('cbt_exam_id', $data->cbt_exam_id)
            ->where('class_id', $request->class_id)
            ->where('exam_id', $request->exam_id)
            ->where('id', '!=', $id) // Exclude the current record
            ->first();

        if ($existingAssignment) {
            return redirect()->back()->with('warning', 'This CBT has already been assigned to the selected class and term.');
        }

        // Update the record
        $data->exam_id = $request->exam_id;
        $data->class_id = $request->class_id;
        $data->status = $request->status;
        $data->save();

        return redirect()->route('subject_teacher.cbt.assigned.list')->with('success', 'CBT Assignment Updated Successfully');

    }


    public function subjectTeacherCbtScoreView(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = Exam::getExam();

        $data['getAllWrittenCBT'] = CbtAssign::getTeacherAllWrittenCBT($request->class_id, $request->exam_id, Auth::id());
   
        $data['header_title'] = "CBT Scores";
        return view('teacher.subject_teacher.cbt.score_view', $data);
    }






















}

