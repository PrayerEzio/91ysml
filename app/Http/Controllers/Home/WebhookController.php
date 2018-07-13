<?php

namespace App\Http\Controllers\Home;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

class WebhookController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function github(Request $request,Schedule $schedule)
    {
        if ($request->post()) {
            $this->system_log('Github webhook.', 'post请求已被接受,start git cmd.', Route::currentRouteAction(), 0, 'github');
            $cmd = 'sudo cd '.base_path().';sudo git checkout master;sudo git pull origin master:master;';
            //$output = shell_exec($cmd);
            $output = Artisan::call();
            dd($output);
            $this->system_log('Github webhook.', $output, Route::currentRouteAction(), 0, 'github');
        }
    }
}
