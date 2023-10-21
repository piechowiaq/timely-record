<?php

namespace App\Repositories\Eloquent\Workspace;

use App\Models\Company;
use App\Repositories\Contracts\Workspace\RegistryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentRegistryRepository implements RegistryRepositoryInterface
{
    protected function baseRegistryQuery(Company $company): \Illuminate\Database\Query\Builder
    {
        return DB::table('registries')
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
    }

    public function getMostOutdatedRegistries(Company $company, int $limit): array
    {
        $registries = $this->baseRegistryQuery($company)
            ->whereNotNull('max_reports.max_expiry_date')
            ->where('max_reports.max_expiry_date', '<', Carbon::now())
            ->orderBy('max_reports.max_expiry_date', 'asc')
            ->limit($limit);

        return $registries->get()->map(function ($registry) {
            return [
                'name' => $registry->name,
                'expiry_date' => $registry->expiry_date
            ];
        })->all();
    }

    public function getRecentlyUpdatedRegistries(Company $company, int $limit): array
    {
        $query = $this->baseRegistryQuery($company)
            ->whereNotNull('max_reports.max_expiry_date')
            ->where('max_reports.max_expiry_date', '>', Carbon::now())
            ->orderBy('max_reports.max_expiry_date', 'desc')
            ->limit($limit);

        return $query->get()->map(function ($registry) {
            return [
                'name' => $registry->name,
                'expiry_date' => $registry->expiry_date
            ];
        })->all();
    }

    public function getUpToDateRegistries(Company $company): array
    {
        $results = $this->baseRegistryQuery($company)->get();
        return $results->where('expiry_date', '>', Carbon::now())->toArray();

    }
}
