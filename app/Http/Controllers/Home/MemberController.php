<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

class MemberController extends CommonController
{
    public function index()
    {
        return view('Home.Member.index')->with(compact('member_info'));
    }
}
