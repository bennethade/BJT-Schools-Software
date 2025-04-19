<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class NurseryMidtermSubject extends Model
{
    use HasFactory, SoftDeletes;


    static public function getRecord($class_id, $exam_id)
    {
        $return = self::select(
                    'nursery_midterm_subjects.*',
                    'users.name as created_by_name',
                    'users.last_name as created_by_last_name',
                    'subjects.name as subject_category'
                    )
                    
                    ->join('users', 'users.id', '=', 'nursery_midterm_subjects.created_by')
                    ->join('subjects', 'subjects.id', '=', 'nursery_midterm_subjects.category_id')
                    ->where('nursery_midterm_subjects.status', '=', 1)
                    ->where('nursery_midterm_subjects.class_id', '=', $class_id)
                    ->where('nursery_midterm_subjects.exam_id', '=', $exam_id);

        if (!empty(Request::get('name'))) {
            $return = $return->where(function($query) {
                $query->where('nursery_midterm_subjects.name', 'like', '%' . Request::get('name') . '%')
                    ->orWhere('subjects.name', 'like', '%' . Request::get('name') . '%');
            });
        }

        return $return->orderBy('nursery_midterm_subjects.id', 'ASC')
                    ->get();
    }



    static public function getSubject($class_id, $exam_id)
    {
        return self::select('nursery_midterm_subjects.*', 'subjects.name as category_name')
                    ->join('subjects', 'subjects.id', '=', 'nursery_midterm_subjects.category_id')
                    ->where('nursery_midterm_subjects.status', '=', 1)
                    ->where('nursery_midterm_subjects.class_id', '=', $class_id)
                    ->where('nursery_midterm_subjects.exam_id', '=', $exam_id)
                    ->get();
    }






}
