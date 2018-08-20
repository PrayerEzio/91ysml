<?php

namespace App\Http\Controllers\Test;

use App\Http\Models\Admin;
use App\Http\Models\AdminPermission;
use App\Http\Models\AdminRole;
use App\Http\Models\Article;
use App\Http\Models\ArticleCategory;
use App\Http\Repositories\AdminRepository;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Facades\DB;
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
        phpinfo();//View-Request-Controller-{Service}-Repository-Model-Database
    }

    public function attachPermissions(AdminRole $adminRole, AdminPermission $adminPermission)
    {
        $adminRole = $adminRole->where([['name', '=', 'administrator']])->first();
        $post_permissions = $adminPermission->where([['name', 'like', '%-post']])->select();
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
        $admin = $adminModel->where('id', '=', 1)->first();
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
        $data = ArticleCategory::find(6);
        dump($data->article->toArray());
    }

    public function qiniu()
    {
        $AccessKey = env('QINIU_ACCESS_KEY');
        $SecretKey = env('QINIU_SECRET_KEY');
        $auth = new Auth($AccessKey, $SecretKey);
        $bucketManager = new BucketManager($auth);
        $url = 'http://p0.ifengimg.com/pmop/2017/0703/75EC1D4EF912AD8C5B58627159C430AE160C84C9_size76_w608_h608.jpeg';
        $pathinfo = pathinfo($url);
        $key = 'demo/' . time() . '.' . $pathinfo['extension'];
        $res = $bucketManager->fetch($url, 'crucis-cn', $key);
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
        $res = Redis::set('user:id:' . $user['id'], Crypt::encrypt(serialize($user)));
        dump($res);
    }

    public function getRedis($id)
    {
        $redis_key = 'user:id:' . $id;
        if (!Redis::exists($redis_key)) {
            abort(500, 'Sorry,this redis don\'t exist.');
        }
        $user_crypt = Redis::get($redis_key);
        $user = unserialize(Crypt::decrypt($user_crypt));
        dump($user);
    }

    public function getAdminModel($id = 0)
    {
        if ($id) {
            $admin_info = Admin::find($id);
            dump($admin_info);
        } else {
            $admin_list = Admin::all();
            dump($admin_list);
        }
    }

    public function createRoleAndPermission(Role $role, Permission $permission)
    {
        $result_of_create_role = $role->create(['name' => 'super administrator', 'display_name' => '超级管理员']);
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
        $role = $role->where(['name' => 'super administrator'])->first();
        $result_of_give_permission_to_role = $role->givePermissionTo(['*']);
        dump($role);
        dump($result_of_give_permission_to_role);
    }

    public function roleHasPermission(Role $role)
    {
        $role = $role->where(['name' => 'guest'])->first();
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
        header("Content-type: text/html; charset=gb2312");
        $index = file_get_contents("http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2017/index.html");
        preg_match_all('/<a href=\'(\d{2,4}).html\'>(.{3,20})<br\/><\/a>/', $index, $matches);
        echo '<pre>';
        $url = 'http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2017/';
        error_reporting(0);
        $prov = array(
            array(),
            //array(11,12,13,14,15,21,22,23,31,32,33,34,35,36,37,41,42,43,44,45,46,50,51,52,53,54,61,62,63,64,65),
            /*array('北京市','天津市','河北省','山西省','内蒙古自治区','辽宁省','吉林省','黑龙江省',
                '上海市','江苏省','浙江省','安徽省','福建省','江西省','山东省','河南省',
                '湖北省','湖南省','广东省','广西壮族自治区','海南省','重庆市','四川省','贵州省',
                '云南省','西藏自治区','陕西省','甘肃省','青海省','宁夏回族自治区','新疆维吾尔自治区'
            )*/
            [44], ['广东省']
        );

        $matches = $prov;

        for ($i = 0, $e = count($matches[1]); $i < $e; $i++) {
            $index = file_get_contents($url . $matches[1][$i] . '.html');
            preg_match_all('/<a href=\'\d{2}\/(.{1,30}).html\'>(.{1,30})<\/a><\/td><\/tr>/', $index, $matche);

            for ($a = 0, $b = count($matche[1]); $a < $b; $a++) {
                $index = file_get_contents($url . $matches[1][$i] . '/' . $matche[1][$a] . '.html');
                preg_match_all('/<a href=\'\d{2}\/(.{1,30}).html\'>(.{1,30})<\/a><\/td><\/tr>/', $index, $match);
                for ($c = 0, $d = count($match[1]); $c < $d; $c++) {
                    $aru = substr($matche[1][$a], 2, 2);
                    $index = file_get_contents($url . $matches[1][$i] . '/' . $aru . '/' . $match[1][$c] . '.html');
                    preg_match_all('/<a href=\'\d{2}\/(.{1,30}).html\'>(.{1,30})<\/a><\/td><\/tr>/', $index, $matc);

                    //部分省市的html和大部分的不一样，重写规则
                    if (!$matc[0]) preg_match_all('/<td>(.{1,30})<\/td><td>\d{1,10}<\/td><td>(.{1,30})<\/td><\/tr>/', $index, $matc);

                    $sql = 'REPLACE INTO position (province_id,province_name,city_id,city_name,county_id,county_name,town_id,town_name) VALUES ';
                    for ($v = 0, $n = count($matc[1]); $v < $n; $v++) {
                        $jil = iconv("utf-8", "gbk//ignore", $matches[2][$i]);
                        $sql .= "({$matches[1][$i]},'{$jil}',{$matche[1][$a]},'{$matche[2][$a]}',{$match[1][$c]},'{$match[2][$c]}',{$matc[1][$v]},'{$matc[2][$v]}'),";
                    }
                    echo $sql . '</br> ';
                }
            }
        }

        die;
        $when = Carbon::now()->addMinute(1);
        $admin = Admin::find(1);
        SendReminderEmail::dispatch($admin)->onQueue('emails')->delay($when);
    }
}
