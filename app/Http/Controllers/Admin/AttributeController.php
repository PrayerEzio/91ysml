<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\AttributeCategory;
use Illuminate\Http\Request;

class AttributeController extends CommonController
{
    public function attributeCategoryList(AttributeCategory $attributeCategory)
    {
        $list = $attributeCategory->all();
        return view('Admin.Attribute.attribute_category_list')->with(compact('list'));
    }

    public function addCategory(Request $request)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['name'] = $request->name;
            $res = AttributeCategory::create($data);
            dd($res);
        }else {
            return view('Admin.Attribute.addCategory');
        }
    }

    public function editCategory(Request $request,AttributeCategory $attributeCategory)
    {
        if (strtolower($request->method()) == 'post')
        {
            $data['id'] = $request->id;
            $data['name'] = $request->name;
            $res = AttributeCategory::update($data);
            dd($res);
        }else {
            $cate_info = $attributeCategory->findOrFail($request->id);
            return view('Admin.Attribute.addCate')->with(compact('cate_info'));
        }
    }
}
