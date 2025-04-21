<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (! Auth::guard('api')->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Authentication required.',
            ], 401);
        }

        $user = Auth::guard('api')->user();

        if (! $user->hasRole($role)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied. Required role: '.$role,
                'required_role' => $role,
                'user_roles' => $user->roles()->pluck('name'),
            ], 403);
        }

        return $next($request);
    }
}
