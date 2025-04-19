<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalRegister extends Model
{
    use HasFactory;


    static public function getClass($exam_id, $student_id)
    {
        return self::select('goal_registers.*', 'classes.name as class_name', 'classes.section as class_section', 'classes.description as class_description')
                    ->join('classes', 'classes.id', '=', 'goal_registers.class_id')
                    ->join('exams', 'exams.id', '=', 'goal_registers.exam_id')
                    ->where('goal_registers.exam_id', $exam_id)
                    ->where('goal_registers.student_id', $student_id)
                    ->first();
    }


    public function subject()
    {
        return $this->belongsTo(NurserySubject::class, 'subject_id');
    }

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(SubjectCategory::class, 'category_id');
    }


}
