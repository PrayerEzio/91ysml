<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'users';

    protected $fillable = ['nickname', 'email', 'password', 'register_ip', 'status'];

    protected $hidden = [
        'password', 'token',
    ];

    public function scopeUserId($query,$user_id)
    {
        return $query->where('id',$user_id);
    }

    public function orders()
    {
        return $this->hasMany('App\Http\Models\Order','user_id','id');
    }

    public function address()
    {
        return $this->hasMany('App\Http\Models\Address','user_id','id');
    }
}
