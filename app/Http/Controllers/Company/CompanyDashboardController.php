<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyDashboardController extends Controller
{
    public function __invoke()
    {

        $user = auth()->user();

        $company = $user->companies->first();

        return Inertia::render('Company/Dashboard', [
            'company' => $company,

        ]);

    }
}
