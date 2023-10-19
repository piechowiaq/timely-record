<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Registry;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceDashboardController extends Controller
{
    public function __invoke(Company $company): Response
    {



        $registries = DB::table('registries')
            ->join('company_registry', 'registries.id', '=', 'company_registry.registry_id')
            ->leftJoin(DB::raw('(
        SELECT registry_id, company_id, MAX(expiry_date) as max_expiry_date
        FROM reports
        GROUP BY registry_id, company_id
    ) as max_reports'), function ($join) {
                $join->on('company_registry.registry_id', '=', 'max_reports.registry_id')
                    ->on('company_registry.company_id', '=', 'max_reports.company_id');
            })
            ->where('company_registry.company_id', '=', $company->id)
            ->where('assigned', true)
            ->whereNotNull('max_reports.max_expiry_date')
            ->where('max_reports.max_expiry_date', '<', Carbon::now()) // Only registries that have expired
            ->select(
                'company_registry.registry_id',
                'registries.name',
                'max_reports.max_expiry_date as expiry_date',
                'company_registry.company_id'
            )
            ->groupBy(
                'company_registry.registry_id',
                'registries.name',
                'company_registry.company_id',
                'max_reports.max_expiry_date'
            )
            ->orderBy('max_reports.max_expiry_date', 'asc') // Ordering by oldest expiry dates
            ->limit(3);


        $mostOutdatedRegistries = $registries->get()->map(function ($registry) {
            return [
                'name' => $registry->name,
                'expiry_date' => $registry->expiry_date
            ];
        })->all();

        $query = DB::table('registries')
            ->join('company_registry', 'registries.id', '=', 'company_registry.registry_id')
            ->leftJoin(DB::raw('(
        SELECT registry_id, company_id, MAX(expiry_date) as max_expiry_date
        FROM reports
        GROUP BY registry_id, company_id
    ) as max_reports'), function ($join) {
                $join->on('company_registry.registry_id', '=', 'max_reports.registry_id')
                    ->on('company_registry.company_id', '=', 'max_reports.company_id');
            })
            ->where('company_registry.company_id', '=', $company->id)
            ->where('assigned', true)
            ->whereNotNull('max_reports.max_expiry_date')
            ->where('max_reports.max_expiry_date', '>', Carbon::now()) // Only registries that haven't expired yet
            ->select(
                'company_registry.registry_id',
                'registries.name',
                'max_reports.max_expiry_date as expiry_date',
                'company_registry.company_id'
            )
            ->groupBy(
                'company_registry.registry_id',
                'registries.name',
                'company_registry.company_id',
                'max_reports.max_expiry_date'
            )
            ->orderBy('max_reports.max_expiry_date', 'desc') // Ordering by the most recent expiry dates
            ->limit(3);



// Pluck the names and expiry dates
        $recentlyUpdatedRegistries = $query->get()->map(function ($registry) {
            return [
                'name' => $registry->name,
                'expiry_date' => $registry->expiry_date
            ];
        })->all();








        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Dashboard', [
            'company' => $company,
            'companiesCount' => $companiesCount,
            'mostOutdatedRegistries' => $mostOutdatedRegistries,
            'recentlyUpdatedRegistries' => $recentlyUpdatedRegistries,
            'countOfUpToDateRegistries' => $registries->paginate(10)
                ->withQueryString()->whereNotNull('expiry_date')->where('expiry_date', '>', Carbon::now() )->count()

        ]);

    }
}
