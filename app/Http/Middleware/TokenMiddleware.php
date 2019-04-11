<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Jwt;

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
            return response('Please log in first', 401);
        }

        if( !$getPayload=(new Jwt)->verifyToken($token)){
            return response('Illegal token', 401);
        }
        $response =  $next($request);
        return $response;
    }
}
