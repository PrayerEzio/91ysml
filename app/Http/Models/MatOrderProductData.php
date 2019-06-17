<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MatOrderProductData extends Model
{
    protected $connection = 'mysql_2';

    protected $table = "order_product_data";

    public function product()
    {
        return $this->belongsTo('App\Http\Models\MatOrderProduct', 'id');
    }
}
