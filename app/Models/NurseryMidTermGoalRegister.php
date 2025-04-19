<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseryMidTermGoalRegister extends Model
{
    use HasFactory;


    static public function getClass($exam_id, $student_id)
    {
        return self::select('nursery_mid_term_goal_registers.*', 'classes.name as class_name', 'classes.section as class_section', 'classes.description as class_description')
                    ->join('classes', 'classes.id', '=', 'nursery_mid_term_goal_registers.class_id')
                    ->join('exams', 'exams.id', '=', 'nursery_mid_term_goal_registers.exam_id')
                    ->where('nursery_mid_term_goal_registers.exam_id', $exam_id)
                    ->where('nursery_mid_term_goal_registers.student_id', $student_id)
                    ->first();
    }



    public function subject()
    {
        return $this->belongsTo(NurseryMidtermSubject::class, 'subject_id');
        // return $this->belongsTo(NurserySubject::class, 'subject_id');
    }



    // Define the relationship with Category
    // THIS FUNCTION (CATEGORY) IS POINTING TO THE SUBJECT TABLE USING THE
    //CATEGORY_ID IN NURSERYMIDTERMGOALREGISTER TABLE
    public function category()
    {
        return $this->belongsTo(Subject::class, 'category_id');
        // return $this->belongsTo(SubjectCategory::class, 'category_id');
    }





}
