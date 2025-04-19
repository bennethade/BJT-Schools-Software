<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\NurseryMidtermSubject;
use App\Models\NurserySubject;
use App\Models\Subject;
use App\Models\SubjectCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Subject List";

        $data['getRecord'] = Subject::getRecord();
        return view('admin.subject.list', $data);
    }


    public function add()
    {
        $data['header_title'] = "Add Subject";
        return view('admin.subject.add', $data);
    }


    public function insert(Request $request)
    {
        $subject                    = new Subject;
        $subject->name              = $request->name;
        $subject->type              = $request->type;
        // $subject->subject_category  = $request->subject_category;
        $subject->school_section    = $request->school_section;
        $subject->status            = $request->status;
        $subject->created_by        = Auth::user()->id;
        $subject->save();

        return redirect()->route('subject.list')->with('success','Subject Created Successfully!');

        // dd($request->all());
    }



    public function edit($id)
    {
        $data['header_title'] = "Edit Subject";


        // $data['getRecord'] = ClassModel::findOrFail($id);
        $data['getRecord'] = Subject::getSingle($id);
        
        return view('admin.subject.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $subject                    = Subject::getSingle($id);

        $subject->name              = $request->name;
        $subject->type              = $request->type;
        // $subject->subject_category  = $request->subject_category;
        $subject->school_section    = $request->school_section;
        $subject->status            = $request->status;
        $subject->save();

        return redirect()->route('subject.list')->with('success','Subject Updated Successfully!');
    }


    public function delete($id)
    {
        $subject = Subject::getSingle($id);
        $subject->delete();
        // $subject->is_delete = 1;
        // $subject->save();

        return redirect()->route('subject.list')->with('warning','Subject Deleted Successfully!');
    }



    public function categoryList()
    {
        $data['header_title'] = "Subject Category List";

        $data['getRecord'] = SubjectCategory::getRecord();
        return view('admin.subject_category.list', $data);
    }



    public function categoryAdd()
    {
        $data['header_title'] = "Add Subject";
        return view('admin.subject_category.add', $data);
    }



    public function categoryInsert(Request $request)
    {
        $category                       = new SubjectCategory();
        $category->name                 = $request->name;
        $category->color                = $request->color;
        $category->status               = $request->status;
        $category->created_by           = Auth::user()->id;
        $category->save();

        return redirect()->route('subject.category.list')->with('success','Category Created Successfully!');

        // dd($request->all());
    }


    public function categoryEdit($id)
    {
        $data['header_title'] = "Edit Category";

        $data['getRecord'] = SubjectCategory::getSingle($id);
        
        return view('admin.subject_category.edit', $data);
    }


    public function categoryUpdate(Request $request, $id)
    {
        $category                    = SubjectCategory::getSingle($id);

        $category->name              = $request->name;
        $category->color             = $request->color;
        $category->status            = $request->status;
        $category->save();

        return redirect()->route('subject.category.list')->with('success','Category Updated Successfully!');
    }


    public function categoryDelete($id)
    {
        $category = SubjectCategory::getSingle($id);
        $category->delete();
        return redirect()->route('subject.category.list')->with('warning','Category Deleted Successfully!');
    }







    //STUDENT SIDE
    public function mySubject()
    {
        //The below line is the tutor's line of Code
        // $data['getRecord'] = ClassSubject::mySubject(Auth::user()->class_id);
        

        
        // Mine
        $data['getRecord'] = ClassSubject::mySubject(Auth::user()->id);
        $data['header_title'] = "My Subject";
        return view('student.my_subject', $data);
    }

    



    //PARENT SIDE
    public function parentStudentSubject($student_id)
    {
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;

        $data['getRecord'] = ClassSubject::mySubject($user->class_id);

        $data['header_title'] = "Student Subject";
        return view('parent.my_student_subject', $data);
    }



    public function nurserySubjectView(Request $request, $id)
    {
        // $data['record'] = NurserySubject::findOrFail($id);

        $data['getExam'] = Exam::getExam();

        $data['getRecord'] = NurserySubject::getRecord($request->class_id, $request->exam_id);

        $data['getClassName'] = ClassModel::getSingleClassName($request->class_id);

        $data['getTermName'] = Exam::getSingleExamName($request->exam_id);

        $data['subjectCategory'] = SubjectCategory::getRecord();
        
        $data['header_title'] = "Nursery Subject view";
        
        if(Auth::user()->user_type == '1' || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return view('admin.subject.nursery_subject.view', $data);
        }
        else
        {
            return view('teacher.my_student.nursery_subject', $data);
        }
    }



    


    public function nurserySubjectSubmit(Request $request)
    {
         $request->validate([
            'subject_goal' => 'required',
            'subject_category_id' => 'required|exists:subject_categories,id',
            'class_id' => 'required',
            'exam_id' => 'required',
            'status' => 'required|in:0,1',
        ]);
        
        $goal = new NurserySubject();

        $goal->name = $request->subject_goal;
        $goal->category_id = $request->subject_category_id;

        $goal->class_id = $request->class_id;
        $goal->exam_id = $request->exam_id;

        $goal->status = $request->status;
        $goal->created_by = Auth::user()->id;

        $goal->save();

        // dd($request->all());

        return redirect()->back()->with('success', 'Nursery Goal Added Successfully!');
    }

    

    public function nurserySubjectUpdate(Request $request, $id)
    {
        $data['record'] = NurserySubject::find($id);
        $data['subjectCategory'] = SubjectCategory::all();

        // Validate the form data
        $request->validate([
            'subject_goal' => 'required|string|max:255',
            'subject_category_id' => 'required|exists:subject_categories,id',
            'status' => 'required|in:0,1',
        ]);

        // Find the Subject Goal by ID and update it
        $goal = NurserySubject::findOrFail($id);
        $goal->name = $request->subject_goal;
        $goal->category_id = $request->subject_category_id;
        $goal->status = $request->status;
        $goal->save();

        return redirect()->back()->with('success', 'Subject Goal Updated Successfully!');
    }


    

    
    public function midtermNurserySubjectView(Request $request, $id)
    {
        // $data['record'] = NurserySubject::findOrFail($id);

        $data['getExam'] = Exam::getExam();

        $data['getRecord'] = NurseryMidtermSubject::getRecord($request->class_id, $request->exam_id);

        $data['getClassName'] = ClassModel::getSingleClassName($request->class_id);

        $data['getTermName'] = Exam::getSingleExamName($request->exam_id);

        // $data['subjectCategory'] = SubjectCategory::getRecord();

        $data['subjectCategory'] = ClassSubject::getAssignedClassSubject($request->class_id);
        
        $data['header_title'] = "Miterm Subject";
        
        if(Auth::user()->user_type == '1' || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin')
        {
            return view('admin.subject.midterm_subject.view', $data);
        }
        else
        {
            return view('teacher.my_student.midterm_subject', $data);
        }
    }




    public function midtermNurserySubjectSubmit(Request $request)
    {
         $request->validate([
            'subject_goal' => 'required',
            'subject_category_id' => 'required|exists:subjects,id',
            'class_id' => 'required',
            'exam_id' => 'required',
            'status' => 'required|in:0,1',
        ]);
        
        $goal = new NurseryMidtermSubject();

        $goal->name             = $request->subject_goal;
        $goal->category_id      = $request->subject_category_id;

        $goal->class_id         = $request->class_id;
        $goal->exam_id          = $request->exam_id;

        $goal->status           = $request->status;
        $goal->created_by       = Auth::user()->id;

        $goal->save();

        // dd($request->all());

        return redirect()->back()->with('success', 'Midterm Subject Added Successfully!');
    }




    public function midtermNurserySubjectUpdate(Request $request, $id)
    {
        $data['record'] = NurseryMidtermSubject::find($id);
        $data['subjectCategory'] = ClassSubject::getAssignedClassSubject($request->class_id);

        // Validate the form data
        $request->validate([
            'subject_goal' => 'required|string|max:255',
            'subject_category_id' => 'required|exists:subjects,id',
            'status' => 'required|in:0,1',
        ]);

        // Find the Subject Goal by ID and update it
        $goal               = NurseryMidtermSubject::findOrFail($id);
        $goal->name         = $request->subject_goal;
        $goal->category_id  = $request->subject_category_id;
        $goal->status       = $request->status;
        $goal->save();

        return redirect()->back()->with('success', 'Subject Goal Updated Successfully!');
    }
    












}


