<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = ['nickname', 'email', 'password', 'register_ip', 'status'];

    public function scopeUserId($query,$user_id)
    {
        return $query->where('id',$user_id);
    }

    public function orders()
    {
        return $this->hasMany('App\Http\Models\Order','user_id','id');
    }
}
