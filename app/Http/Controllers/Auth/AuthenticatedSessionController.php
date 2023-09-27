<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return $this->redirectToAppropriateDashboard($request);
    }

    protected function redirectToAppropriateDashboard(LoginRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        $companyCount = $user->companies()->count();

        if ($companyCount === 1) {
            return redirect()->intended(route('workspace.dashboard'));
        } elseif ($companyCount > 1) {
            return redirect()->intended(route('workspace.selector'));
        }

        return $this->destroy($request);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
