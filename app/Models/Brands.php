<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    //
    public $timestamps = false;
    protected $table = 'goods_brand';
    protected $fillable = ['brand_name','describle','status','logo'];
}
