<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DefaultToAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app()->config->set('auth.defaults.guard', 'admin');

        return $next($request);
    }
}
