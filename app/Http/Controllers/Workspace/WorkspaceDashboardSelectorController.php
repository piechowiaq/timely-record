<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkspaceDashboardSelectorController extends Controller
{
    public function __invoke(): \Inertia\Response
    {

        $user = auth()->user();

        $companies = $user->companies;

        return Inertia::render('Workspace/WorkspaceSelector', [
            'companies' => $companies,

        ]);
    }
}




