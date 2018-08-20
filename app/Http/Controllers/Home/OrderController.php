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
                $temp_item['picture'] = $product_info->goods->picture;
                $product_list[] = $temp_item;
            }
            $order->products()->createMany($product_list);
            $order->logs()->create([
                'title' => '创建订单',
                'operator' => "用户id-{$user_id}",
                'content' => '创建订单成功',
                'ip' => $request->getClientIp(),
                'level' => 0,
                'status' => 1,
            ]);
            Cart::destroy();
            DB::commit(); //提交事务
        } catch(QueryException $ex) {
            DB::rollback(); //回滚事务
            //异常处理
            return abort(500,'订单生成失败');
        }
        return redirect()->route('Home.Order.payOrder',['sn'=>$order_sn]);
    }

    public function payOrder($sn,Request $request,Order $order,User $user)
    {
        $order_info = $order->orderSn($sn)->userId($this->getUserId())->status(1)->first();
        if (empty($order_info)) return abort(500);
        if ($request->method() == 'POST')
        {
            DB::beginTransaction(); //事务开始
            try {
                switch ($request->payment_method) {
                    case 'perpay':
                        $user->userId($this->getUserId())
                            ->where('balance','>=',$order_info->amount)
                            ->decrement('balance',$order_info->amount);
                        $order_info->status = 2;//1未支付 2已支付 3已发货 4已收货 5已完成 -1取消
                        break;
                    case 'alipay':
                        break;
                    case 'wechat':
                        break;
                    case 'paypal':
                        break;
                    default:
                        return redirect()->back()->withInput()->with('alert',['error','支付失败']);
                        break;
                }
                $order_info->save();
                $order_info->logs()->create([
                    'title' => "支付订单",
                    'operator' => "用户id-{$this->getUserId()}",
                    'content' => "支付订单-{$request->payment_method}",
                    'ip' => $request->getClientIp(),
                    'level' => 0,
                    'status' => 1,
                ]);
                DB::commit();//提交事务
                return redirect('/Home/Order/getList')->with('alert',['success','操作成功']);
            } catch(QueryException $ex) {
                DB::rollback(); //回滚事务
                //异常处理
                dd($ex);
                return redirect()->back()->withInput()->with('alert',['error','支付失败']);
            }
        }else {
            return view('Home.Order.detail')->with(compact('order_info'));
        }
    }

    public function getList(Order $order)
    {
        $order_list = $order->userId($this->getUserId())->paginate(10);
        return view('Home.Order.getList')->with(compact('order_list'));
    }

    public function detail($sn,Order $order)
    {
        $order_info = $order->userId($this->getUserId())
                            ->orderSn($sn)
                            ->first();
        return view('Home.Order.detail')->with(compact('order_info'));
    }

    public function cancelOrder($sn,Order $order)
    {
        $order_info = $order->orderSn($sn)->userId($this->getUserId())->whereIn('status',[1,2])->first();
        if (mpty($order_info)) {
            return response([
                'status'  => 404,
                'message' => __('Operation fail.'),
            ]);
        }
        DB::beginTransaction(); //事务开始
        try{
            //1.改变订单状态
            $order_info->status = -1;
            //2.回滚库存
            foreach ($order_info->products as $order_product)
            {
                $product_model = new Product();
                $product_model->where('id',$order_product->product_id)->increment('stock',$order_product->qty);
            }
            //3.进行退款操作 判断是否已经付款
            switch ($order->status)
            {
                case 2:
                    $user_model = new User();
                    $user_model->userId('id',$order->user_id)->increment('amount',$order->amount);
                    break;
            }
            DB::commit();//提交事务
        } catch(QueryException $ex) {
            DB::rollback(); //回滚事务
            //异常处理
            return response([
                'status'  => 500,
                'message' => __('Operation fail.'),
            ]);
        }
    }
}
