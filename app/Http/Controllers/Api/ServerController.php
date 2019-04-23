<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Res;
use App\Http\Models\ServerInfo;

class ServerController extends Controller{

    public $server;

    public function __construct(ServerInfo $server){

        $this->server = $server; 
    }

    public function index(){
        $res = $this->server->get();
        return Res::success($res);
    }
        
    

}