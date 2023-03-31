<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanMiddleware
{
	/**
	 * @param  Request  $request
	 * @param  Closure  $next
	 * @param  string  $pemission
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next, string $pemission)
	{
		if (! can($pemission)) {
			abort(403);
		}

		return $next($request);
	}
}
