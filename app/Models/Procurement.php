<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Procurement extends Model
{
    use HasFactory;

    

    static public function getProcurement()
    {
        $return = self::select('procurements.*');

                        //SEARCH FEATURE STARTS

                        if(!empty(Request::get('item_name')))
                        {
                            $return = $return->where('procurements.item_name', 'like', '%' . Request::get('item_name'). '%');
                            
                        }

                        if(!empty(Request::get('amount')))
                        {
                            $return = $return->where('procurements.amount', 'like', '%' . Request::get('amount'). '%');
                            
                        }

                        if(!empty(Request::get('purchase_date')))
                        {
                            $return = $return->whereDate('procurements.purchase_date', '=', Request::get('purchase_date'));
                        }
                        

                        
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('id', 'desc')
                        ->paginate(50);

        return $return;
    }


}
