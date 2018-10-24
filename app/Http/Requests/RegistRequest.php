<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agree' =>'accepted', // 注册协议必须勾选
            'uname'=>'required',
            'phone'=>[
                'required',
                'regex:/^[1][3,4,5,7,8][0-9]{9}$/',  //手机号
                'unique:users,phone', //向users表中的Phone字段中找是否有这个手机号已经存在，如果哦存在，就报错 
            ],
            'password'=>'required|min:6|max:18|confirmed'  //confirmed:password 和passeord_confirmation是否相同

        ];
    }
    // 错误的信息
    // public function messages()
    // {
    //     return [
    //         'protocol.accepted'=>'协议必须勾选！',
    //         'name.required'=>'用户名不能为空',
    //         'phone.required'=>'手机不能为空',
    //         'phone.regex'=>'手机号码不符合要求',
    //         'phone.unique'=>'手机号已存在',
    //         'password.required'=>'密码不能为空',
    //         'password.min'=>'密码不少于6位',
    //         'password'=>'密码不多于18位',
    //         'password.confirmed'=>'密码和重复密码不一致'
    //     ];
    // }
}
