<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Order;
use Illuminate\Http\Request;

class OrderController extends CommonController
{
    public function orderList(Order $order,Request $request)
    {
        $where = [];
        $input = $request->all();
        if (!empty($input['sn'])) $where[] = ['order_sn','like',"%{$input['sn']}%"];
        if (!empty($input['status'])) $where[] = ['status','=',$input['status']];
        if (!empty($input['start'])) $where[] = ['created_at','>',$input['start'].' 00:00:00'];
        if (!empty($input['end'])) $where[] = ['created_at','<=',$input['end'].' 23:59:59'];
        $list = $order->where($where)->orderBy('created_at','desc')->paginate(10);
        return view('Admin.Order.order_list')->with(compact('list','input'));
    }

    public function detail($sn,Order $order)
    {
        $data = $order->orderSn($sn)->first();
        return view('Admin.Order.detail')->with(compact('data'));
    }

    public function cancelOrder($sn,Order $order)
    {

    }
}
