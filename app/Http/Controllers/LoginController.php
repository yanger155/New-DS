<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function dologin(Request $req)
    {
        // $uname = $_POST['uname'];
        // $pws = $_POST['pwd'];
        $data = $req->all();
        var_dump($data);
        

    }
}
