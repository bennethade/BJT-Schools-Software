<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Week extends Model
{
    use HasFactory, SoftDeletes;


    static public function getRecord()
    {
        return Week::get();
    }



    static public function getWeekUsingName($weekname)
    {
        return Week::where('name', '=', $weekname)->first();
    }



}
