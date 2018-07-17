<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['category_id', 'title', 'author', 'tag', 'image', 'slug', 'description', 'body', 'seo_title', 'seo_keywords', 'seo_description', 'page_view', 'status', 'sort'];

    public function category()
    {
        return $this->belongsTo('App\Http\Models\ArticleCategory', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
