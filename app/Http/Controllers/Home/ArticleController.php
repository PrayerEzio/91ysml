<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends CommonController
{
    public function index(Article $article_model)
    {
        $article_list = $article_model->paginate(6);
        return view('Home.Article.index')->with(compact('article_list'));
    }

    public function show(Request $request,Article $article_model)
    {
        $article = $article_model->active()->find($request->id);
        return view('Home.Article.show')->with(compact('article'));
    }
}
