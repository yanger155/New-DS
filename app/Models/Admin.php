<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    // public $table = 'admins';
    public $timestamps = false;
    public $fillable = ['name','password'];


}
