<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $userRole = strtolower((string) (Auth::user()->role ?? 'student'));
        $allowedRoles = array_map('trim', explode(',', strtolower($role)));

        if (!in_array($userRole, $allowedRoles, true)) {
            return response()->json(['message' => 'Forbidden. Insufficient role permissions.'], 403);
        }

        return $next($request);
    }
}
