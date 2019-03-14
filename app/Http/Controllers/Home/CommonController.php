<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Models\Region;
use App\Http\Models\SystemLog;
use Illuminate\Http\Request;

abstract class CommonController extends Controller
{
    public $top_navbar = '';

    public function __construct()
    {
        parent::__construct();
        $this->top_navbar = '';
    }

    protected function getUserId()
    {
        return session('user_info.id');
    }

    public function getRegionsName($id)
    {

        $region = Region::where('status',1)->where('id',$id)->first();
        return $region->name;
    }
}
