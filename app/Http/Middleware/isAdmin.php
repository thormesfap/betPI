<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('api')->user()) {
            return response()->json(['success' => false, 'message' => 'Usuário não identificado'], Response::HTTP_UNAUTHORIZED);
        }
        $user = auth('api')->user();
        $roles = $user->getRoleNamesAttribute();
        if (!in_array('role_admin', $roles)) {
            return response()->json(['success' => false, 'message' => 'Usuário não tem permissão'], Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
