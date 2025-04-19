<?php

namespace App\Http\Controllers;

use App\Models\CbtAssign;
use App\Models\CbtAttempt;
use App\Models\CbtExam;
use App\Models\CbtQuestion;
use App\Models\CbtResponse;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
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
        $data['getSubject'] = Subject::all();

        $query = CbtExam::select('cbt_exams.*')
            ->leftJoin('classes', 'classes.id', '=', 'cbt_exams.class_id')
            ->leftJoin('subjects', 'subjects.id', '=', 'cbt_exams.subject_id')
            ->orderBy('cbt_exams.created_at', 'DESC');

        // Apply search filters
        if (!empty(FacadesRequest::get('name'))) {
            $query->where(function ($q) {
                $searchTerm = '%' . FacadesRequest::get('name') . '%';
                $q->where('cbt_exams.exam_title', 'like', $searchTerm)
                    ->orWhere('classes.name', 'like', $searchTerm)
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
            'exam_title' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'duration' => 'required',
            // 'status' => 'required|in:0,1',
        ]);
        
        $cbt = new CbtExam();

        $cbt->exam_title = $request->exam_title;
        $cbt->class_id = $request->class_id;
        $cbt->subject_id = $request->subject_id;
        $cbt->duration = $request->duration;
        $cbt->status = $request->status;
        $cbt->created_by = Auth::user()->id;
        $cbt->updated_by = null;

        $cbt->save();

        // dd($request->all());

        return redirect()->back()->with('success', 'CBT Exam Added Successfully!');
    }



    public function editCBT($id)
    {
        $data['getRecord'] = CbtExam::findOrFail($id);
        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = Subject::all();

        $data['header_title'] = "Edit CBT";
        return view('admin.cbt.edit', $data);
    }


    public function updateCBT(Request $request, $id)
    {
        $request->validate([
            'exam_title' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'duration' => 'required',
            'status' => 'required'
        ]);
        
        $cbt = CbtExam::findOrFail($id);

        $cbt->exam_title = $request->exam_title;
        $cbt->class_id = $request->class_id;
        $cbt->subject_id = $request->subject_id;
        $cbt->duration = $request->duration;
        $cbt->status = $request->status;
        $cbt->updated_by = Auth::user()->id;

        $cbt->save();

        return redirect()->route('cbt.view.all')->with('success', 'CBT Updated Successfully!');
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

        return redirect()->route('cbt.view.all')->with('warning', 'CBT Deleted Successfully!');
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
        $data['getTerm'] = Exam::all();

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

            return redirect()->route('cbt.assigned.list')->with('success', 'CBT Successfully Assigned to Class(es)');
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

        return redirect()->route('cbt.assigned.list')->with('success', 'CBT Assignment Updated Successfully');
    }



    public function deleteAssignedCBT($id)
    {
        $data = CbtAssign::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('warning', 'Assigned CBT Has Been Deleted Successfully!');
    }




    

    //STUDENT DASHBOARD SIDE

    public function studentCbtList(Request $request)
    {
        $data['getClass'] = ClassModel::getStudentClassList(Auth::user()->id);
        $data['getExam'] = Exam::getStudentTermList(Auth::user()->id);

        $data['getCBT'] = CbtAssign::getStudentCBT($request->class_id, $request->exam_id);

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

        $data['getStudent'] = Auth::user(); // Assuming the student is logged in
        $data['cbtExam'] = CbtExam::findOrFail($request->cbt_exam_id);
        $data['questions'] = CbtQuestion::where('cbt_exam_id', $request->cbt_exam_id)->get();



        $data['getStudent'] = User::where('id', Auth::user()->id)->first();
        
        $data['header_title'] = "Begin CBT";
        return view('student.cbt.cbt_begin', $data);
    }





    
    //EXAM HAS STARTED
    public function saveResponse(Request $request)
    {
        try {
            $request->validate([
                'question_id' => 'required|integer|exists:cbt_questions,id',
                'selected_option' => 'required|string',
            ]);

            $questionId = $request->question_id;
            $selectedOption = $request->selected_option;
            $studentId = Auth::id();

            $question = CbtQuestion::findOrFail($questionId);
            $isCorrect = ($selectedOption === $question->correct_option) ? 1 : 0;

            CbtResponse::updateOrCreate(
                ['student_id' => $studentId, 'question_id' => $questionId],
                ['selected_option' => $selectedOption, 'is_correct' => $isCorrect]
            );

            return response()->json(['message' => 'Response saved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function submitExam(Request $request)
    {
        try {
            $request->validate(['cbt_exam_id' => 'required|integer|exists:cbt_exams,id']);

            $studentId = Auth::id();
            $examId = $request->cbt_exam_id;

            $totalCorrect = CbtResponse::where('student_id', $studentId)
                ->whereHas('question', function ($query) use ($examId) {
                    $query->where('cbt_exam_id', $examId);
                })
                ->where('is_correct', 1)
                ->count();

            CbtAttempt::updateOrCreate(
                ['student_id' => $studentId, 'cbt_exam_id' => $examId],
                ['score' => $totalCorrect]
            );

            return response()->json(['message' => 'Exam submitted successfully', 'total_correct' => $totalCorrect], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }























}

