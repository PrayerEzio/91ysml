<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MatOrderProduct extends Model
{
    protected $connection = 'mysql_2';

    protected $table = "order_product";

    public function data()
    {
        return $this->hasOne('App\Http\Models\MatOrderProductData','id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Http\Models\MatCategory', 'catid');
    }
}
