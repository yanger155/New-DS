<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Hash;


class LoginController extends Controller
{
    //
    public function login()
    {
        return view('admin.login.login');

    }

    public function dologin(Request $req)
    {
        $admin = Admin::where('name',$req->uname)->first();
        if($admin)
        {
            if(Hash::check($req->password,$admin->password))
            {
                session([
                    'id' => $admin->id,
                    'name' => $admin->name,
                ]);
                return redirect('/admin');
            }
            return back()->withInput()->withErrors('密码不正确');
        }
        else
        {
            return back()->withInput()->withErrors('用户名不存在');
        }
    }
}
