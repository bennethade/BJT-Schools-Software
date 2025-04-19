<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\AssignStudent;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\StudentSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


use function PHPUnit\Framework\isEmpty;

class AssignStudentController extends Controller
{
    public function view()   
    {
        $data['getClass'] = ClassModel::getClass();

        $data['header_title'] = 'Assign Student';
        return view('admin.assign_student.view', $data);
    }


    public function termList(Request $request)
    {
        $data['getExam'] = Exam::getExam();
        $data['className'] = ClassModel::getSingleClassName($request->class_id);

        $data['header_title'] = 'Assign Student List';
        return view('admin.assign_student.term_list', $data);
    }


    public function studentList(Request $request)
    {
        $data['getClassName'] = ClassModel::getSingleClassName($request->class_id);
        $data['getExamName'] = Exam::getSingleExamName($request->exam_id);

        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = AssignStudent::getAssignedClassStudent($request->class_id, $request->exam_id);


        $data['header_title'] = 'Assign Student List';
        return view('admin.assign_student.student_list', $data);
    }


    

    public function assignNow($class_id, $exam_id, $student_id)
    {
        $student = AssignStudent::checkAlreadyExiting($class_id, $exam_id, $student_id);
        if(empty($student))
        {
            $student = new AssignStudent;
            $student->class_id = $class_id;
            $student->exam_id = $exam_id;
            $student->student_id = $student_id;
            $student->created_by = Auth::user()->id;
            $student->save();
        }
        else{
            return redirect()->back()->with('warning', 'Student Already Assigned To This Class!');    
        }

        return redirect()->back()->with('success', 'Student Assigned To Class Successfully!');
    }





    public function editClassStudent($student_id)
    {
        $data['getRecord'] = User::getSingle($student_id);
        $data['getClass'] = ClassModel::getClass();

        $data['header_title'] = 'Edit Student';
        return view('admin.assign_student.edit_student', $data);
    }


    public function updateClassStudent(Request $request, $student_id)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$student_id,
            // 'blooad_group' => 'max:10',
            // 'admission_number' => 'max:50',
            // 'roll_number' => 'max:50',
            // 'mobile_number' => 'max:15|min:8',
            // 'caste' => 'max:50',
            // 'religion' => 'max:50',
            // 'height' => 'max:10',
            // 'weight' => 'max:10'
        ]); 

        $student = User::getSingle($student_id);
        
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->class_id = $request->class_id;
        

        $student->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename); 

            $student->profile_picture = $filename;
        }

        if(!empty($request->admission_date))
        {
            $student->admission_date = $request->admission_date;
        }
        
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        $student->email = $request->email;
        $student->status = $request->status;


        if(!empty($request->password))
        {
            $student->keep_track = $request->password;
            
            $student->password = Hash::make($request->password);
        }
        
        $student->save();

        return redirect()->back()->with('success', 'Student Data Updated Successfully!');

    }


    public function removeAssignedStudent($class_id, $exam_id, $student_id)
    {
        
        AssignStudent::where('class_id', $class_id)->where('exam_id', $exam_id)->where('student_id', $student_id)->delete();
        
        return redirect()->back()->with('warning', 'Student Removed From Class Successfully!');
        
    }


    public function unlockStudent(Request $request)
    {
        $data = AssignStudent::checkAlreadyExiting($request->class_id, $request->exam_id, $request->student_id);

        if($data)
        {
            $data->lock_student = 0;
            $data->save();
        }

        return Redirect::back()->with('success', 'Student Unlocked Successfully!');
    }


    public function lockStudent(Request $request)
    {
        $data = AssignStudent::checkAlreadyExiting($request->class_id, $request->exam_id, $request->student_id);

        if($data)
        {
            $data->lock_student = 1;
            $data->save();
        }

        return Redirect::back()->with('warning', 'Student Has Been Locked Successfully');
    }















    ///NOT YET IN USE
    //==== FOR POPUP SEARCH STUDENT TO ADD TO CLASS====///
    public function autoComplete(Request $request)
    {
        $data = User::select('name')->where('name','like',"%{$request->input('query')}%")->get();
        return response()->json($data);
    }


    
    public function searchService(Request $request)
    {
        $students = Str::slug($request->q,'-');
        if($students)
        {
            // return redirect('/service/'.$service_slug);
            return redirect()->route('assign_student.add_student')->with('success', 'Student Assigned to Class Successfully!');
        }
        else
        {
            return back();
        }
    }
    ///===POPUP ENDS HERE===/////







    ///FOR TEACHERS 
    public function teacherAssignStudentClassList()
    {
        $data['getClass'] = AssignClassTeacher::getMyClassSubjectGroup(Auth::user()->id);

        $data['header_title'] = 'Class List';
        return view('teacher.my_student.class_list', $data);

    }

    

    public function teacherAssignStudentTermList($class_id)
    {
        // $data['getExam'] = Exam::getExam();
        $data['getExam'] = AssignClassTeacher::getTeacherAssignedTerm($class_id);

        $data['className'] = ClassModel::getSingleClassName($class_id);

        $data['header_title'] = 'Term List';
        return view('teacher.my_student.term_list', $data);
    }



    public function teacherAssignStudentList($class_id, $exam_id)
    {
        $data['getClassName'] = ClassModel::getSingleClassName($class_id);
        $data['getExamName'] = Exam::getSingleExamName($exam_id);

        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = AssignStudent::getAssignedClassStudent($class_id, $exam_id);


        $data['header_title'] = 'Student List';
        return view('teacher.my_student.student_list', $data);
    }


    public function teacherAssignStudentNow($class_id, $exam_id, $student_id)
    {
        $student = AssignStudent::checkAlreadyExiting($class_id, $exam_id, $student_id);
        if(empty($student))
        {
            $student = new AssignStudent;
            $student->class_id = $class_id;
            $student->exam_id = $exam_id;
            $student->student_id = $student_id;
            $student->created_by = Auth::user()->id;
            $student->save();
        }
        else{
            return redirect()->back()->with('warning', 'Student Already Assigned To This Class!');    
        }

        return redirect()->back()->with('success', 'Student Assigned To Class Successfully!');
    }



    public function teacherRemoveAssignedStudent($class_id, $exam_id, $student_id)
    {
        
        AssignStudent::where('class_id', $class_id)->where('exam_id', $exam_id)->where('student_id', $student_id)->delete();
        
        return redirect()->back()->with('warning', 'Student Removed From Class Successfully!');
        
    }


    public function teacherEditAssignedStudent(Request $request)
    {
        $data['getRecord'] = User::findOrFail($request->student_id);

        $data['header_title'] = "Edit Student";
        return view('teacher.my_student.edit_student', $data);
    }


    public function teacherUpdateAssignedStudent(Request $request, $student_id)
    {
        $student = User::getSingle($student_id);
        
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;        

        $student->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 

            $student->profile_picture = $filename;      //For the DB Field
        }

        if(!empty($request->admission_date))
        {
            $student->admission_date = $request->admission_date;
        }
        
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;
        
        $student->save();


        return redirect()->back()->with('success', 'Student Data Updated Successfully!');
    }




    public function promotionView()
    {
        $data['getClass'] = ClassModel::getClass();

        $data['getExam'] = Exam::getExam();

        $data['header_title'] = "Student Promotion";
        return view('admin.assign_student.promote_students', $data);
    }



    
    public function promotionSubmit(Request $request)
    {
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;

        $students = AssignStudent::where('class_id', $class_id)->where('exam_id', $exam_id)->get();

        if ($students->isNotEmpty()) {
            foreach ($students as $student) {
                
                $existingStudent = AssignStudent::where('class_id', $request->new_class_id)
                                        ->where('exam_id', $request->new_exam_id)
                                        ->where('student_id', $student->student_id)
                                        ->first();

                if ($existingStudent) {
                    return redirect()->back()->with('error', 'Students in this Class and Term have already been promoted');
                }

                else{
                    $newRecord = new AssignStudent();
                    $newRecord->class_id = $request->new_class_id;
                    $newRecord->exam_id = $request->new_exam_id;
                    $newRecord->student_id = $student->student_id; 
                    $newRecord->created_by = Auth::user()->id;
                    $newRecord->save();
                }
            }

            return redirect()->back()->with('success', 'Class Students Promoted Successfully!');
        }

        return redirect()->back()->with('error', 'No students found for the chosen Class and Term');
    }



    
    public function studentsInTerm(Request $request)
    {
        $data['getExam'] = Exam::getExam();

        $data['getStudentCount'] = null; 

        if (!empty($request->exam_id)) {
            $data['getStudentCount'] = AssignStudent::where('exam_id', $request->exam_id)->count();
        }


        $data["header_title"] = "Students In Term";
        return view('admin.assign_student.student_in_term', $data);
    }







}
