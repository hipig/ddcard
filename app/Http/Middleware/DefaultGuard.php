<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DefaultGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $defaultGuard = 'api')
    {
        app()->config->set('auth.defaults.guard', $defaultGuard);

        return $next($request);
    }
}
