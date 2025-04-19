<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class NurserySubject extends Model
{
    use HasFactory, SoftDeletes;

    static public function getRecord($class_id, $exam_id)
    {
        $return = self::select(
                    'nursery_subjects.*',
                    'users.name as created_by_name',
                    'users.last_name as created_by_last_name',
                    'subject_categories.name as subject_category'
                    )
                    
                    ->join('users', 'users.id', '=', 'nursery_subjects.created_by')
                    ->join('subject_categories', 'subject_categories.id', '=', 'nursery_subjects.category_id')
                    ->where('nursery_subjects.status', '=', 1)
                    ->where('nursery_subjects.class_id', '=', $class_id)
                    ->where('nursery_subjects.exam_id', '=', $exam_id);

        if (!empty(Request::get('name'))) {
            $return = $return->where(function($query) {
                $query->where('nursery_subjects.name', 'like', '%' . Request::get('name') . '%')
                    ->orWhere('subject_categories.name', 'like', '%' . Request::get('name') . '%');
            });
        }

        return $return->orderBy('subject_categories.name', 'ASC')
                    ->get();
    }





    static public function getSubject($class_id, $exam_id)
    {
        return self::select('nursery_subjects.*', 'subject_categories.name as category_name')
                    ->join('subject_categories', 'subject_categories.id', '=', 'nursery_subjects.category_id')
                    ->where('nursery_subjects.status', '=', 1)
                    ->where('nursery_subjects.class_id', '=', $class_id)
                    ->where('nursery_subjects.exam_id', '=', $exam_id)
                    ->orderBy('subject_categories.name', 'asc')
                    ->get();
    }


    public function goalRegisters()
    {
        return $this->hasMany(GoalRegister::class, 'subject_id');
    }


    


}
