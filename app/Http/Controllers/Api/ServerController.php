<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Res;
use App\Http\Models\ServerInfo;
use App\Http\Models\Api\Server;

class ServerController extends Controller{

    public $server;

    public function __construct(ServerInfo $server){

        $this->server = $server; 
    }

    public function index(Request $request){
        $res = $this->server->get();

        return Res::success($res);
    }

    public function getCpuLoadAll(Request $request){

        $input = $request->only('create_time');
        $limit = $request->input('limit',300);
        // print_r($input);

        $res = Server::getCpuInfo($input,$limit);
        return Res::success($res);
    }

    public function getCpuLoadOne(Request $request){

        // $data = $this->server->get();
        // $res = [];
        // $res['cpu_load'] = $data['cpu']['load'];
        // $res['disk_totalkb'] = $data['disk']['totalkb'];
        // $res['disk_freekb'] = $data['disk']['freekb'];
        // $res['create_time'] = date("y-m-d h:i:s");

        $input = $request->only('create_time');
        $res = Server::getCpuInfoOne($input);
        return Res::success($res);
    }
        
    

}