<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $payload = JWTAuth::getPayload()->get();
        if (!isset($payload['role']) || !$payload['role']) {
            abort(401, '无访问权限');
        }
        return $next($request);
    }
}
