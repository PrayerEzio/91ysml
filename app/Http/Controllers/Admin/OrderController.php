<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Order;
use Illuminate\Http\Request;

class OrderController extends CommonController
{
    public function orderList(Order $order)
    {
        $list = $order->orderBy('created_at','desc')->paginate(10);
        return view('Admin.Order.order_list')->with(compact('list'));
    }

    public function show($id,Order $order)
    {
        $data = $order->findOrFail($id);
        return view('Admin.Order.show')->with(compact('data'));
    }

}
