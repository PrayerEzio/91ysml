<?php
namespace App\Http\Controllers\Admin;
use App\Http\Models\Article;
use App\Http\Models\ArticleCate;
use App\Http\Service\QiniuService;
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

    public function add(Request $request,ArticleCate $articleCate,QiniuService $qiniuService)
    {
        if (strtolower($request->method()) == 'post')
        {
            if ($request->file('image'))
            {
                $data['image'] = $qiniuService->upload($request->file('image'));
            }
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
            $res = Article::create($data);
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Article/index")->with('alert',$alert);
        }else {
            $article_cates = $articleCate->get();
            return view('Admin.Article.add')->with(compact('article_cates'));
        }
    }

    public function edit(Request $request,ArticleCate $articleCate,Article $article,QiniuService $qiniuService)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['id'] = $request->id;
            if ($request->file('image'))
            {
                $data['image'] = $qiniuService->upload($request->file('image'));
            }
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
            $res = Article::update($data);
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Article/index")->with('alert',$alert);
        }else {
            $article_cates = $articleCate->get();
            $id = $request->id;
            $article = $article->findOrFail($id);
            return view('Admin.Article.add')->with(compact('article_cates','article'));
        }
    }

    public function addCate(Request $request,ArticleCate $articleCate,$id)
    {
        if (strtolower($request->method()) == 'post')
        {
            $articleCate->name = $request->name;
            $articleCate->parent_id = $id;
            $articleCate->sort = $request->sort;
            $articleCate->status = $request->status == 'on' ? 1 : 0;
            $res = $articleCate->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Article/cateList")->with('alert',$alert);
        }else {
            return view('Admin.Article.add_cate');
        }
    }

    public function editCate(Request $request,ArticleCate $articleCate,$id)
    {
        if (strtolower($request->method()) == 'post')
        {
            $articleCate = $articleCate->findOrFail($id);
            $articleCate->name = $request->name;
            $articleCate->parent_id = $request->parent_id;
            $articleCate->sort = $request->sort;
            $articleCate->status = $request->status == 'on' ? 1 : 0;
            $res = $articleCate->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Article/cateList")->with('alert',$alert);
        }else {
            $article_cates = $articleCate->get();
            $data = $articleCate->findOrFail($request->id);
            return view('Admin.Article.add_cate')->with(compact('article_cates','data'));
        }
    }

    public function cateList()
    {
        return view('Admin.Article.cate_list');
    }

    public function delete(Request $request,Article $article)
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

    public function deleteCate(Request $request,ArticleCate $articleCate)
    {
        $res = false;
        $child_count = $articleCate->where('parent_id',$request->id)->count();
        if (!$child_count)
        {
            $res = $articleCate->destroy($request->id);
        }
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
