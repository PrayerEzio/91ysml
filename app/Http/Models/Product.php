<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];

    public function goods()
    {
        return $this->belongsTo('App\Http\Models\Goods', 'goods_id');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Http\Models\Attribute','product_attribute','product_id','attribute_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
