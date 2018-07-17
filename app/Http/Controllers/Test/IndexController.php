<?php

namespace App\Http\Controllers\Test;
use App\Http\Models\Admin;
use App\Http\Models\AdminPermission;
use App\Http\Models\AdminRole;
use App\Http\Models\ArticleCate;
use App\Http\Repository\AdminRepository;
use Carbon\Carbon;
use Crypt;
use Redis;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{

    public function __construct(AdminRepository $adminRepository)
    {
        parent::__construct();
    }

    public function index()
    {
        return view('Test.Index.index');
    }

    public function attachPermissions(AdminRole $adminRole,AdminPermission $adminPermission)
    {
        $adminRole = $adminRole->where([['name','=','administrator']])->first();
        $post_permissions = $adminPermission->where([['name','like','%-post']])->select();
        $res = $adminRole->attachPermissions($post_permissions);
        dd($res);
    }

    public function addPermission()
    {
        $createPost = new AdminPermission();
        $createPost->name = '*';
        $createPost->guard_name = '后台';
        $createPost->display_name = '后台所有权限';
        $createPost->description = 'all permission';
        $res = $createPost->save();
        dd($res);
    }

    public function attachRole()
    {
        $adminModel = new Admin();
        $admin = $adminModel->where('id','=',1)->first();
        $res = $admin->attachRole(1);
        dd($res);
    }

    public function addRole()
    {
        $role = new AdminRole();
        $role->name = 'administrator';
        $role->guard_name = '后台';
        $role->display_name = 'administrator';
        $role->description = 'the website\'s administrator who has all and the highest permission.';
        $res = $role->save();
        dd($res);
    }

    public function getArticleModel()
    {
        $data = ArticleCate::find(6);
        dump($data->article->toArray());
    }

    public function qiniu()
    {
        $AccessKey = env('QINIU_ACCESS_KEY');
        $SecretKey = env('QINIU_SECRET_KEY');
        $auth = new Auth($AccessKey,$SecretKey);
        $bucketManager = new BucketManager($auth);
        $url = 'http://p0.ifengimg.com/pmop/2017/0703/75EC1D4EF912AD8C5B58627159C430AE160C84C9_size76_w608_h608.jpeg';
        $pathinfo = pathinfo($url);
        $key = 'demo/'.time().'.'.$pathinfo['extension'];
        $res = $bucketManager->fetch($url,'crucis-cn',$key);
    }

    //
    public function setRedis()
    {
        $user = [
            'id' => 7,
            'name' => 'Ezio',
            'gender' => 1,
            'country' => '中国',
            'province' => '广东',
            'city' => '深圳',
            'age' => '24',
        ];
        $res = Redis::set('user:id:'.$user['id'], Crypt::encrypt(serialize($user)));
        dump($res);
    }

    public function getRedis($id)
    {
        $redis_key = 'user:id:'.$id;
        if (!Redis::exists($redis_key))
        {
            abort(500,'Sorry,this redis don\'t exist.');
        }
        $user_crypt = Redis::get($redis_key);
        $user = unserialize(Crypt::decrypt($user_crypt));
        dump($user);
    }

    public function getAdminModel($id = 0)
    {
        if ($id)
        {
            $admin_info = Admin::find($id);
            dump($admin_info);
        }else {
            $admin_list = Admin::all();
            dump($admin_list);
        }
    }

    public function createRoleAndPermission(Role $role,Permission $permission)
    {
        $result_of_create_role = $role->create(['name'=>'super administrator','display_name'=>'超级管理员']);
        dump($result_of_create_role);
        /*$result_of_create_permission = $permission->create(['name'=>'*','display_name'=>'所有权限']);
        dump($result_of_create_permission);*/
    }

    public function adminAssignRole(Admin $admin)
    {
        $id = 1;
        $admin_info = $admin->find($id);
        $result_of_admin_assign_role = $admin_info->assignRole(['super administrator']);
        dump($admin_info);
        dump($result_of_admin_assign_role);
    }

    public function givePermissionToRole(Role $role)
    {
        $role = $role->where(['name'=>'super administrator'])->first();
        $result_of_give_permission_to_role = $role->givePermissionTo(['*']);
        dump($role);
        dump($result_of_give_permission_to_role);
    }

    public function roleHasPermission(Role $role)
    {
        $role = $role->where(['name'=>'guest'])->first();
        $result_of_role_has_permission_to_edit_articles = $role->hasPermissionTo('edit articles');
        $result_of_role_has_permission_to_read_articles = $role->hasPermissionTo('read articles');
        dump($result_of_role_has_permission_to_edit_articles);
        dump($result_of_role_has_permission_to_read_articles);
    }

    public function adminHasPermission(Admin $admin)
    {
        $admin = $admin->find(2);
        $result_of_admin_has_permission_to_edit_articles_ = $admin->hasPermissionTo('edit articles');
        $result_of_admin_has_permission_to_read_articles = $admin->hasPermissionTo('read articles');
        dump($result_of_admin_has_permission_to_edit_articles_);
        dump($result_of_admin_has_permission_to_read_articles);
    }

    public function test()
    {
        $when = Carbon::now()->addMinute(1);
        $admin = Admin::find(1);
        SendReminderEmail::dispatch($admin)->onQueue('emails')->delay($when);
    }
}
