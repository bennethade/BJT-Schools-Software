<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksRegister extends Model
{
    use HasFactory;


    static public function checkAlreadyMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return MarksRegister::where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }


    static public function getExam($student_id)
    {
        return self::select('marks_registers.*', 'exams.name as exam_name', 'exams.session as exam_session')
                    ->join('exams', 'exams.id', '=', 'marks_registers.exam_id')
                    ->where('marks_registers.student_id', '=', $student_id)
                    ->groupBy('marks_registers.exam_id')
                    ->get();
    }



    static public function getExamSubject($exam_id, $student_id)
    {
        return self::select('marks_registers.*', 'exams.name as exam_name', 'exams.session as exam_session', 'subjects.name as subject_name')
                    ->join('exams', 'exams.id', '=', 'marks_registers.exam_id')
                    ->join('subjects', 'subjects.id', '=', 'marks_registers.subject_id')


                    //THIS LINE MAKES THE QUERY RESULTS TO KEEP REPEATING
                    // ->join('exam_schedules', 'exam_schedules.exam_id', '=', 'marks_registers.exam_id')
                    // ->join('exam_schedules as exam_schedule_class', 'exam_schedules.class_id', '=', 'marks_registers.class_id')
                    // ->join('exam_schedules as exam_schedule_subject', 'exam_schedules.subject_id', '=', 'marks_registers.subject_id')
                    //END REPEATITIVE QUERY
                    


                    ->where('marks_registers.exam_id', '=', $exam_id)
                    ->where('marks_registers.student_id', '=', $student_id)
                    ->get();

    }


    
    static public function getClass($exam_id, $student_id)
    {
        return self::select('classes.id as class_id', 'classes.name as class_name', 'classes.section as section', 'classes.description as description')
                    ->join('exams', 'exams.id', '=', 'marks_registers.exam_id')
                    ->join('classes', 'classes.id', '=', 'marks_registers.class_id')
                    ->join('subjects', 'subjects.id', '=', 'marks_registers.subject_id')
                    ->where('marks_registers.exam_id', '=', $exam_id)
                    ->where('marks_registers.student_id', '=', $student_id)
                    ->first();

    }


    static public function getExamName($student_id)
    {
        //USED IN THE FEES BREAKDOWN PAGE (feesBreakdown function) IN FEESCOLLECTION CONTROLLER
        return self::select('marks_registers.*', 'exams.name as exam_name', 'exams.session as exam_session')
                    ->join('exams', 'exams.id', '=', 'marks_registers.exam_id')
                    ->where('marks_registers.student_id', '=', $student_id)
                    ->first();
    }



    //MY CODES START
    static public function marksSubjectCount($exam_id, $student_id)
    {
        //To be used for student average
        return self::select('marks_registers.*')
                    // ->join('classes', 'classes.id', '=', 'marks_registers.class_id')
                    ->where('marks_registers.student_id', $student_id)
                    ->where('marks_registers.exam_id', $exam_id)
                    ->where('marks_registers.exam', '!=', 0)
                    ->count();
    }


    static public function classAverage($class_id, $exam_id)
    {
        return self::select('marks_registers.*')
            ->join('classes', 'classes.id' , '=', 'marks_registers.class_id')
            ->where('marks_registers.exam_id', '=', $exam_id)
            ->where('marks_registers.class_id', '=', $class_id)
            ->avg('subject_total');
    }


    public static function subjectHighestScores($class_id, $exam_id, $subject_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('subject_id', $subject_id)->max('subject_total');
    }



    public static function subjectLowestScores($class_id, $exam_id, $subject_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('subject_id', $subject_id)->where('subject_total', '!=', '0')->min('subject_total');
    }




    //FOR CA SUBJECT HIGHEST AND LOWEST
    // public static function subjectHighestCaScore($class_id, $exam_id, $subject_id)
    // {
    //     return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('subject_id', $subject_id)->max('ca');
    // }



    // public static function subjectLowestCaScore($class_id, $exam_id, $subject_id)
    // {
    //     return self::where('class_id', $class_id)->where('exam_id', $exam_id)->where('subject_id', $subject_id)->where('subject_total', '!=', '0')->min('ca');
    // }




    public static function caHighestScore($class_id, $exam_id, $subject_id)
    {
        return self::where('class_id', $class_id)
                    ->where('exam_id', $exam_id)
                    ->where('subject_id', $subject_id)
                    ->selectRaw('MAX(ca + home_fun + attendance + class_work) as max_combined_score')
                    ->value('max_combined_score');
    }


    public static function caLowestScore($class_id, $exam_id, $subject_id)
    {
        return self::where('class_id', $class_id)
                    ->where('exam_id', $exam_id)
                    ->where('subject_id', $subject_id)
                    ->where('subject_total', '!=', '0') // Ensuring total is not zero
                    ->selectRaw('MIN(ca + home_fun + attendance + class_work) as min_combined_score')
                    ->value('min_combined_score');
    }





    public static function classHighest($class_id, $exam_id)
    {
        return self::where('class_id', $class_id)->where('exam_id', $exam_id)->max('subject_total');
    }




    public static function getTermScores($class_id, $student_id, $subject_id, $term_id)
    {
        return self::where('class_id', $class_id)
            ->where('student_id', $student_id)
            ->where('subject_id', $subject_id)
            ->where('exam_id', $term_id)
            ->limit(1)
            ->get();
    }




    



    

    ///DERA CODES
    // public static function subject_total_cat2($subject_id,$class_id,$term_id){
    //     return  SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->sum('CAT2');
     
    // }
    // public static function max_score_cat2($id,$class_id,$term_id){
    //     $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->max('CAT2');
        
    //     return $scores;
    // }
    // public static function min_score_cat2($id,$class_id,$term_id){
    //     return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->min('CAT2');
       
    // }
    // public static function subject_total_msc($subject_id,$class_id,$term_id){
    //     return SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->sum('MSC');

    // }
    // public static function max_score_msc($id,$class_id,$term_id){
    //     return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->max('MSC');
    
    // public static function min_score_msc($id,$class_id,$term_id){
    //     return SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->min('MSC');
    // }





}
