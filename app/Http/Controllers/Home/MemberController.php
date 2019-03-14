<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Address;
use App\Http\Models\User;
use App\Http\Services\QiniuService;
use Illuminate\Http\Request;

class MemberController extends CommonController
{
    public function index(Request $request,User $user,QiniuService $qiniuService)
    {
        $member_info = $user->userId($this->getUserId())->first();
        if ($request->isMethod('post'))
        {
            if ($request->file('avatar'))
            {
                $file = $request->file('avatar');
                $member_info->avatar = $qiniuService->upload($file);
            }
            $member_info->nickname = $request->nickname;
            $member_info->phone = $request->phone;
            $member_info->save();
            return redirect('/Home/Member/index')->with('alert',['success','操作成功']);
        }else {
            $member_info = $user->userId($this->getUserId())->first();
            return view('Home.Member.index')->with(compact('member_info'));
        }
    }

    public function resetPassword(Request $request,User $user)
    {
        $member_info = $user->userId($this->getUserId())->first();
        if ($request->isMethod('post'))
        {
            $member_info->password = Crypt::encrypt($request->password);
            $member_info->save();
        }else {
            return view('Home.Member.reset_password');
        }
    }

    public function addressList(Address $address)
    {
        $list = $address->userId($this->getUserId())->orderBy('sort','desc')->paginate(10);
        return view('Home.Member.addressList')->with(compact('list'));
    }

    public function collectList()
    {
        $list = [];
        return view('Home.Member.collectList')->with(compact('list'));
    }

    public function wallet()
    {
        return view('Home.Member.wallet');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_info');
        return redirect('Home')->with('alert',['success','登出账户成功']);
    }
}
