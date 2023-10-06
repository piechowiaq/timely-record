<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceDashboardController extends Controller
{
    public function __invoke(Company $company): Response
    {
        $query = DB::table('registries')
            ->join('company_registry', 'registries.id', '=', 'company_registry.registry_id')
            ->leftJoin('reports', function ($join) {
                $join->on('company_registry.registry_id', '=', 'reports.registry_id')
                    ->on('company_registry.company_id', '=', 'reports.company_id')
                    ->whereRaw('reports.expiry_date = (SELECT MAX(expiry_date) FROM reports WHERE reports.registry_id = company_registry.registry_id)');
            })
            ->where('company_registry.company_id', '=', $company->id)
            ->where('assigned', true)
            ->select('company_registry.registry_id', 'registries.name', DB::raw('MAX(reports.expiry_date) as expiry_date'), 'company_registry.company_id')
            ->groupBy('company_registry.registry_id', 'registries.name', 'company_registry.company_id');



        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Dashboard', [
            'company' => $company,
            'companiesCount' => $companiesCount,
            'registries' => $query->paginate(10)
                ->withQueryString(),
            'countOfUpToDateRegistries' => $query->whereNotNull('expiry_date')->where('expiry_date', '>', Carbon::now() )->get()->count()

        ]);

    }
}
