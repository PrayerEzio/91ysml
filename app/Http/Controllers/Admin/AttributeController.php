<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Attribute;
use App\Http\Models\AttributeCategory;
use Illuminate\Http\Request;

class AttributeController extends CommonController
{
    public function attributeCategoryList(AttributeCategory $attributeCategory)
    {
        $list = $attributeCategory->all();
        return view('Admin.Attribute.attribute_category_list')->with(compact('list'));
    }

    public function addCategory(Request $request,AttributeCategory $attributeCategory)
    {
        if (strtolower($request->method()) == 'post')
        {
            $attributeCategory->name = $request->name;
            $res = $attributeCategory->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
                return redirect('/Admin/Attribute/attributeCategoryList')->with('alert',$alert);
            }else {
                return redirect()->back()->withInput()->withErrors('保存失败！');
            }
        }else {
            return view('Admin.Attribute.add_category');
        }
    }

    public function editCategory(Request $request,AttributeCategory $attributeCategory)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data = $attributeCategory->findOrFail($request->id);
            $data->name = $request->name;
            $res = $data->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect('/Admin/Attribute/attributeCategoryList')->with('alert',$alert);
        }else {
            $data = $attributeCategory->findOrFail($request->id);
            return view('Admin.Attribute.add_category')->with(compact('data'));
        }
    }

    public function deleteAttributeCategory(Request $request,AttributeCategory $attributeCategory)
    {
        if ($request->method() == 'DELETE')
        {
            $res = $attributeCategory->destroy($request->id);
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

    public function addAttribute(Request $request,AttributeCategory $attributeCategory,Attribute $attribute)
    {
        if (strtolower($request->method()) == 'post')
        {
            $attribute->category_id = $request->category_id;
            $attribute->value = $request->value;
            $res = $attribute->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Attribute/attributeList/{$request->category_id}")->with('alert',$alert);
        }else {
            $cate_list = $attributeCategory->all();
            return view('Admin.Attribute.add_attribute')->with(compact('cate_list'));
        }
    }

    public function editAttribute(Request $request,AttributeCategory $attributeCategory,Attribute $attribute)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data = $attribute->findOrFail($request->id);
            $data->category_id = $request->category_id;
            $data->value = $request->value;
            $res = $data->save();
            if ($res)
            {
                $alert = ['success','操作成功'];
            }else {
                $alert = ['error','操作失败'];
            }
            return redirect("/Admin/Attribute/attributeList/{$request->category_id}")->with('alert',$alert);
        }else {
            $cate_list = $attributeCategory->all();
            $data = $attribute->findOrFail($request->id);
            return view('Admin.Attribute.add_attribute')->with(compact('cate_list','data'));
        }
    }

    public function deleteAttribute(Request $request,Attribute $attribute)
    {
        if ($request->method() == 'DELETE')
        {
            $res = $attribute->destroy($request->id);
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

    public function attributeList(Request $request,Attribute $attribute)
    {
        $list = $attribute->where('category_id',$request->id)->get();
        return view('Admin.Attribute.attribute_list')->with(compact('list'));
    }
}