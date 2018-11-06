<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Goods_attr;
use App\Models\Goods_img;
use DB;

class GoodsController extends Controller
{
    
    public function index()

    {
        return view('Admin.goods.Goods_Manage');
    }



    public function create()

    {
        // 分类数据 data1 
        // 品牌数据 dataa2
        $data1 = DB::table('goods_brand')->get();
        // dd($data1);
        $data2 = DB::table('goods_category')->where('parent_id','=','0')->get();
        // dd($data2);
        return view('Admin.goods.goods_add',[
            'data1'=>$data1,
            'data2'=>$data2
        ]);

    }



    public function store(Request $req)

    {
        // dd($req->all());
        // 插入商品基本信息并返回插入数据的id

        // 判断
        if($req->cat1 == null)
        {
            return "请选择分类";
        }else if($req->cat2 == null)
        {
            $cat_id = $req->cat1;
        }
        else if($req->cat3 == null)
        {
            $cat_id = $req->cat2;
        }
        else
        {
            $cat_id = $req->cat3;
        }

        dd($cat_id);

        $id = DB::table('goods')->insertGetId(
            ['name' => $req->name,
             'price' => $req->price,
             'status' => $req->status,
             'introduce' => $req->introduce,
             'brand_id' => $req->brand_id,
             'category_id' => $cat_id,
             ]
        );

        // 添加属性表
        // dd($req->attr_name,$req->attr_value);
        foreach($req->attr_name as $k=>$v)
        {
            // DB::table('goods_attribute')->insertGetId([
            //     ['name' =>$req->attr_name[$k], 'value' => $req->attr_value[$k], 'goods_id'=>2]
            // ]);
            DB::insert('insert into newds_goods_attribute (name, value,goods_id) values (?, ?, ?)', [$req->attr_name[$k], $req->attr_value[$k],$id]);
        }
       
        // 添加图片表
        foreach($req->image as $k=>$v)
        {
            if($req->has('image') && $v->isValid())
            {
                $date = date('Y-m-d');
                $path = $v->store('/goods/'.$date);
                $url = '/uploads/'.$path;
                // echo $url;
            }
            $id = DB::table('goods_image')->insertGetId(
                ['url' => $url, 'goods_id' => $id]
            );
            
        }
         return redirect('/goods_charge');
    }



    public function show($id)

    {


    }




    public function edit($id)

    {



    }




    public function update($id)

    {



    }


    public function destroy($id)

    {

    //

    }


    
}
