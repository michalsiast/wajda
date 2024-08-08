<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;

class ConfigCache
{
    public function handle($request, Closure $next) {
        return $next($request);
    }

    public function terminate($request, $response) {
        Artisan::call('config:cache');
    }
}
