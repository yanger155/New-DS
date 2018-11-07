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
        $data = DB::table("goods")->get();
        // dd($data); 
        return view('Admin.goods.Goods_Manage',['data'=>$data]);
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
        // 插入商品基本信息并返回插入数据的id-------------
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

        $category = DB::table('goods_category')->where('id','=',$cat_id)->first();
        $brand = DB::table('goods_brand')->where('id','=',$req->brand_id)->first();

        $id = DB::table('goods')->insertGetId(
            ['name' => $req->name,
             'price' => $req->price,
             'status' => $req->status,
             'introduce' => $req->introduce,
             'brand_name' => $brand->brand_name,
             'category_name' => $category->category_name,
             ]
        );

        // 添加属性表----------------------------
        // dd($req->attr_name,$req->attr_value);
        foreach($req->attr_name as $k=>$v)
        {
            // DB::table('goods_attribute')->insertGetId([
            //     ['name' =>$req->attr_name[$k], 'value' => $req->attr_value[$k], 'goods_id'=>2]
            // ]);
            DB::insert('insert into newds_goods_attribute (name, value,goods_id) values (?, ?, ?)', [$req->attr_name[$k], $req->attr_value[$k],$id]);
        }
       
        // 添加图片表---------------------------
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



    public function edit($id)
    {
        // 查询数据放入数据
        $data1 = DB::table('goods_brand')->get();
        $data2 = DB::table('goods_category')->where('parent_id','=','0')->get();
        // 获取渲染的数据
        // 商品详情
        $data3 = DB::table('goods')->where('id','=',$id)->first();
        // dd($data3);
        // 商品属性
        $data4 = DB::table('goods_attribute')->where('goods_id','=',$id)->get();
        // dd($data4);
        // 商品图片
        $data5 = DB::table('goods_image')->where('goods_id','=',$id)->get();
        // dd($data5);

        return view('Admin.goods.goods_edit',[
            'data1'=>$data1,
            'data2'=>$data2,
            'data3'=>$data3,
            'data4'=>$data4,
            'data5'=>$data5
        ]);

    }




    public function update(Request $req,$id)
    {
        // dd($req->all());
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

        $category = DB::table('goods_category')->where('id','=',$cat_id)->first();
        $brand = DB::table('goods_brand')->where('id','=',$req->brand_id)->first();
        // 修改商品表
        Goods::where('id', $id)
              ->update(['name' => $req->name],
                       ['price' => $req->price],
                       ['status' => $req->status],
                       ['introduce' => $req->introduce],
                       ['brand_name' => $brand->brand_name],
                       ['category_name' => $category->category_name]);
        // 修改属性表
        foreach($req->attr_name as $k=>$v)
        {
            Goods_attr::where('goods_id', $id)
                        ->update(['name' => $req->attr_name[$k]],
                                 ['value' => $req->attr_value[$k]]);
        }

        // 修改图片表
        // $img = DB::table('goods_image')->where('goods_id',$id)->value('url');
        $count = DB::table('goods_image')->where('goods_id',$id)->count();
        // dd($count);
        if(!$count)
        {
            // 如果原先的图片不存在就插入新的图片
                foreach($req->image as $k=>$v)
                {
                    if($req->has('image') && $v->isValid())
                    {
                        $date = date('Y-m-d');
                        $path = $v->store('/goods/'.$date);
                        $url = '/uploads/'.$path;
                        // echo $url;
                    }
                    DB::table('goods_image')->insert(
                        ['url' => $url, 'goods_id' => $id]
                    );  
                }
        }
        else
        {  
            // 如果原先存有图片就删除原有图片然后更新
            $img = DB::table('goods_image')->where('goods_id',$id)->get();
            foreach($img as $m)
            {
                // dd('public'.$m->url);
                @unlink(base_path('public'.$m->url));
            }

            // 这里必须要有图片的上传，如果没有，图片将会被删掉
            Goods_img::where('goods_id',$id)->delete();

            
            foreach($req->image as $k=>$v)
            {
                if($req->has('image') && $v->isValid())
                {
                    $date = date('Y-m-d');
                    $path = $v->store('/goods/'.$date);
                    $url = '/uploads/'.$path;
                }
                Goods_img::where('goods_id', $id)
                            ->insert(['url' => $url, 'goods_id' => $id]);  
            }
        }
        return redirect('/goods_charge');
       
    }


    public function goods_del($id)
    {
        // 删除属性
        DB::table('goods_attribute')->where('goods_id','=',$id)->delete();
        // 删除图片
        $image = DB::table('goods_image')->where('goods_id','=',$id)->get();
        foreach ($image as $v)
        {
            // 删除本地保存的图片
            @unlink(base_path('public/'.$v->url));
        }
        DB::table('goods_image')->where('goods_id','=',$id)->delete();
        // 删除商品
        DB::table('goods')->where('id','=',$id)->delete();
        return redirect('/goods_charge');
    }


    
}
