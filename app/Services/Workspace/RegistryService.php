<?php

namespace App\Services\Workspace;

use App\Models\Registry;
use App\Repositories\Contracts\Workspace\RegistryRepositoryInterface;
use App\Models\Company;
use Illuminate\Http\Request;

class RegistryService
{
    protected RegistryRepositoryInterface $registryRepository;

    public function __construct(RegistryRepositoryInterface $registryRepository)
    {
        $this->registryRepository = $registryRepository;
    }

    public function getAllRegistriesQuery(Company $company): \Illuminate\Database\Query\Builder
    {
        return $this->registryRepository->getAllRegistriesQuery($company);
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

    public function applyFilters($query, Request $request): \Illuminate\Database\Query\Builder
    {
        if ($request->has('search')) {
            $query->where('registries.name', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->has(['field', 'direction'])) {
            $query->orderBy($request->get('field'), $request->get('direction'));
        }
        return $query;
    }
    public function getReports(Registry $registry, Company $company): array
    {
        return $registry->reports()
            ->with(['updatedByUser', 'createdByUser'])
            ->where('company_id', $company->id)
            ->get()
            ->toArray();
    }

    public function getMostCurrentReport(Registry $registry, Company $company): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null
    {
        return $registry->reports()
            ->with(['updatedByUser', 'createdByUser'])
            ->where('company_id', $company->id)
            ->latest('expiry_date')
            ->first();
    }

    public function getHistoricalReports(array $reports, $mostCurrentReport): array
    {
        return array_filter($reports, function ($report) use ($mostCurrentReport) {
            return $report['id'] !== $mostCurrentReport->id;
        });
    }

    public function sortHistoricalReports(array &$historicalReports, string $field, string $direction): array
    {
        usort($historicalReports, function ($a, $b) use ($field, $direction) {
            return $direction === 'asc' ? $a[$field] <=> $b[$field] : $b[$field] <=> $a[$field];
        });

        return array_values($historicalReports);
    }


}
