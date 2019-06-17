<?php

namespace App\Console;

use App\Http\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $this->cancelOvertimeOrder();//取消超时订单
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    //清除超时未支付订单
    private function cancelOvertimeOrder(Order $order)
    {
        echo Carbon::now()."|Crontab:cancelOvertimeOrder->Start:\n";
        $over_order_where[] = ['status',1];
        $over_order_where[] = ['created_at','<=',Carbon::now()->subHour()];
        $order->where($over_order_where)->chunk(100,function ($order_list) {
            foreach ($order_list as $order_info) {
                DB::beginTransaction(); //事务开始
                try{
                    //1.改变订单状态
                    $order_info->status = -1;
                    $order_info->save();
                    //2.回滚库存
                    foreach ($order_info->products as $order_product)
                    {
                        $product_model = new Product();
                        $product_model->where('id',$order_product->product_id)->increment('stock',$order_product->qty);
                    }
                    DB::commit();//提交事务
                    system_log('SystemCancelOvertimeOrder', "[{$order_info->order_sn}]cancel overtime order success!", 'app\Console\Kernel@cancelOvertimeOrder', 0, 'Crontab', '127.0.0.1');
                } catch(QueryException $ex) {
                    DB::rollback(); //回滚事务
                    system_log('SystemCancelOvertimeOrder', "[{$order_info->order_sn}]cancel overtime order failed!".$ex->getMessage(), 'app\Console\Kernel@cancelOvertimeOrder', 9, 'Crontab', '127.0.0.1');
                }
            }
        });
        echo Carbon::now()."|Crontab:cancelOvertimeOrder->End.\n";
    }
}
