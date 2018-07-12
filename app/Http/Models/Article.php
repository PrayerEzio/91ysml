<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function category()
    {
        return $this->belongsTo('App\Http\Models\ArticleCategory', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
