<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCate extends Model
{
    protected $table = 'article_category';

    protected $fillable = ['name', 'parent_id', 'sort', 'status'];

    public function articles()
    {
        return $this->hasMany('App\Http\Models\Article','category_id','id');
    }
}
