<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use DB;

class BrandsController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('goods_brand')->get();
        // dd($data);
        return view('Admin.goods.Brand_Manage',['data'=>$data]);
    }



    public function create()
    {
        return view('Admin.goods.Add_Brand');

    }



    public function show()
    {
        $data = DB::table('goods_brand')->get();
        // dd($data);
        return view('Admin.goods.Brand_Manage',['data'=>$data]);
    }

    


    public function store(Request $req)
    {
        // dd($req->all());
        $brand = new Brands;

        // $brand->fill($req->all());
        $brand->brand_name = $req->brand_name;
        $brand->describe = $req->describe;
        $brand->status = $req->status;
        // 
        if($req->has('logo') && $req->logo->isValid())
        {
            $date = date('Y-m-d');
            $logo = $req->logo->store('brands/'.$date);
            // dd($logo);
            $brand->logo = '/uploads/'.$logo;
        }

        $brand->save();
        return redirect('/brand_charge');
    }




    public function edit($id)
    {
        $data = DB::table('goods_brand')->where('id','=',$id)->first();
        // dd($data);
        return view('Admin.goods.Edit_Brand',['data'=>$data]);
    }





    public function update(Request $req ,$id)
    {
        // 更新操作
        // $brand->brand_name = $req->brand_name;
        // $brand->describe = $req->describe;
        // $brand->status = $req->status;
        $brand = brands::find($id);
        // dd($brand);

        if(!$brand)
            return back();
       
        if($req->has('logo')&&$req->logo->isValid())
        {
            //先把原先的图片删除，然后保存本地
            @unlink(base_path('public'.$brand->logo));
            $date = date('Y-m-d');
            $logo = $req->logo->store('brands/'.$date);
            // dd($logo);
        }
        $brand->brand_name = $req->brand_name;
        $brand->describe = $req->describe;
        $brand->status = $req->status;
        $brand->logo = "/uploads/".$logo;
        $brand->save();
        return redirect('/brand_charge');

        $brand->save();
    }





    public function brand_del($id)
    {
        // dd('??');
        // 删除操作
        //根据id去数据库里查找logo数据
        $logo = DB::table('goods_brand')->where('id','=',$id)->pluck('logo')->first();
        // dd($logo);
        // 拼接地址删除本地图片
        @unlink(base_path('public'.$logo));
        Brands::where('id',$id)->delete();
        return redirect('/brand_charge');
    }



    // 品牌查询
    public function brand_search(Request $req)
    {
        // 得到表单项
        // 去数据库里查询符合项
        // 渲染视图
        dd($req->all());
        $where = "select * from goods_user where";
        $value = [];

        if($req->has('keyword'))
        {
            $where .= "brand_name like ? or describe like ?";
            $value[] = '%'.$req->keyword.'%'; 
        }

        // if($req->has('created_at'))
        // {
        //     // $where .= "and created_at <= "
        // }

        if($req->has('status'))
        {
            $where .= "";

        }




        $users = DB::select('select * from users where active = ?', [1]);
        return view('user.index', ['users' => $users]);

    }
    // public function brand_stop()
    // {
    //     // 停用品牌
    //     DB::table('goods_brand')
    //         ->where('id', $id)
    //         ->update(['status' => '失效']);

    // }
}
