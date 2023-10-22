<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
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
        return Inertia::render('Workspace/Registries/ReportCreate', [
            'company' => $company,
            'registry' => $registry,
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

    public function edit(Company $company, Registry $registry, Report $report)
    {
        return Inertia::render('Workspace/Registries/ReportEdit', [
            'report' => $report,
            'company' => $company,
            'registry' => $registry,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Company $company, Registry $registry, Report $report )
    {
        $report_date = new Carbon ($request->report_date);
        $expiryDate= $report_date->addMonths($registry->valid_for)->toDateString();

        $report->report_date = $request->report_date;
        $report->expiry_date = $expiryDate;
        $report->notes = $request->notes;
        $report->company_id = $request->company_id;
        $report->registry_id = $request->registry_id;
        $report->save();


        return Redirect::route('workspace.registries.show', ['company' => $company, 'registry'=> $registry])->with('success', 'Report updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Registry $registry, Report $report)
    {
        $report->delete();

        return Redirect::route('workspace.registries.show', ['company' => $company, 'registry'=> $registry])->with('success', 'Report deleted.');
    }

    public function restore(Report $report, Registry $registry, Company $company)
    {
        $report->restore();

        return Redirect::route('workspace.registries.show', ['company' => $company, 'registry'=> $registry])->with('success', 'Report restored.');
    }
}
