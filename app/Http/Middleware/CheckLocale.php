<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;


class CheckLocale
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
        app()->setLocale($request->lang);
        // if(session()->has('locale')) {
        //     // app()->setLocale(session('locale'));
        //     // app()->setLocale(config('app.locale'));
        //     $this->app->setLocale(session('locale', config('app.locale')));
        // }

        return $next($request);
    }
}
