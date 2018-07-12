<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    public function category()
    {
        return $this->belongsTo('App\Http\Models\AttributeCategory', 'category_id');
    }

}