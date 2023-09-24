<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return ResponseAlias
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(ResponseAlias::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
