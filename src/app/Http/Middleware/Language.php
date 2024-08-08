<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Language extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
//        app()->setLocale(session()->get('app_locale', config('app.locale')));
        app()->setLocale(Auth::user()->lang);
        return $next($request);
    }
}
