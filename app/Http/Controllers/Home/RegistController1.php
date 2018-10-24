<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests\RegistRequest;
use App\Models\User;
use Hash;
// 引入发短信的扩展
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
// 引入Cache类
use Illuminate\Support\Facades\Cache;

class RegistController extends Controller
{
    public function regist()
    {
        return view('regist.regist');
    }

    public function doregist(RegistRequest $req)
    {

        
        // dd($req->all());
        // 在登录之前先比对验证码

        // 拼出缓存的名字
        $name = 'code_'.$req->phone;
        $code = Cache::get($name);
        // 如果验证码不存在或者验证码不等于表单中提交的验证码
        if(!$code || $code != $req->code)
        {
            // 返回上一个页面并把错误信息保存到SESSION中
            return back()->withErrors(['code'=>'验证码错误']);
        }
        
        // 密码加密
        $password = Hash::make($req->password);
        $user = new User;
        // 把表单中的手机号设置到模型
        $user->name = $req->uname;

        $user->phone = $req->phone;
        // 把加密的密码设置到模型
        $user->password = $password;
        // 保存到表中
        $user->save();
        // 注册完毕跳转到登录页
        return redirect()->route('login');
    }

    public function sendcode(Request $req)
    {
        $code = rand(100000,999999);
        $name = 'code_'.$req->phone;
        // Cache::put(‘名称’,’值’,缓存时间);   // 单位：分钟
        Cache::put($name,$code,1440);

        $config = [
            'accessKeyId'    => 'LTAIYb4cCmhmZE7i',
            'accessKeySecret' => 'yW3ojkUMzlvUFWtUsc8hMUBiOnVX4j',
        ];
        
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($req->phone);
        $sendSms->setSignName('sns项目');
        $sendSms->setTemplateCode('SMS_136000172');
        $sendSms->setTemplateParam(['code' => $code]);
        $sendSms->setOutId('demo');
        
        print_r($client->execute($sendSms));

    }
}
