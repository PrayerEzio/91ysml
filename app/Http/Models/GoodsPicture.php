<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsPicture extends Model
{
    protected $table = 'goods_pictures';

    public function goods()
    {
        return $this->belongsTo('App\Http\Models\Goods', 'goods_id');
    }
}
