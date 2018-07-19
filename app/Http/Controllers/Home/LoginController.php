<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\User;
use Illuminate\Http\Request;
use Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->top_navbar = __('Home/common.shop');
    }

    public function index(Request $request,User $user)
    {
        if ($input = $request->all())
        {
            $rule = [
                'email' => 'required',
                'password' => 'required',
            ];
            $message = [
                'email.required' => '请输入您的邮箱.',
                'password.required' => '请输入您的密码.',
            ];
            $validator = Validator::make($input,$rule,$message);
            if ($validator->fails())
            {
                return back()->withErrors($validator->errors());
            }
            $user_info = $user->where('email',$input['email'])->select('id','nickname','email','avatar','password','status')->first();
            if (empty($user_info) || $input['password'] !== Crypt::decrypt($user_info['password']))
            {
                $errors[] = '账号密码错误.';
                return back()->withErrors($errors);
            }
            if (empty($user_info['status']))
            {
                $errors[] = '您的账号已被冻结,请联系管理员解冻.';
                return back()->withErrors($errors);
            }
            $user_info_array = $user_info->toArray();
            unset($user_info_array['password']);
            unset($user_info_array['status']);
            session(['user_info'=>$user_info_array]);
            $user_info->token = session('_token');
            $user_info->save();
            return redirect()->action('Home\IndexController@index');
        }else {
            $top_navbar = $this->top_navbar;
            return view('Home.Login.index')->with(compact('top_navbar'));
        }
    }

    public function register(Request $request)
    {
        if ($input = $request->all()) {
            $rule = [
                'nickname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|between:8,32',
                'register_protocol' => 'accepted'
            ];
            $message = [
                'nickname.required' => '请输入昵称',
                'email.required' => '请输入您的邮箱.',
                'email.email' => '您输入的邮箱地址不正确.',
                'email.unique' => '您输入的邮箱已经被注册.',
                'password.required' => '请输入您的密码.',
                'password.confirmed' => '两次输入的密码不一致.',
                'password.between' => '密码长度必须在8到32位之间.',
                'register_protocol.accepted' => '请同意我们的注册协议.'
            ];
            $validator = Validator::make($input, $rule, $message);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            $user_info['nickname'] = $input['nickname'];
            $user_info['email'] = $input['email'];
            $user_info['password'] = Crypt::encrypt($input['password']);
            $user_info['register_ip'] = $request->getClientIp();
            $user_info['status'] = 1;
            $user = User::create($user_info);
            if ($user) {
                //TODO:发送注册成功通知.
                return redirect()->action('Home\MemberController@index');
            } else {
                $errors[] = '网络繁忙,请稍后再试.';
                return back()->withErrors($errors);
            }
        } else {
            $top_navbar = $this->top_navbar;
            return view('Home.Login.register')->with(compact('top_navbar'));
        }
    }
}
