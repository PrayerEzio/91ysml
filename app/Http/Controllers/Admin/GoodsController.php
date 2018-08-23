<?php
/**
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Models\Attribute;
use App\Http\Models\AttributeCategory;
use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use App\Http\Models\Product;
use App\Http\Services\QiniuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsController extends CommonController
{
    public function goodsCategoryList()
    {
        return view('Admin.Goods.goods_category_list');
    }

    public function addCategory(Request $request,GoodsCategory $goodsCategory,$id,QiniuService $qiniuService)
    {
        if (strtolower($request->method()) == 'post')
        {
            if ($request->file('image'))
            {
                $goodsCategory->image = $qiniuService->upload($request->file('image'));
            }
            $goodsCategory->name = $request->name;
            $goodsCategory->parent_id = $id;
            $goodsCategory->sort = $request->sort;
            $goodsCategory->status = $request->status == 'on' ? 1 : 0;
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

    public function editCategory(Request $request,GoodsCategory $goodsCategory,$id,QiniuService $qiniuService)
    {
        if (strtolower($request->method()) == 'post')
        {
            $goodsCategory = $goodsCategory->findOrFail($id);
            if ($request->file('image'))
            {
                $goodsCategory->image = $qiniuService->upload($request->file('image'));
            }
            $goodsCategory->name = $request->name;
            $goodsCategory->parent_id = $request->parent_id;
            $goodsCategory->sort = $request->sort;
            $goodsCategory->status = $request->status == 'on' ? 1 : 0;
            $res = $goodsCategory->save();
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
        $res = false;
        $child_count = $goodsCategory->where('parent_id',$request->id)->count();
        if (!$child_count)
        {
            $res = $goodsCategory->destroy($request->id);
        }
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

    public function goodsList(Request $request,Goods $goods)
    {
        $where = [];
        $input = $request->all();
        if (!empty($input['keyword'])) $where[] = ['name','like',"%{$input['keyword']}%"];
        $list = $goods->where($where)->orderBy('created_at','desc')->paginate(10);
        return view('Admin.Goods.goods_list')->with(compact('list','input'));
    }

    public function addGoods(Request $request,Goods $goods,GoodsCategory $goodsCategory,AttributeCategory $attributeCategory,Attribute $attribute,QiniuService $qiniuService)
    {
        if (strtolower($request->method()) == 'post')
        {
            DB::beginTransaction(); //事务开始
            try {
                $fillable_filed = ['category_id','goods_no','name','sub_title','tag','description','seo_title','seo_keywords','seo_description','sort','detail'];
                if ($request->file('picture'))
                {
                    $goods->picture = $qiniuService->upload($request->file('picture'));
                }
                foreach ($fillable_filed as $item)
                {
                    $goods->$item = $request->$item;
                }
                $goods->status = $request->status == 'on' ? 1 : 0;
                $goods->save();
                foreach ($request->product as $key => $item)
                {
                    $product = new Product();
                    $product->goods_id = $goods->id;
                    $product->product_no = $item['product_no'];
                    $product->mkt_price = $item['mkt_price'];
                    $product->price = $item['price'];
                    $product->stock = $item['stock'];
                    $product->position = $item['position'];
                    $product->status = 1;
                    $product->save();
                    foreach ($item['attribute'] as $item)
                    {
                        $product->attributes()->attach($item);
                    }
                }
                DB::commit(); //提交事务
                $res = true;
            } catch(QueryException $ex) {
                DB::rollback(); //回滚事务
                //异常处理
                $res = false;
            }
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Goods/goodsList/{$request->category_id}")->with('alert',$alert);
        }else {
            $cate_list = $goodsCategory->get();
            $cate_list = $this->unlimitedForLayer($cate_list);
            $attribute_category_list = $attributeCategory->get();
            $attribute_list = $attribute->get();
            return view('Admin.Goods.add_goods')->with(compact('cate_list','attribute_category_list','attribute_list'));
        }
    }

    public function editGoods($id,Request $request,Goods $goods,GoodsCategory $goodsCategory,AttributeCategory $attributeCategory,Attribute $attribute,QiniuService $qiniuService)
    {
        if (strtolower($request->method()) == 'post')
        {
            DB::beginTransaction(); //事务开始
            try {
                $goods = $goods->findOrFail($request->id);
                $fillable_filed = ['category_id','goods_no','name','sub_title','tag','description','seo_title','seo_keywords','seo_description','sort','detail'];
                if ($request->file('picture'))
                {
                    $goods->picture = $qiniuService->upload($request->file('picture'));
                }
                foreach ($fillable_filed as $item)
                {
                    $goods->$item = $request->$item;
                }
                $goods->status = $request->status == 'on' ? 1 : 0;
                $goods->save();
                $product = new Product();
                $product->whereGoodsId($goods->id)->delete();
                //软删除旧产品 新增新产品
                foreach ($request->product as $key => $item)
                {
                    $product = new Product();
                    $product->goods_id = $goods->id;
                    $product->product_no = $item['product_no'];
                    $product->mkt_price = $item['mkt_price'];
                    $product->price = $item['price'];
                    $product->stock = $item['stock'];
                    $product->position = $item['position'];
                    $product->status = 1;
                    $product->save();
                    //重写所有规格
                    foreach ($item['attribute'] as $item)
                    {
                        $product->attributes()->attach($item);
                    }
                }
                DB::commit(); //提交事务
                $res = true;
            } catch(QueryException $ex) {
                DB::rollback(); //回滚事务
                //异常处理
                $res = false;
            }
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Goods/goodsList/{$request->category_id}")->with('alert',$alert);
        }else {
            $cate_list = $goodsCategory->get();
            $cate_list = $this->unlimitedForLayer($cate_list);
            $attribute_category_list = $attributeCategory->get();
            $attribute_list = $attribute->get();
            $goods_info = $goods->findOrFail($id);
            $product_attributes_category = [];
            foreach ($goods_info->products as $product)
            {
                foreach ($product->attributes as $attribute)
                {
                    if (!in_array($attribute->category->name,$product_attributes_category))
                    {
                        $product_attributes_category[] = $attribute->category->name;
                    }
                }
            }
            $goods_info->product_attributes_category = $product_attributes_category;
            return view('Admin.Goods.add_goods')->with(compact('goods_info','cate_list','attribute_category_list','attribute_list'));
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
