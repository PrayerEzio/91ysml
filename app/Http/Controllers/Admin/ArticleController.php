<?php
namespace App\Http\Controllers\Admin;
use App\Http\Models\Article;
use App\Http\Models\ArticleCate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class ArticleController extends CommonController
{
    public function index(Article $article)
    {
        $article_list = $article
                        /*->where('published_at','<=',Carbon::now())*/
                        ->orderBy('published_at','desc')
                        ->paginate(9);
        foreach ($article_list as $key => $article)
        {
            $article_list[$key]['tag'] = explode(',',$article['tag']);
        }
        return view('Admin.Article.index')->with(compact('article_list'));
    }

    public function show(Article $article,Request $request)
    {
        $slug = $request->slug;
        $article = $article::whereSlug($slug)
                    /*->where('published_at','<=',Carbon::now())*/
                    ->firstOrFail();
        $article['tag'] = explode(',',$article['tag']);
        return view('Admin.Article.show')->with(compact('article'));
    }

    public function add(Request $request,ArticleCate $articleCate)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['category_id'] = $request->category_id;
            $data['title'] = $request->title;
            $data['slug'] = str_slug($data['title']);
            $data['author'] = $request->author;
            $data['tag'] = $request->tag;
            $data['description'] = $request->description;
            $data['seo_title'] = $request->seo_title;
            $data['seo_keywords'] = $request->seo_keywords;
            $data['seo_description'] = $request->seo_description;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['body'] = $request->body;
            $data['sort'] = $request->sort;
            $data['image'] = '';
            $res = Article::create($data);
            dd($res);
        }else {
            $article_cates = $articleCate->get();
            return view('Admin.Article.add')->with(compact('article_cates'));
        }
    }

    public function edit(Request $request,ArticleCate $articleCate,Article $article)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['id'] = $request->id;
            $data['category_id'] = $request->category_id;
            $data['title'] = $request->title;
            $data['slug'] = str_slug($data['title']);
            $data['author'] = $request->author;
            $data['tag'] = $request->tag;
            $data['description'] = $request->description;
            $data['seo_title'] = $request->seo_title;
            $data['seo_keywords'] = $request->seo_keywords;
            $data['seo_description'] = $request->seo_description;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['body'] = $request->body;
            $data['sort'] = $request->sort;
            $data['image'] = '';
            $res = Article::update($data);
            dd($res);
        }else {
            $article_cates = $articleCate->get();
            $id = $request->id;
            $article = $article->findOrFail($id);
            return view('Admin.Article.add')->with(compact('article_cates','article'));
        }
    }

    public function addCate(Request $request,ArticleCate $articleCate)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['name'] = $request->name;
            $data['parent_id'] = $request->parent_id;
            $data['sort'] = $request->sort;
            $data['status'] = 1;
            $res = ArticleCate::create($data);
            dd($res);
        }else {
            $article_cates = $articleCate->get();
            return view('Admin.Article.add_cate')->with(compact('article_cates'));
        }
    }

    public function editCate(Request $request,ArticleCate $articleCate)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['id'] = $request->id;
            $data['name'] = $request->name;
            $data['parent_id'] = $request->parent_id;
            $data['sort'] = $request->sort;
            $data['status'] = 1;
            $res = ArticleCate::update($data);
            dd($res);
        }else {
            $article_cates = $articleCate->get();
            $cate_info = $articleCate->findOrFail($request->id);
            return view('Admin.Article.addCate')->with(compact('article_cates','cate_info'));
        }
    }

    public function cateList()
    {
        return view('Admin.Article.cate_list');
    }

    public function delete(Request $request,Article $article)
    {
        if ($request->method() == 'DELETE')
        {
            $res = $article->destroy($request->id);
            if ($res)
            {
                return response([
                    'status'  => 200,
                    'message' => __('Operation succeed.'),
                    'data' => $res
                ]);
            }else {
                return response([
                    'status'  => 500,
                    'message' => __('Operation fail.'),
                    'data' => $res
                ]);
            }
        }
    }
}
