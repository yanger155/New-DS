<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 默认情况下Eloquent将假设User模型将记录存储在users表中
    // protected $table = 'users';
    public $timestamps = false;

    // $flights = App\Flight::where('active', 1)
    //            ->orderBy('name', 'desc')
    //            ->take(10)
            //    ->get();
}
