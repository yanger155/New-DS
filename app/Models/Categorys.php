<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    //
    protected $table = 'goods_category';
    protected $fillable = ['category_name','parent_id','category_path'];
    public $timestamps = false;
}
