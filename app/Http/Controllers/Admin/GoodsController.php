<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\AttributeCategory;
use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use Illuminate\Http\Request;

class GoodsController extends CommonController
{
    public function goodsList(Goods $goods)
    {
        $goods_list = $goods->all();
        return view('Admin.Goods.goods_list')->with(compact('goods_list'));
    }

    public function add(Request $request,GoodsCategory $goodsCategory)
    {
        if (strtolower($request->method()) == 'post')
        {
           //TODO:
            $res = Goods::create();
            dd($res);
        }else {
            $goods_category_list = $goodsCategory->get();
            return view('Admin.Goods.add')->with(compact('goods_category_list'));
        }
    }

    public function edit(Request $request,GoodsCategory $goodsCategory,Goods $goods)
    {
        if (strtolower($request->method()) == 'post')
        {
            //TODO:
            $res = Goods::update();
            dd($res);
        }else {
            $goods_category_list = $goodsCategory->get();
            $id = $request->id;
            $goods_info = $goods->findOrFail($id);
            return view('Admin.Goods.add')->with(compact('goods_category_list','goods_info'));
        }
    }

    public function delete(Request $request,Goods $goods)
    {
        if ($request->method() == 'DELETE')
        {
            $res = $goods->destroy($request->id);
            if ($res)
            {
                return response([
                    'status'  => 200,
                    'message' => __('Operation succeed.'),
                    'data' => $res
                ]);
            }else {
                return response([
                    'status'  => 500,
                    'message' => __('Operation fail.'),
                    'data' => $res
                ]);
            }
        }
    }
}
