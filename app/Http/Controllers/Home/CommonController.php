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

    protected function system_log($title, $content, $type, $level = 0, $operator_type = 'system', $ip = 'unknown', $operator_id = 0)
    {
        $system_log = new SystemLog();
        $system_log->type = $type;
        $system_log->level = $level;
        $system_log->title = $title;
        $system_log->content = $content;
        $system_log->operator_type = $operator_type;
        $system_log->operator_id = $operator_id;
        $system_log->ip = $ip;
        $system_log->save();
        return $system_log->id;
    }
}
