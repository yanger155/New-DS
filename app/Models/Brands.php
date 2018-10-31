<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    //
    protected $table = 'goods_brand';
    protected $fillable = ['brand_name','logo','status','describle'];
}
