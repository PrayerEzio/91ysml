<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends CommonController
{
    private $_cart_name = 'Home.Cart';

    public function __construct(Cart $cart)
    {
        parent::__construct();
        $cart::instance($this->_cart_name);
    }

    public function index(Request $request)
    {
        $data = [
            'cart' => Cart::instance($this->_cart_name)->content(),
            'total' => Cart::instance($this->_cart_name)->total(),
            'count' => Cart::instance($this->_cart_name)->count(),
        ];
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed.'),
                'data' => $data,
            ]);
        } else {
            return view('Home.Cart.index')->with(compact('data'));
        }
    }

    public function create(Request $request,Product $product)
    {
        $product = $product->where('stock','>=',$request->qty)->find($request->id);
        if (empty($product))
        {
            return response([
                'status'  => 404,
                'message' => __('Data is not found'),
            ]);
        }
        $options = [];
        foreach ($product->attributes as $attribute)
        {
            $options['attributes'][$attribute->category->name] = $attribute->value;
        }
        $options['picture'] = $product->goods->picture;
        Cart::instance($this->_cart_name)->add(['id'=>$product->id,'name'=>$product->goods->name,'qty'=>$request->qty,'price'=>$product->price,'options'=>$options]);
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed'),
            ]);
        } else {
            //Todo
        }
    }

    public function update(Request $request,Product $product)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;
        $cart_info = $this->cart->get($rowId);
        $product_info = $product->find($cart_info->id);
        if ($product_info->stock < $qty)
        {
            return response([
                'status'  => 300,
                'message' => __('low stocks'),
            ]);
        }else {
            $this->cart->update($rowId,$qty);
            return response([
                'status'  => 200,
                'message' => __('Operation succeed'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        $this->cart->remove($request->rowId);
        if ($request->ajax()) {
            return response([
                'status'  => 200,
                'message' => __('Operation succeed'),
            ]);
        } else {
            //Todo
        }
    }

    public function destroy()
    {
        Cart::instance($this->_cart_name)->destroy();
        dump(Cart::instance($this->_cart_name)->content());
        return true;
    }
}
