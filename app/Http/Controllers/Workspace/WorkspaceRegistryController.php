<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Registry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceRegistryController extends Controller
{
    public function index(Request $request, Company $company): Response
    {
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
            );



        if ($request->has('search')){
            $query->where('registries.name', 'like', '%' .$request->get('search') . '%');
        }

        if($request->has(['field', 'direction'])){

            $query->orderBy($request->get('field'), $request->get('direction'));
        }

        $companies = Auth::user()->companies()->pluck('company_id');

        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Registries/RegistryIndex', [
            'registries' => $query->paginate(10)
                ->withQueryString(),
            'filters'=> $request->all(['search', 'field', 'direction']),
            'company' => $company,
            'companies' => $companies,
            'companiesCount' => $companiesCount,
            'countOfUpToDateRegistries' => $query->paginate(10)
                ->withQueryString()->whereNotNull('expiry_date')->where('expiry_date', '>', Carbon::now() )->count(),
        ]);
    }

    public function show(Request $request, Company $company, Registry $registry)
    {
        $companies = Auth::user()->companies()->pluck('company_id');
        $companiesCount = Auth::user()->companies()->count();

        // Load the most current report with the associated created and updated users
        $mostCurrentReport = $registry->reports()
            ->with(['updatedByUser', 'createdByUser'])
            ->where('company_id', $company->id)
            ->latest('expiry_date')
            ->first();

        if ($mostCurrentReport) {
            $mostCurrentReport->load('updatedByUser', 'createdByUser');
            $mostCurrentReport->created_by_user_name = $mostCurrentReport->createdByUser->full_name ?? null;
            $mostCurrentReport->updated_by_user_name = $mostCurrentReport->updatedByUser->full_name ?? null;
        }

        // Load reports with the associated created and updated users
        $reports = $registry->reports()
            ->with(['updatedByUser', 'createdByUser'])
            ->where('company_id', $company->id)
            ->get()
            ->toArray();

        $historicalReports = array_filter($reports, function ($report) use ($mostCurrentReport) {
            return $report['id'] !== $mostCurrentReport->id;
        });

        array_walk($historicalReports, function (&$report) {
            $report['updated_by_user_name'] = $report['updated_by_user']['first_name'] ?? null;
            unset($report['updated_by_user']); // Remove the full user object
            $report['created_by_user_name'] = $report['created_by_user']['first_name'] ?? null;
            unset($report['created_by_user']); // Remove the full user object
        });

        if ($request->has(['field', 'direction'])) {
            $field = $request->get('field');
            $direction = $request->get('direction');

            usort($historicalReports, function ($a, $b) use ($field, $direction) {
                if ($direction === 'asc') {
                    return $a[$field] <=> $b[$field];
                } else {
                    return $b[$field] <=> $a[$field];
                }
            });
        }

        $historicalReports = array_values($historicalReports);

        return Inertia::render('Workspace/Registries/RegistryShow', [
            'company' => $company,
            'registry' => $registry,
            'filters' => $request->all(['field', 'direction']),
            'historicalReports' => $historicalReports,
            'companies' => $companies,
            'companiesCount' => $companiesCount,
            'mostCurrentReport' => $mostCurrentReport,
            'reports' => $reports
        ]);
    }


}
