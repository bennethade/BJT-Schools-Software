<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksGrade extends Model
{
    use HasFactory;




    static public function getSingle($id)
    {
        return MarksGrade::findOrFail($id);
    }


    static public function getRecord()
    {
        return self::select('marks_grades.*', 'users.name as created_name')
                    ->join('users', 'users.id', '=', 'marks_grades.created_by')
                    ->get();
    }



    static public function getGrade($percent)
    {
        $return = MarksGrade::select('marks_grades.*')
                    ->where('percent_from', '<=', $percent)
                    ->where('percent_to', '>=', $percent)
                    ->first();

        return !empty($return->name) ? $return->name : '';
                    
    }


    
}
