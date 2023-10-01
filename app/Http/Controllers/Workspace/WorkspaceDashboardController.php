<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceDashboardController extends Controller
{
    public function __invoke(Company $company): Response
    {
        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Dashboard', [
            'company' => $company,
            'companiesCount' => $companiesCount
        ]);
    }
}
