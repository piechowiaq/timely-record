<?php

namespace App\Http\Controllers\Workspace;

use App\Services\Workspace\RegistryService;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceDashboardController extends Controller
{
    private RegistryService $registryService;

    public function __construct(RegistryService $registryService)
    {
        $this->registryService = $registryService;
    }

    public function __invoke(Company $company): Response
    {
        $mostOutdatedRegistries = $this->registryService->getMostOutdatedRegistries($company, 3);
        $recentlyUpdatedRegistries = $this->registryService->getRecentlyUpdatedRegistries($company, 3);
        $percentageOfUpToDate = $this->registryService->getPercentageOfUpToDate($company);
        $countOfUpToDateRegistries = $this->registryService->countOfUpToDateRegistries($company);
        $countOfExpiredRegistries = $this->registryService->countOfExpiredRegistries($company);



        return Inertia::render('Workspace/Dashboard', [
            'company' => $company,
            'mostOutdatedRegistries' => $mostOutdatedRegistries,
            'recentlyUpdatedRegistries' => $recentlyUpdatedRegistries,
            'percentageOfUpToDate' => $percentageOfUpToDate,
            'countOfUpToDateRegistries' => $countOfUpToDateRegistries,
            'countOfExpiredRegistries' => $countOfExpiredRegistries
        ]);
    }

}
