<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (! Auth::guard('api')->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Authentication required.',
            ], 401);
        }

        $user = Auth::guard('api')->user();

        if (! $user->hasPermission($permission)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied. Required permission: '.$permission,
                'required_permission' => $permission,
                'user_permissions' => $user->allPermissions()->pluck('name'),
            ], 403);
        }

        return $next($request);
    }
}
