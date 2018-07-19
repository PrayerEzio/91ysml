<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use Illuminate\Http\Request;

class UserController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $list = $user->all();
        return view('Admin.User.index')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {
        if ($request->file('avatar'))
        {
            $file = $request->file('avatar');
            $disk = \Storage::disk('qiniu');
            $originalName = $file->getClientOriginalName(); //源文件名
            $ext = $file->getClientOriginalExtension();    //文件拓展名
            $type = $file->getClientMimeType(); //文件类型
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $fileName = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;  //新文件名
            $contents = file_get_contents($realPath);
            $upload_result = $disk->put($fileName,$contents);
        }
        $user->nickname = $request->nickname;
        $user->avatar = env('QINIU_STORAGE_DOMAIN_URL').'/'.$fileName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->amount = $request->amount;
        $user->password = Crypt::encrypt($request->password);
        $user->status = $request->status == 'on' ? 1 : 0;
        $res = $user->save();
        if ($res)
        {
            $alert = ['success','操作成功'];
            return redirect('/Admin/User')->with('alert',$alert);
        }else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {
        $data = $user->findOrFail($id);
        return view('Admin.User.create')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $user->findOrFail($request->id);
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->amount = $request->amount;
        $user->password = Crypt::encrypt($request->password);
        $user->status = $request->status == 'on' ? 1 : 0;
        $res = $user->save();
        if ($res)
        {
            $alert = ['success','操作成功'];
        }else {
            $alert = ['error','操作失败'];
        }
        return redirect("/Admin/User")->with('alert',$alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id,User $user)
    {
        $res = $user->destroy($request->id);
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
