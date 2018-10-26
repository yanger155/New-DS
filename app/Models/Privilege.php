<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    //
    public $timestamps = false;
    public $fillable = ['privilege_name','privilege_path'];
}
