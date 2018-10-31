<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
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

    public function store(Request $req)
    {

        // echo "<pre>";
        // var_dump($req->all());
        dd($req->all());
        // dd($req->logo);
        

    }

    public function edit($id)
    {
        return view('Admin.goods.Edit_Brand');

    }

    public function update($id)
    {
        // 更新操作

    }

    public function destroy($id)
    {
        // 删除操作

    }

    public function show($id)
    {
        // 品牌详情页
        return view('Admin.goods.Brand_detailed');

    }

    public function brand_stop()
    {
        // 停用品牌


    }
}
