<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

class MemberController extends Controller
{
    // 会员列表页
    public function member_list()
    {
        $data = DB::table('users')->get();
        // dd($data);
        return view('Admin.member.user_list',['data'=>$data]);
    }

    // 编辑用户
    public function member_list_add($id)
    {
        $data = DB::table('users')
                ->where('id','=',$id)
                ->first();
        // $data = User::where('id',$id)->first();
        // foreach ($data as $key => $item) {
        //     $data1 = $item;
        // }
        // dd($data1);
        // dd($data);            
        return view('Admin.member.user_list_add',['data'=>$data]);
    }

    public function member_list_doadd(Request $req)
    {
        $id = $req->hidden;
        // echo $id;
        $user = User::where('id',$id)
                    ->first();
        if(!$user)
            return back();
        $user->fill($req->all()); 
        $user->save();
        return redirect('member_list');

    }

     // 删除用户
     public function member_list_del($id)
     {
         $data = User::where('id',$id)->delete();
         return redirect('/member_list');
     }

    // 禁用会员
    public function member_stop($id)
    {
        // 更新数据
        User::where('id',$id)
                    ->update(['status'=>'0']);
        // 跳转页面到列表页
        // return redirect()->route('member_list');
        return redirect('/member_list');
    }

     // 禁用会员
    public function member_recover($id)
    {
         // 更新数据
         User::where('id',$id)
                     ->update(['status'=>'1']);
         return redirect('/member_list');
    }

    //  等级管理页
    public function member_charge()
    {
        return view('Admin.member.member-Grading');
    }

    // 会员管理记录页
    public function member_record()
    {
        return view('Admin.member.integration');
    }
}
