<?php

namespace Alri\Test\Middlewares;

use Closure;

class CheckTest
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
	      dd("Middleware Is OK !!!");
        return $next($request);
    }
}
