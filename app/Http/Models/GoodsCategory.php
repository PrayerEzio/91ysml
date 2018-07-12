<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsCategory extends Model
{
    protected $table = 'goods_category';

    public function goods()
    {
        return $this->hasMany('App\Http\Models\Goods');
    }

    public function scopeParent($query,$parent_id)
    {
        return $query->where('parent_id',$parent_id);
    }
}
