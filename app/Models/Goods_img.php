<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_img extends Model
{
    //
    protected $table = 'goods_image';
    protected $fillable = ['url','goods_id'];
    public $timestamps = false;
}
