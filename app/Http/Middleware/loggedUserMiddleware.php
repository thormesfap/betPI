<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class loggedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('api')->user()) {
            return response()->json(['success' => false, 'message' => 'Usuário não logado'], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
