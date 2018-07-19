<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use Illuminate\Http\Request;

class GoodsController extends CommonController
{
    public function goodsCategoryList(GoodsCategory $goodsCategory)
    {
        $list = $goodsCategory->all();
        return view('Admin.Goods.goods_category_list')->with(compact('list'));
    }

    public function addCategory(Request $request,GoodsCategory $goodsCategory)
    {
        if (strtolower($request->method()) == 'post')
        {
            $goodsCategory->name = $request->name;
            $res = $goodsCategory->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
                return redirect('/Admin/Goods/goodsCategoryList')->with('alert',$alert);
            }else {
                return redirect()->back()->withInput()->withErrors('保存失败！');
            }
        }else {
            return view('Admin.Goods.add_category');
        }
    }

    public function editCategory(Request $request,GoodsCategory $goodsCategory)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data = $goodsCategory->findOrFail($request->id);
            $data->name = $request->name;
            $res = $data->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect('/Admin/Goods/goodsCategoryList')->with('alert',$alert);
        }else {
            $data = $goodsCategory->findOrFail($request->id);
            return view('Admin.Goods.add_category')->with(compact('data'));
        }
    }

    public function deleteGoodsCategory(Request $request,GoodsCategory $goodsCategory)
    {
        if ($request->method() == 'DELETE')
        {
            $res = $goodsCategory->destroy($request->id);
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

    public function goodsList(Request $request,Goods $goods)
    {
        $list = $goods->where('category_id',$request->id)->get();
        return view('Admin.Goods.goods_list')->with(compact('list'));
    }

    public function addGoods(Request $request,GoodsCategory $goodsCategory,Goods $goods)
    {
        if (strtolower($request->method()) == 'post')
        {
            $goods->category_id = $request->category_id;
            $goods->value = $request->value;
            $res = $goods->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Goods/goodsList/{$request->category_id}")->with('alert',$alert);
        }else {
            $cate_list = $goodsCategory->all();
            return view('Admin.Goods.add_goods')->with(compact('cate_list'));
        }
    }

    public function editGoods(Request $request,GoodsCategory $goodsCategory,Goods $goods)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data = $goods->findOrFail($request->id);
            $data->category_id = $request->category_id;
            $data->value = $request->value;
            $res = $data->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Goods/goodsList/{$request->category_id}")->with('alert',$alert);
        }else {
            $cate_list = $goodsCategory->all();
            $data = $goods->findOrFail($request->id);
            return view('Admin.Goods.add_goods')->with(compact('cate_list','data'));
        }
    }

    public function deleteGoods(Request $request,Goods $goods)
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
