<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Club extends Model
{
    use HasFactory;

    static public function getRecord()
    {
        $return = self::select('clubs.*');
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('clubs.name', 'like', '%' . Request::get('name') . '%');
                        }
        $return = $return->paginate(50);

        return $return;
    }


    static public function getRecordParent()
    {
        $return = self::select('clubs.*')
                        ->where('status', 1);

                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('clubs.name', 'like', '%' . Request::get('name') . '%');
                        }
                        
        $return = $return->paginate(20);

        return $return;
    }




}
