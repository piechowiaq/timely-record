<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkspaceDashboardController extends Controller
{
    public function __invoke(): \Inertia\Response
    {



        return Inertia::render('Workspace/Dashboard');

    }
}
