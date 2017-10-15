<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        if (\Session::get('lang') == null) {
            \Session::put('lang','mn');
            \Session::save();
            \App::setLocale(\Session::get('lang'));
        }else{
            \App::setLocale(\Session::get('lang'));
        }

        return $next($request);
    }

}
