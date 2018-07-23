<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Service\AdminService;
use App\Http\Service\QiniuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends CommonController
{
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function admin_list(Admin $admin)
    {
        $admin_list = $admin->paginate(12);
        return view('Admin.Auth.admin_list')->with(compact('admin_list'));
    }

    public function permission_list(Permission $permission)
    {
        $permission_list = $permission->get();
        return view('Admin.Auth.permission_list')->with(compact('permission_list'));
    }

    public function role_list(Role $role)
    {
        $role_list = $role->paginate(12);
        /*foreach ($role_list as $key => $role)
        {
            $adminRoleUser = new AdminRoleUser();
            $role_admin_id_list = $adminRoleUser->where('admin_role_id','=',$role['id'])->pluck('admin_id');
            $admin = new Admin();
            $role_admin_list = $admin->select('id','nickname','avatar')->whereIn('id',$role_admin_id_list)->limit(5)->get();
            $role_list[$key]['role_admin_list'] = $role_admin_list;
        }*/
        return view('Admin.Auth.role_list')->with(compact('role_list'));
    }

    public function admin_show($id,Admin $admin)
    {
        $admin_info = $admin->findOrFail($id);
        return view('Admin.Auth.admin_show')->with(compact('admin_info'));
    }

    public function admin_avatar_upload()
    {
        $result = ['code'=>0,'msg'=>'success','data'=>['src'=>'http://www.baidu.com']];
        $result = json_encode($result);
        return $result;
    }

    public function admin_store($id,Request $request,QiniuService $qiniuService,AdminService $adminService)
    {
        $adminService->edit($id,$request,$qiniuService);
        return redirect()->action('Admin\AuthController@admin_show',['id'=>$id]);
    }

    public function permission_create(Request $request,AdminPermission $adminPermission)
    {

    }
}