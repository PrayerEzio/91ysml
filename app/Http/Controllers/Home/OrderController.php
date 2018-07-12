<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Address;
use App\Http\Models\Order;
use App\Http\Models\Product;
use App\Http\Models\Region;
use App\Http\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends CommonController
{
    private $_cart_name = 'Home.Order';

    public function __construct(Cart $cart)
    {
        parent::__construct();
        $cart::instance($this->_cart_name);
    }

    protected function create_order_sn()
    {
        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    public function checkout(Address $address,Region $region)
    {
        Cart::instance($this->_cart_name)->destroy();
        $cart_list = Cart::instance('Home.Cart')->content()->toArray();
        if (empty($cart_list))
        {
            abort(500,'您还没有选定商品,无法下单哦.');
        }
        Cart::instance($this->_cart_name)->add($cart_list);
        $address_list = $address->where('user_id',$this->getUserId())->get();
        $cart = [
            'cart' => Cart::instance($this->_cart_name)->content(),
            'total' => Cart::instance($this->_cart_name)->total(),
            'count' => Cart::instance($this->_cart_name)->count(),
        ];
        $province_list = $region->where('level',1)->orderBy('sort')->get();
        return view('Home.Order.checkout')->with(compact('address_list','cart','province_list'));
    }

    public function create(Request $request,Order $order,Product $product)
    {
        $address_id = $request->address_id;
        if (empty($request->address_id))
        {
            $address = new Address();
            $address->user_id = $this->getUserId();
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->province_id = $request->province_id;
            $address->city_id = $request->city_id;
            $address->district_id = $request->district_id;
            $address->address = $request->address;
            $address->tag = $request->tag;
            $address->status = 1;
            $address->save();
            $address_id = $address->id;
        }
        $cart_list = Cart::content();
        if (empty($cart_list))
        {
            return abort('500','购物车内没有商品,无法生成订单');
        }
        $order_sn = $this->create_order_sn();
        $user_id = $this->getUserId();
        //订单生成事务
        DB::beginTransaction(); //事务开始
        try {
            $order->order_sn = $order_sn;
            $order->user_id = $user_id;
            $order->address_id = $address_id;
            $order->amount = Cart::total();
            $order->status = 1;
            $order->save();
            foreach ($cart_list as $key => $item)
            {
                $product_info = $product
                    ->where('id',$item->id)
                    ->where('stock','>',$item->qty)
                    ->where('status',1)
                    ->first();
                //减库存
                $product->where('id',$item->id)
                    ->where('stock','>',$item->qty)
                    ->where('status',1)
                    ->decrement('stock',$item->qty);
                $temp_item['product_id'] = $product_info->id;
                $temp_item['goods_name'] = $product_info->goods->name;
                $temp_item['mkt_price'] = $product_info->mkt_price ? $product_info->mkt_price : 0.00;
                $temp_item['price'] = $product_info->price ? $product_info->price : 0.00;
                $temp_item['qty'] = $item->qty;
                $temp_item['goods_pic'] = $product_info->goods->picture;
                $product_list[] = $temp_item;
            }
            $order->products()->createMany($product_list);
            $order->logs()->create([
                'operator' => "用户id-{$user_id}",
                'content' => '创建订单',
                'ip' => $request->getClientIp(),
                'level' => 0,
                'status' => 1,
            ]);
            DB::commit(); //提交事务
        } catch(QueryException $ex) {
            DB::rollback(); //回滚事务
            //异常处理
            return abort(500,'订单生成失败');
        }
        Cart::destroy();
        return redirect()->route('Home.Order.payOrder',['sn'=>$order_sn]);
    }

    public function payOrder(Request $request,Order $order,User $user)
    {
        $order_info = $order->scopeOrderSn($request->sn)->scopeUserId($this->getUserId())->first();
        if (empty($order_info)) return abort(500);
        if ($request->method() == 'POST')
        {
            //TODO:支付
            DB::beginTransaction(); //事务开始
            try {
                switch ($request->pay_type) {
                    case 'perpay':
                        $user->scopeUserId($this->getUserId())
                            ->where('balance','>=',$order_info->amount)
                            ->decrement('balance',$order_info->amount);
                        break;
                    case 'alipay':
                        break;
                    case 'wechat':
                        break;
                    case 'paypal':
                        break;
                }
                $order_info->status = 2;//1未支付 2已支付 3已发货 4已收货 5已完成 -1取消
                $order->save();
                $order->logs()->create([
                    'operator' => "用户id-{$this->getUserId()}",
                    'content' => "支付订单-{$request->pay_type}",
                    'ip' => $request->getClientIp(),
                    'level' => 0,
                    'status' => 1,
                ]);
                DB::commit();//提交事务
            } catch(QueryException $ex) {
                DB::rollback(); //回滚事务
                //异常处理
                return abort(500,'订单支付失败');
            }
        }else {
            return view('Home.Order.payOrder')->with(compact('order_info'));
        }
    }

    public function getList(Order $order)
    {
        $order_list = $order->where('user_id',$this->getUserId())->paginate(10);
        return view('Home.Order.getList')->with(compact('order_list'));
    }

    public function detail($sn,Order $order)
    {
        $order_info = $order->where('user_id',$this->getUserId())
                            ->where('order_sn',$sn)
                            ->first();
        return view('Home.Order.detail')->with(compact('order_info'));
    }

    public function cancelOrder($sn,Order $order)
    {
    }
}
