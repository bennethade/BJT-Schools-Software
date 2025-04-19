<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Suggestion extends Model
{
    use HasFactory;

    static public function getRecord()
    {
        $return = self::select('suggestions.*', 'users.name as created_by_name', 'users.last_name as created_by_last_name')
                        ->join('users', 'users.id', '=', 'suggestions.created_by');
                        // ->where('suggestions.status', '=', 1);

                        //SEARCH FEATURE STARTS

                        if(!empty(Request::get('title'))) {
                            $return = $return->where(function($query) {
                                $query->where('suggestions.title', 'like', '%' . Request::get('title') . '%')
                                      ->orWhere('suggestions.description', 'like', '%' . Request::get('title') . '%');
                            });
                        }
                        
                        
        $return = $return->orderBy('suggestions.id', 'desc')
                        ->paginate(20);

        return $return;

    }


    static public function userGetRecord($teacher_id)
    {
        $return = self::select('suggestions.*', 'users.name as created_by_name', 'users.last_name as created_by_last_name')
                        ->join('users', 'users.id', '=', 'suggestions.created_by');

                        //SEARCH FEATURE STARTS

                        if(!empty(Request::get('title'))) {
                            $return = $return->where(function($query) {
                                $query->where('suggestions.title', 'like', '%' . Request::get('title') . '%')
                                      ->orWhere('suggestions.description', 'like', '%' . Request::get('title') . '%');
                            });
                        }
                        
                        
        $return = $return->where('created_by', '=', $teacher_id)
                        ->orderBy('suggestions.id', 'desc')
                        ->paginate(20);

        return $return;

    }


    


}
