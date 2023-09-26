<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCompanyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return string
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->isAdmin){

            return redirect()->route('admin.dashboard');
        }

        if (!$request->user() || !$request->user()->hasCompanyAccess()) {

            // Redirect or abort, based on your preference.
            return abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
