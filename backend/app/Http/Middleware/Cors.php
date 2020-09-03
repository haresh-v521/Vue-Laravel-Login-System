<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        header('Access-Control-Allow-Origin: *');

        $headers = [
                'Access-Control-Allow-Methods' => 'POST,GET,PUT,PATCH, DELETE',
                'Access-Control-Allow-Headers' => 'Content-type, X-Auth-Token, Authorization, Origin'
        ];

        if ($request->getMethod() == "OPTIONS") {
            return response()->json('OK', 200, $headers);
        }



        $response =  $next($request);
        foreach ($headers as $key => $val) {
            $response->header($key, $val);
        }

        return $response;

    }
}