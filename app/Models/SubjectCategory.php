<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class SubjectCategory extends Model
{
    use HasFactory, SoftDeletes;

    public static function getSingle($id)
    {
        return Self::findOrFail($id);
    }



    public static function getRecord()
    {
        return self::all();
    }

    public static function getSubjectCategories()
    {
        return self::select('subject_categories.*', 'subject_categories.name as subject_name')
                    
                    ->get();
    }


    public function goalRegisters()
    {
        return $this->hasMany(GoalRegister::class, 'category_id');
    }


    
}
