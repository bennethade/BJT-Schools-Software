<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtAttempt extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(CbtResponse::class);
    }
    
}
