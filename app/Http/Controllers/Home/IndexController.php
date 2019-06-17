<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Advertisement;
use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use App\Http\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->top_navbar = __('Home/common.shop');
    }

    public function index(Request $request)
    {
        $ad_model = new Advertisement();
        $banner_list = $ad_model->active()->banner()->orderBy('sort')->get();
        $goods_category_model = new GoodsCategory();
        $goods_category_list = $goods_category_model->parent(0)->get();
        $goods_model = new Goods();
        $goods_list = $goods_model->has('products')->status(1)->paginate(9);
        $product_model = new Product();
        foreach ($goods_list as $key => $item)
        {
            $min_price_product = $product_model->where('goods_id',$item->id)->active()->orderBy('price')->first();
            $goods_list[$key]['min_price'] = $min_price_product->price;
        }
        $top_navbar = $this->top_navbar;
        return view('Home.Index.index')->with(compact('banner_list','goods_category_list','goods_list','top_navbar'));
    }

    public function category(Request $request)
    {
        $goods_category_model = new GoodsCategory();
        $goods_category_list = $goods_category_model->get();
        $child_id_array = getChildsId($goods_category_list,$request->id);
        $child_id_array[] = $request->id;
        $parents_list = getParents($goods_category_list,$request->id);
        $goods_category_list = $goods_category_model->parent($request->id)->get();
        $category_info = $goods_category_model->where('id',$request->id)->first();
        $goods_model = new Goods();
        $goods_list = $goods_model->whereIn('category_id',$child_id_array)->has('products')->paginate(6);
        $goods_count =  $goods_model->whereIn('category_id',$child_id_array)->has('products')->count();
        $product_model = new Product();
        foreach ($goods_list as $key => $item)
        {
            $min_price_product = $product_model->where('goods_id',$item->id)->active()->orderBy('price')->first();
            $goods_list[$key]['min_price'] = $min_price_product->price;
        }
        $top_navbar = "goods_category_{$request->id}";
        return view('Home.Index.category')->with(compact('parents_list','goods_count','category_info','goods_category_list','current_goods_category_list','goods_list','top_navbar'));
    }
}
