<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;


class LoginController extends Controller
{
    public function login()
    {
        return view('home.login.login');
    }

    public function dologin(LoginRequest $req)
    {
        // 显示登录的表单
        // 用户输入账号、密码
        // 根据账号查询数据库，取出账号信息
        // 判断输入的密码是否和数据库中密码相同
        // 如果账号和密码相同就认为登录成功，这时我们会把用户的ID、头像、用户名等常用的信息保存到SESSION中
        // $data = $req->all();
        // var_dump($data);

        // 查询多条记录
        // $user = DB::table('users')->get();
        // dd($user);

        // 获取一条数据
        // $user = DB::table('users')->first();
        // dd($user);

        $user = User::where('name',$req->uname)->first();
        if($user)
        {
            if(Hash::check($req->password,$user->password))
            {
                session([
                    'id' => $user->id,
                    'username' => $user->username,
                ]);
                // 跳转到一个命名的路由
                return redirect('/home');
            }
            // 返回至上一个页面把提交的数据返回并把错误信息保存到SESSION中
            return back()->withInput()->withErrors('密码不正确');
        }
        else
        {
            return back()->withInput()->withErrors('用户名不存在');
        }
    }
}
