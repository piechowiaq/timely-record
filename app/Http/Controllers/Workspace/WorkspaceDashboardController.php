<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceDashboardController extends Controller
{
    public function __invoke(Company $company): Response
    {

        return Inertia::render('Workspace/Dashboard', [
            'company' => $company,
        ]);

    }
}
