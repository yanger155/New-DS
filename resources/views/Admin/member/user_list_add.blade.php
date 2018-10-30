<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/member_list_doadd" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tbody>
                <tr>
                    <th>用户名</th>
                    <td>
                        <input class="common-text required" id="title" name="name" size="50" value="{{$data->name}}" type="text">
                    </td>
                </tr>
                <tr>
                    <th>电话号码</th>
                    <td><input class="common-text" name="phone" size="50" value="{{$data->phone}}" type="text"></td>
                </tr>
                <tr>
                    <th>加入时间</th>
                    <!-- 时间插件 -->
                    <td><input name="created_at" id="" type="text" value="{{$data->created_at}}"></td>
                </tr>
                <tr>
                    <th>性别</th>
                    <td>
                        <input name="sex" type="radio" value="男" @if($data->sex=='男') checked @endif>男
                        <input name="sex" type="radio" value="女" @if($data->sex=='女') checked @endif>女
                        <input name="sex" type="radio" value="暂无信息" @if($data->sex=='暂无信息') checked @endif)>暂无信息
                    </td>
                </tr>
                <tr>
                    <th>地址</th>
                    <!-- 地址三级联动 -->
                    <td><input name="address" id="" type="text" value="{{$data->address}}"></td>
                </tr>
                <tr>
                    <th width="120"></i>等级</th>
                    <td>
                        <select name="grade" id="catid" class="required">
                            <option value="">请选择</option>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>会员积分</th>
                    <td><input name="score" id="" type="text" value="{{$data->score}}"></td>
                </tr>
                <!-- <tr>
                    <th>状态</th>
                    <td>
                        <input name="status" id="" type="radio" value="0" @if($data->status=='0') checked @endif>禁用
                        <input name="status" id="" type="radio" value="1" @if($data->status=='1') checked @endif>正常
                    </td>
                </tr> -->
                <tr>
                    <th></th>
                    <td>
                        <input type="hidden" value="{{$data->id}}" name="hidden">
                        <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                        <input class="btn btn6" onClick="history.go(-1)" value="返回" type="button">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>