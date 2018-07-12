<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User', 'user_id');
    }

    public function province()
    {
        return $this->belongsTo('App\Http\Models\Region','province_id','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Http\Models\Region','city_id','id');
    }

    public function district()
    {
        return $this->belongsTo('App\Http\Models\Region','district_id','id');
    }
}
