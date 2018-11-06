<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorys;
use DB;

class CategorysController extends Controller
{

    // ajax获取子分类
    public function ajax_getcat($parent_id)
    {
        $data = DB::table('goods_category')->where('parent_id','=',$parent_id)->get();
        // dd($data);
        echo json_encode($data);
    }

    
    public function index()
    {
        //  select * from newds_goods_category order by concat(path,id,"-")
        // 查询所有的分类渲染到页面
        // $data = DB::table("goods_category")->get();
        $data = DB::select('select * from newds_goods_category order by concat(category_path,id,"-")');
        // dd($data);
        // var_dump($data);
        $data = json_decode(json_encode($data),true);
        // dd($data);
        return view('Admin.goods.Category_Manage',['data'=>$data]);
    }

    public function create()
    {
        // 获取分类数据
        $data = DB::table('goods_category')->where('parent_id','=','0')->get();
        // echo "<pre>";
        // var_dump($data);
        return view('Admin.goods.category_add',['data'=>$data]);

    }

    // 处理添加分类的表单
    public function store(Request $req)
    {
        // echo "dfv";
        $category = new Categorys;
        // dd($req->all());

        $parent_id = '';
        $path = '';

        if($req->cat1 == null && $req->cat2 == null && $req->cat3 == null)
        {
            $parent_id = 0;
            // $cat_name = $_POST['cat_name'];
            $path = '-';
        }
        else if($req->cat2 == null && $req->cat3 == null)
        {
            $parent_id = $req->cat1;
            // $cat_name = $_POST['cat_name'];
            $path = '-'.$parent_id.'-';
        }
        else if($req->cat3 == null)
        {
            $parent_id = $req->cat2;
            // $cat_name = $_POST['cat_name'];
            $path = '-'.$req->cat1.'-'.$req->cat2.'-';
        }
        else
        {
            $parent_id = $req->cat3;
            // $cat_name = $_POST['catid3']
            $path = '-'.$req->cat1.'-'.$req->cat2.'-'.$req->cat3.'-';
        }
        
        $category = new Categorys;
        $category->category_name = $req->category_name;
        $category->parent_id = $parent_id; 
        $category->category_path = $path;
        $category->save();
        return redirect('/category_charge');

    }



    public function edit($id)
    {
        // 两批数据
        $category = new Categorys;
        // $data1 = Categorys::where('id',$id)->first();
        $data1 = DB::table('goods_category')->where('id',$id)->first();
        // dd($data1);
        // $data2 = Categorys::where('parent_id','=','0')->get();
        $data2 = DB::table('goods_category')->where('parent_id','=','0')->get();
        // dd($data2);
        return view('Admin.goods.category_edit',[
            'data1'=>$data1,
            'data2'=>$data2,
        ]);

    }

    public function update(Request $req,$id)
    {
        // echo "agnldgn";
        $parent_id = '';
        $path = '';

        if($req->cat1 == null && $req->cat2 == null && $req->cat3 == null)
        {
            $parent_id = 0;
            // $cat_name = $_POST['cat_name'];
            $path = '-';
        }
        else if($req->cat2 == null && $req->cat3 == null)
        {
            $parent_id = $req->cat1;
            // $cat_name = $_POST['cat_name'];
            $path = '-'.$parent_id.'-';
        }
        else if($req->cat3 == null)
        {
            $parent_id = $req->cat2;
            // $cat_name = $_POST['cat_name'];
            $path = '-'.$req->cat1.'-'.$req->cat2.'-';
        }
        else
        {
            $parent_id = $req->cat3;
            // $cat_name = $_POST['catid3']
            $path = '-'.$req->cat1.'-'.$req->cat2.'-'.$req->cat3.'-';
        }

        $category = Categorys::updateOrCreate(
            ['id' => $id],
            ['category_name' => $req->category_name ],
            ['parent_id' => $parent_id ],
            ['category_path' => $path ]
        );
        return redirect('/category_charge');

    }

    public function category_del($id)
    {
        // dd("Aaa");
        $data1 = DB::table('goods_category')
                    ->where('id',$id)
                    ->orwhere('parent_id','=',$id)
                    // ->get()
                    ->delete();
        return redirect('/category_charge');
    }

}
