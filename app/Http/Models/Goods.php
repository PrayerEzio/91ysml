<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';

    public function category()
    {
        return $this->belongsTo('App\Http\Models\GoodsCategory', 'category_id');
    }

    public function products()
    {
        return $this->hasMany('App\Http\Models\Product','goods_id','id');
    }

    public function pictures()
    {
        return $this->hasMany('App\Http\Models\GoodsPicture','goods_id','id');
    }
}
