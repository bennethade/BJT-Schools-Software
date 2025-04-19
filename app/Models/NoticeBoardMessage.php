<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoardMessage extends Model
{
    use HasFactory;

    protected $table = 'notice_board_messages';


    static public function deleteRecord($id)
    {
        NoticeBoardMessage::where('notice_board_id', '=', $id)->delete();
    }

}
