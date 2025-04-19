<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscellaneousCodes extends Model
{
    use HasFactory;



    public function store(StudentRequest $request)
    {
        
     $student = $request->isMethod('put') ? Student::findOrFail($request->student_id) : new Student;
     
    // if ($request->get('photo')) {
    //   $photo = $request->get('photo');
    //   $name = time() . '.' . explode('/', explode(':', substr($photo, 0, strpos($photo, ';')))[1])[1];
    //   $save_path = public_path('storage/Students/' . $name);
    //   \Image::make($request->get('photo'))->save($save_path);
     
    // }
    
    $student->name = $request->name;
    $student->oname = $request->oname;
    $student->surname = $request->surname;
    $student->roll_no = Student::max('id') + 1;
    $student->photo = '';
    $student->reg_no = $request->reg_no;
    $student->email = strtolower($student->name[0] . str_ireplace(' ', '', $student->surname)) . $student->roll_no . '@lwa.edu.ng';
    $student->dob = $request->dob;
    $student->gender = $request->gender;
    $student->s_class = $request->s_class;
    $student->level = s5Class::find($request->s_class)->status;
    if($student->save()){
      $pass = strtolower($student->name[0]. $student->surname.$student->roll_no);
      $user = new User();
      $user->name = $student->name . '.' . $student->surname;
      $user->email = $student->email;
      $user->keep_track = $pass;
      $user->password = Hash::make($pass);
      $user->isAdmin = 4;
      $user->student_id = $student->id;
      $user->save();
      $student->keep_track = $pass;
      $student->save();
      return new StudentResource($student);
     }
        
    }



    public static function h_behave($behave){
        if ($behave == 1){
            echo " <td><input type='checkbox' onclick='return false;'>  </td>
                   <td > <input type='checkbox' onclick='return false;'></td>
                   <td > <input type='checkbox' onclick='return false;'></td>
                   <td > <input type='checkbox' onclick='return false;'></td>
                   <td ><input type='checkbox'  checked onclick='return false;'></td>";
           }    
           elseif($behave == 2){
               echo "<td><input type='checkbox' onclick='return false;'>  </td>
               <td > <input type='checkbox' onclick='return false;'></td>
               <td > <input type='checkbox' onclick='return false;'></td>
               <td > <input type='checkbox' checked onclick='return false;'></td>
               <td ><input type='checkbox'  onclick='return false;'></td>";
           }    
           elseif($behave == 3){
           echo "<td><input type='checkbox' onclick='return false;'>  </td>
           <td > <input type='checkbox' onclick='return false;'></td>
           <td > <input type='checkbox' checked onclick='return false;'></td>
           <td > <input type='checkbox' onclick='return false;'></td>
           <td ><input type='checkbox'  onclick='return false;'></td>";
           }
           elseif($behave == 4){      
           echo "<td><input type='checkbox' onclick='return false;'>  </td>
           <td > <input type='checkbox' checked onclick='return false;'></td>
           <td > <input type='checkbox' onclick='return false;'></td>
           <td > <input type='checkbox' onclick='return false;'></td>
           <td ><input type='checkbox' onclick='return false;'></td>";
           } 
           elseif($behave == 5){      
            echo "<td><input type='checkbox' checked onclick='return false;'>  </td>
            <td > <input type='checkbox' onclick='return false;'></td>
            <td > <input type='checkbox' onclick='return false;'></td>
            <td > <input type='checkbox' onclick='return false;'></td>
            <td ><input type='checkbox'  onclick='return false;'></td>";
            } 
    }


    public static function h_min_score($id,$class_id,$term_id){
        return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->min('GT');
    
    }
    
    public static function h_max_score($id,$class_id,$term_id ){
       return  SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->max('GT');
    }
    
    public static function getStudentsInClass($id,$class_id){
        $term = Term::find($id);
        $class_T = S5Class::find($class_id);
        $student_id = StudentTerm::where('s5_class_id', $class_id)->where('term_id',$id)->get();
        $ids = array();
        foreach($student_id as $id){
          array_push($ids,$id->student_id);
        } 
        $students = Student::whereIn('id',$ids)->orderBy('name', 'ASC')->get();
        return ['term'=>$term,'class_T'=>$class_T,'students'=>$students];
      }
     
    public static function Score($class_id,$term_id,$st){
        $students = SubjectMark::where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($students as  $student) {
            # code...
            $sum = SubjectMark::where('term_id',$term_id)->where('student_id',$student->student_id)->where('s5_class_id',$class_id)->sum('GT');
          array_push($score_list,$sum);
        }
        if($st == 1){
             return round(min($score_list));
        }elseif($st ==2 ){
             return round(max($score_list));
        }
       
    }



    public static function subject_total_cat2($subject_id,$class_id,$term_id){
        return  SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->sum('CAT2');
     
    }
    public static function max_score_cat2($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->max('CAT2');
        
        return $scores;
    }
    public static function min_score_cat2($id,$class_id,$term_id){
        return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->min('CAT2');
       
    }
    public static function subject_total_msc($subject_id,$class_id,$term_id){
        return SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->sum('MSC');

    }
    public static function max_score_msc($id,$class_id,$term_id){
        return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->max('MSC');
        
    }
    public static function min_score_msc($id,$class_id,$term_id){
        return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->min('MSC');
    }




}
