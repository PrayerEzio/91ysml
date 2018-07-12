<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebhookController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function github(Request $request)
    {
        if ($request->ajax()) {
            $this->system_log('Github webhook.', 'post请求已被接受,start git cmd.', 0, 'github');
            $cmd = 'cd '.base_path().';git checkout master;git pull origin master:master;';
            $output = shell_exec($cmd);
            $this->system_log('Github webhook.', $output, 0, 'github');
        }
    }
}
