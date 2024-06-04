<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Redirect;

class ApiAuthMiddleware
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
		if (!auth('api')->check()) {
			throw new Exception('UNAUTHORIZED EXCEPTION', 401);
		}
		return $next($request);
	}
}
