<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Jwt;
use App\Http\Models\Res;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // print_r($request->header('token'));die;
        if(!$token = $request->header('token')){
            return response(Res::fail("请先登陆",301), 200);
        }
        
        if( !$getPayload=(new Jwt)->verifyToken($token)){
            return response(Res::fail("token不合法",301), 200);
        }
        $userinfo=$getPayload['sub'];
        // $request->input('username') = $username; 
        // print_r( $username);die;
        // print_r( $request);die;
        // $response =  $next($request);
        $userArr = explode("/",$userinfo);
        $GLOBALS['userid'] = $userArr[0];
        $GLOBALS['username'] = $userArr[1];
        $response =  $next($request);
        return $response;
    }
}
