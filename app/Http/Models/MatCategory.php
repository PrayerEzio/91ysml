<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MatCategory extends Model
{
    protected $connection = 'mysql_2';

    protected $table = "category";

    public function products()
    {
        return $this->hasMany('App\Http\Models\MatOrderProduct','catid','catid');
    }
}
