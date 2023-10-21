<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\Contracts\Workspace\RegistryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceDashboardController extends Controller
{
    private $registryRepository;

    public function __construct(RegistryRepositoryInterface $registryRepository)
    {
        $this->registryRepository = $registryRepository;
    }

    public function __invoke(Company $company): Response
    {
        $mostOutdatedRegistries = $this->registryRepository->getMostOutdatedRegistries($company, 3);
        $recentlyUpdatedRegistries = $this->registryRepository->getRecentlyUpdatedRegistries($company, 3);
        $countOfUpToDateRegistries = count($this->registryRepository->getUpToDateRegistries($company));
        $countOfExpiredRegistries = count($this->registryRepository->getExpiredRegistries($company));

        $totalRegistries = $countOfUpToDateRegistries + $countOfExpiredRegistries;

        $percentageOfUpToDate = round(($countOfUpToDateRegistries / $totalRegistries) * 100, 2);

        return Inertia::render('Workspace/Dashboard', [
            'company' => $company,
            'mostOutdatedRegistries' => $mostOutdatedRegistries,
            'recentlyUpdatedRegistries' => $recentlyUpdatedRegistries,
            'countOfUpToDateRegistries' => $countOfUpToDateRegistries,
            'countOfExpiredRegistries' => $countOfExpiredRegistries,
            'percentageOfUpToDate' => $percentageOfUpToDate
        ]);
    }
}
