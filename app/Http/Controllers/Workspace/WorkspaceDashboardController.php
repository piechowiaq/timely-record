<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WorkspaceDashboardController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        $company =  Auth::user()->companies()->first();

        return Inertia::render('Workspace/Dashboard',

        ['company' => $company]);
    }
}
