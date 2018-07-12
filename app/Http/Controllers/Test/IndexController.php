<?php

namespace App\Http\Controllers\Test;

use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use App\Http\Models\Order;
use App\Http\Models\Product;
use App\Http\Models\ProductAttribute;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Torann\GeoIP\Facades\GeoIP;
use Faker\Generator as Faker;

class IndexController extends Controller
{
    public function index()
    {
        phpinfo();
    }

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

    public function addPermission()
    {
        $create_article = new Permission();
        $create_article->name = 'create_article';
        $create_article->display_name = '创建文章';
        $create_article->description = 'test';
        $res = $create_article->save();
        dd($res);
    }

    public function geoIp(Request $request)
    {
        dump($request->getClientIp());
        $location = GeoIP::getLocation($request->getClientIp());
        dump($location);
    }

    public function getGoods($id)
    {
        $goods = new Goods();
        $data = $goods->findOrfail($id);
        $attribute_list = [];
        foreach ($data->products as $product)
        {
            $product_attribute = [];
            foreach ($product->attributes as $attribute)
            {
                if(!isset($attribute_list[$attribute->category->name])) $attribute_list[$attribute->category->name]= [];
                in_array($attribute->value,$attribute_list[$attribute->category->name]) ? '' : $attribute_list[$attribute->category->name][] = $attribute->value;
                $product_attribute[] = $attribute->value;
            }
            if (!empty($product_attribute)) $product->attribute = join('|',$product_attribute);
        }
        $data['attribute_list'] = $attribute_list;
        $data['products'] = $data->products;
        return view('Test.Index.getGoods')->with(compact('data'));
    }

    public function getProduct($id)
    {
        $product = new Product();
        $data = $product->find($id);
        dump($data);
        dump($data->goods->category);
    }

    public function seed(Faker $faker)
    {
        $products = Product::get();
        $name_key = 1;
        foreach ($products as $product)
        {
            for ($i=1;$i<=2;$i++)
            {
                $model = new ProductAttribute();
                $model->product_id = $product->id;
                $i === 1 ? $model->attribute_id = rand(1,10) : $model->attribute_id = rand(11,16);
                $model->save();
                $name_key++;
            }
        }
    }

    public function getOrder($order_sn,Order $order)
    {
        $order_info = $order->where('order_sn','=',$order_sn)->first();
        dump($order_info->products);
        dump($order_info->user);
    }

    public function cart()
    {

    }
}
