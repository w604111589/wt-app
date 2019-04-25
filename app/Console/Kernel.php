<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ServerInfo;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\ServerConsole::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 每分钟执行一次
        // $schedule->call(function () {
        //     $server = new ServerInfo();    
        //     $data = $server->get();
        //     $res = [];
        //     $res['cpu_load'] = $data['cpu']['load'];
        //     $res['disk_totalkb'] = $data['disk']['totalkb'];
        //     $res['disk_freekb'] = $data['disk']['freekb'];
        //     $res['create_time'] = date("y-m-d h:i:s");
        //     DB::table('wt_server')->insert($res);
        // })->cron("* * * * *");

        $schedule->command('server:save')->everyMinute();
    }
}
