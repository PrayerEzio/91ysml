<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User', 'user_id');
    }

    public function products()
    {
        return $this->hasMany('App\Http\Models\OrderProduct','order_id','id');
    }

    public function logs()
    {
        return $this->hasMany('App\Http\Models\OrderLog','order_id','id');
    }

    public function address()
    {
        return $this->hasOne('App\Http\Models\Address','id','address_id');
    }

    public function scopeOrderSn($query,$sn)
    {
        return $query->where('order_sn',$sn);
    }

    public function scopeUserId($query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }

    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }
}
