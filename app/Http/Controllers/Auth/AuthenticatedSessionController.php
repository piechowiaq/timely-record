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
     *
     * @return Response
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
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return $this->redirectToAppropriateDashboard($request);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect the authenticated user to the appropriate dashboard.
     * SuperAdmins are redirected to the admin dashboard.
     * Users with a single company are redirected to their company's dashboard.
     * Users with multiple companies are redirected to a company selector.
     * Users with no companies have their session destroyed (though this could be changed).
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    protected function redirectToAppropriateDashboard(LoginRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        $companyCount = $user->companies()->count();

        if ($companyCount === 1) {
            $company = $user->companies()->first();
            return redirect()->intended(route('workspace.dashboard', $company));
        } elseif ($companyCount > 1) {
            return redirect()->intended(route('workspace.selector'));
        }

        // If the user has no companies, destroy the session.
        // This seems unusual, consider handling differently or providing a reason.
        return $this->destroy($request);
    }
}

