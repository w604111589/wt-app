<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Models\ServerInfo;

class Server extends Command{

	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'server:info';

		
	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = '隔几秒钟获取服务器信息写入数据库';
	
	    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
	}
	
	public function handle()
    {
	   //这里书写你的具体想要实现的事情
	   
	    $server = new ServerInfo();
        $data = $server->get();
        $res = [];
        $res['cpu_load'] = $data['cpu']['load'];
        $res['disk_totalkb'] = $data['disk']['totalkb'];
        $res['disk_freekb'] = $data['disk']['freekb'];
        $res['create_time'] = date("y-m-d h:i:s");
        DB::table('wt_server')->insert($res);

    }


}