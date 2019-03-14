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

    public function github(Request $request)
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if ($request->post() && strpos($user_agent,'GitHub-Hookshot') === 0)
        {
            system_log('Github webhook.', $request, Route::currentRouteAction(), 0, 'github', $request->ip());
            $cmd = 'sudo cd '.base_path().';sudo git checkout master;';//sudo git pull origin master:master;
            $output = shell_exec($cmd);
            system_log('Github webhook.', $output, Route::currentRouteAction(), 0, 'github', $request->ip());
        }
    }
}
