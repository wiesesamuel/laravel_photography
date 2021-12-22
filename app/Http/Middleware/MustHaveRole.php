<?php

namespace App\Http\Middleware;

use App\Enum\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MustHaveRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if ($role != null) {
            $role = intval($role);
            if (Auth::guest() || Auth::user()->level() < $role) {
                return abort(Response::HTTP_FORBIDDEN, "You must be an " . UserRole::fromValue($role)->key);
            }
        }

        return $next($request);
    }
}
