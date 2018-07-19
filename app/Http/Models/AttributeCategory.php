<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeCategory extends Model
{
    protected $table = 'attribute_category';

    protected $fillable = ['name'];

    public function attributes()
    {
        return $this->hasMany('App\Http\Models\attributes','category_id','id');
    }
}
