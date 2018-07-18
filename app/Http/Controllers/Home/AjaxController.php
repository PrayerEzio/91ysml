<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Address;
use App\Http\Models\ArticleCate;
use App\Http\Models\Order;
use App\Http\Models\Region;
use Illuminate\Http\Request;

class AjaxController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRegionsList(Request $request,Region $region)
    {
        $parent_id = intval($request->parent_id);
        $regions_list = $region->where(['parent_id'=>$parent_id,'status'=>1])->orderBy('sort')->get();
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed.'),
                'data' => $regions_list,
            ]);
        }
    }

    public function saveAddress(Request $request,Address $address)
    {
        $address->user_id = $this->getUserId();
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->province_id = $request->province;
        $address->city_id = $request->city;
        $address->district_id = $request->district;
        $address->address = $request->address;
        $address->tag = $request->tag;
        $address->save();
        $address->province_name = $this->getRegionsName($address->province_id);
        $address->city_name = $this->getRegionsName($address->city_id);
        $address->district_name = $this->getRegionsName($address->district_id);
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed.'),
                'data' => $address,
            ]);
        }
    }

    public function getOrderDetail(Request $request,Order $order)
    {
        $order_info = $order->orderSn($request->sn)->userId($this->getUserId())->first();
        $data = $order_info;
        $data['products'] = $order_info->products;
        $data['user'] = $order_info->user;
        $data['logs'] = $order_info->logs;
        $data['address'] = $order_info->address;
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed.'),
                'data' => $data,
            ]);
        }
    }

    public function getArticleCategoryList(Request $request,ArticleCate $articleCate)
    {
        $data = $articleCate->where('status','=',1)->orderBy('sort')->get();
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed.'),
                'data' => $data,
            ]);
        }
    }
}
