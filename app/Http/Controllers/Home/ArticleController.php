<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends CommonController
{
    public $top_navbar;

    public function __construct()
    {
        parent::__construct();
        $this->top_navbar = __('Home/common.articles');
    }

    public function index(Article $article_model)
    {
        $article_list = $article_model->paginate(6);
        $top_navbar = $this->top_navbar;
        return view('Home.Article.index')->with(compact('article_list','top_navbar'));
    }

    public function show(Request $request,Article $article_model)
    {
        $article = $article_model->active()->find($request->id);
        $top_navbar = $this->top_navbar;
        return view('Home.Article.show')->with(compact('article','top_navbar'));
    }
}
