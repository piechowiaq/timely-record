<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Registry;
use App\Services\Workspace\RegistryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceRegistryController extends Controller
{
    private RegistryService $registryService;

    public function __construct(RegistryService $registryService)
    {
        $this->registryService = $registryService;
    }

    public function index(Request $request, Company $company): Response
    {
        $registries = $this->registryService->getAllRegistriesQuery($company);
        $registries = $this->registryService->applyFilters($registries, $request);

        return Inertia::render('Workspace/Registries/RegistryIndex', [
            'registries' => $registries->paginate(10)
                ->withQueryString(),
            'filters' => $request->all(['search', 'field', 'direction']),
            'company' => $company,
        ]);
    }

    public function show(Request $request, Company $company, Registry $registry)
    {
        $mostCurrentReport = $this->registryService->getMostCurrentReport($registry, $company);
        $reports = $this->registryService->getReports($registry, $company);
        $historicalReports = $this->registryService->getHistoricalReports($reports, $mostCurrentReport);

        if ($request->has(['field', 'direction'])) {
            $field = $request->get('field');
            $direction = $request->get('direction');
            $historicalReports = $this->registryService->sortHistoricalReports($historicalReports, $field, $direction);
        }

        return Inertia::render('Workspace/Registries/RegistryShow', [
            'company' => $company,
            'registry' => $registry,
            'filters' => $request->all(['field', 'direction']),
            'historicalReports' => $historicalReports,
            'mostCurrentReport' => $mostCurrentReport,
            'reports' => $reports
        ]);
    }



}
