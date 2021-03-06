<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use App\Http\Models\Product;
use Illuminate\Http\Request;

class GoodsController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->top_navbar = __('Home/common.shop');
    }

    public function show($goods_sn,Goods $goods)
    {
        $goods = $goods->has('products')->with(['products' => function ($query) {
            $query->with(['attributes' => function ($query) {
                $query->orderBy('category_id', 'asc');
            }])->orderBy('product_sn', 'asc');
        }])->goodsSn($goods_sn)->status(1)->first();
        if (empty($goods)) abort(404);
        $goods_category_model = new GoodsCategory();
        $goods_category_list = $goods_category_model->get();
        $goods_category = getParents($goods_category_list,$goods->category_id);
        $product_model = new Product();
        $min_price_product = $product_model->where('goods_id',$goods->id)->active()->orderBy('price')->first();
        $goods->min_price = $min_price_product->price;
        $attribute_list = [];
        foreach ($goods->products as $key => $product)
        {
            $product_attribute = [];
            foreach ($product->attributes as $attribute)
            {
                $product_attribute[] = $attribute->value;
                if (!isset($attribute_list[$attribute->category->name]))
                {
                    $attribute_list[$attribute->category->name] = [];
                }
                in_array($attribute->value,$attribute_list[$attribute->category->name]) ? '' : $attribute_list[$attribute->category->name][] = $attribute->value;
            }
            $product->attribute_string = join('|',$product_attribute);
        }
        $top_navbar = $this->top_navbar;
        return view('Home.Goods.show')->with(compact('goods','goods_category','attribute_list','top_navbar'));
    }
}
