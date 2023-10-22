<?php

namespace App\Services\Workspace;

use App\Repositories\Contracts\Workspace\RegistryRepositoryInterface;
use App\Models\Company;

class RegistryService
{
    protected RegistryRepositoryInterface $registryRepository;

    public function __construct(RegistryRepositoryInterface $registryRepository)
    {
        $this->registryRepository = $registryRepository;
    }

    public function getMostOutdatedRegistries(Company $company, int $limit): array
    {
        return $this->registryRepository->getMostOutdatedRegistries($company, $limit);
    }

    public function getRecentlyUpdatedRegistries(Company $company, int $limit): array
    {
        return $this->registryRepository->getRecentlyUpdatedRegistries($company, $limit);
    }

    public function getExpiringSoonRegistries(Company $company, int $limit): array
    {
        return $this->registryRepository->getExpiringSoonRegistries($company, $limit);
    }

    public function getPercentageOfUpToDate(Company $company): float
    {
        $countOfUpToDateRegistries = count($this->registryRepository->getUpToDateRegistries($company));
        $countOfExpiredRegistries = count($this->registryRepository->getExpiredRegistries($company));

        $totalRegistries = $countOfUpToDateRegistries + $countOfExpiredRegistries;

        if ($totalRegistries == 0) {
            return 0.0; // or any other default value you'd like to return when there's no registry
        }

        return round(($countOfUpToDateRegistries / $totalRegistries) * 100);
    }


    public function countOfUpToDateRegistries(Company $company): int
    {
         return $this->registryRepository->countOfUpToDateRegistries($company);
    }

    public function countOfExpiredRegistries(Company $company): int
    {
        return $this->registryRepository->countOfExpiredRegistries($company);
    }
}
