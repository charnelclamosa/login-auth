<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Person extends Model
{
    use HasApiTokens, HasFactory;

    // public function user()
    // {
    //     // return $this->belongsTo('App\Models\User');
    // }

}
