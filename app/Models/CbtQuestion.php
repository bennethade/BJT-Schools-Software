<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'cbt_exam_id',
        'question',
        'image',
        'correct_option',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
    ];

    public function exam()
    {
        return $this->belongsTo(CbtExam::class);
    }


    public function getQuestionImage()
    {
        if(!empty($this->image) && file_exists('upload/question_images/'.$this->image))
        {
            return url('upload/question_images/'.$this->image);
        }
        else
        {
            return '';
        }

    }


    
}
