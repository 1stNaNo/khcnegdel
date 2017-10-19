<?php

namespace App\Http\Middleware;

use Closure;

class Modal
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
        if(!$request->has("modal")){
          $request["modal"] = 0;
        }

        return $next($request);
    }

}
