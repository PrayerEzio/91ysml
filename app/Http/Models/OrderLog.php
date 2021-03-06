<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $table = 'order_logs';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Http\Models\Order', 'order_id');
    }
}
