<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Models\Company;
use App\Models\Registry;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WorkspaceRegistryReportController extends Controller
{
    public function create(Company $company, Registry $registry)
    {
        $companies = Auth::user()->companies()->pluck('company_id');

        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Registries/ReportCreate', [
            'company' => $company,
            'registry' => $registry,
            'companies' => $companies,
            'companiesCount' => $companiesCount,

        ]);
    }

    public function store(StoreReportRequest $request, Company $company, Registry $registry)
    {
        $report_date = new Carbon ($request->report_date);
        $expiryDate= $report_date->addMonths($registry->valid_for)->toDateString();


        $report = new Report();
        $report->report_date = $request->report_date;
        $report->expiry_date = $expiryDate;
        $report->notes = $request->notes;
        $report->company_id = $request->company_id;
        $report->registry_id = $request->registry_id;
        $report->save();

        return Redirect::route('workspace.registries.show', ['company' => $company, 'registry'=> $registry])->with('success', 'Report uploaded.');
    }
}
