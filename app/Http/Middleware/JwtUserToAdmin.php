<?php

namespace App\Http\Middleware;

use Closure;

class JwtUserToAdmin
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
        config(['jwt.user' => '\App\Models\Admin']);
        config(['auth.providers.users.model' => \App\Models\Admin::class]);
        return $next($request);
    }
}
