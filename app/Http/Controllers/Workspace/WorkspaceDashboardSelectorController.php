<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

class WorkspaceDashboardSelectorController extends Controller
{
    /**
     * @return InertiaResponse|RedirectResponse
     */
    public function __invoke(): InertiaResponse|RedirectResponse
    {
        $user = Auth::user();

        // Directly get the count instead of loading all companies
        $companyCount = $user->companies()->count();

        if ($companyCount === 1) {
            $company = $user->companies()->first();
            // Assuming you want to redirect to a different route if there's only one company
            return redirect()->route('workspace.dashboard', ['company' => $company->id]);
        }

        // Load companies only if needed
        $companies = $user->companies;

        return Inertia::render('Workspace/WorkspaceSelector', [
            'companies' => $companies,
        ]);
    }
}




