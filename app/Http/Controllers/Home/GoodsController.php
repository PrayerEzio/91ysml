<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Goods;
use App\Http\Models\GoodsCategory;
use App\Http\Models\Product;
use Illuminate\Http\Request;

class GoodsController extends CommonController
{
    public function show(Request $request,Goods $goods)
    {
        $goods = $goods->find($request->id);
        $goods_category_model = new GoodsCategory();
        $goods_category_list = $goods_category_model->get();
        $goods_category = $this->getParents($goods_category_list,$goods->category_id);
        $product_model = new Product();
        $min_price_product = $product_model->where('stock', '>', 0)->where('goods_id',$goods->id)->active()->orderBy('price')->first();
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
        return view('Home.Goods.show')->with(compact('goods','goods_category','attribute_list'));
    }

}
