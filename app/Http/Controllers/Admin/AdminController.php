<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin_role;
use App\Models\Admin;
use App\Models\Privilege;
use App\Models\Role_Privilege;
use DB;


class AdminController extends Controller
{
    // 基本页面视图连接
    // 个人信息
    public function info()
    {
        return view('Admin.admin.admin_info');
    }
  
    // 管理员列表页
    public function list()
    {
        $data = DB::table('admins')
                    ->select('admins.id','roles.role_name','admins.name','privileges.privilege_name as pri_name')
                    ->leftJoin('admin_role','admins.id','=','admin_role.admins_id')
                    ->leftJoin('roles','admin_role.roles_id','=','roles.id')
                    ->leftJoin('role_privilege','roles.id','=','role_privilege.roles_id')
                    ->leftJoin('privileges','role_privilege.roles_id','=','privileges.id')
                    // ->groupBy('admins.id')
                    ->get();
        // dd($data);
        return view('Admin.admin.admin_list',['data'=>$data]);
    }

    // 权限视图
    public function privilege()
    {
        // 连表查询
        // $data = DB::select('select a.id,r.role_name,a.name,GROUP_CONCAT(p.privilege_name) pri_name from newds_admins a 
        //         left join newds_admin_role ad on a.id = ad.admins_id 
        //         left join newds_roles r on ad.roles_id = r.id
        //         left join newds_role_privilege rp on r.id = rp.roles_id
        //         left join newds_privileges p on rp.roles_id = p.id
        //         group by a.id');
        // $data = DB::table('admins')
        //             ->select('admins.id,roles.role_name,admins.name,privilege.privilege_name')
        //             ->leftJoin('admin_role','admins.id','=','admin_role.admin_id')
        //             ->leftJoin('roles','admin_role.roles_id','=','roles.id')
        //             ->leftJoin(' role_pribvilege','roles.id','=','role_pribvilege.roles_id')
        //             ->leftJoin('privilege','role_pribvilege.roles_id','=','privilege.id')
        //             ->groupBy('admins.id')
        //             ->get();-
        $data = DB::table('privileges')->get();
        // dd($data);
        return view('Admin.admin.admin_privilege',['data'=>$data]);
    }

    public function pri_add()
    {
        $data = DB::table('roles')->get();
        // dd($data);
        return view('Admin.admin.privilege_add',['data'=>$data]);
    }
    
    public function pri_doadd(Request $req)
    {
        // 处理添加权限的表单
        // 1. 添加权限表，返回id
        // dd($req->all());

        // 插入数据的第一种方法
        // $privilege = new Privilege;
        // $privilege->privilege_name = $req->privilege_name;
        // $privilege->privilege_path = $req->privilege_path;
        // $privilege->save();

        // 插入数据的第二种方法
        $privilege = DB::insert('insert into newds_privileges (privilege_name, privilege_path) values (?, ?)', [$req->privilege_name, $req->privilege_path]);
        $id = DB::getPdo()->lastInsertId();
        // echo $id;

        // // 插入数据的第三种方法
        // $privilege = Privilege::create(['privilege_name'=>$req->privilege_name,'privilege_path'=>$req->privilege_path]);
        // // 返回新插入的id
        // dd($privilege['id']);



        // 2. 接收返回id 表单提交了role的id 然后添加中间表 
        $role_privilege = DB::insert('insert into newds_role_privilege (roles_id,privileges_id) values (?,?)',[$req->role_name,$id]);
        // dd($role_privilege);   -->true
    
    }
    
    public function pri_delete($id)
    {
        $pri = Privilege::find($id);
        $pri->delete();
        return redirect()->route('privilege');
    }

    // 角色视图
    public function role()
    {
        $data = DB::table('roles')->get();
        // dd($data);
        return view('Admin.admin.admin_role',['data'=>$data]);
    }

    // 用户视图
    public function admin()
    {
        $data = DB::table('admins')->get();
        // dd($data);
        return view('Admin.admin.admin_admin',['data'=>$data]);
    }

    


}
