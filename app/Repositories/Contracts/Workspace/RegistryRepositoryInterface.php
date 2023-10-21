<?php

namespace App\Repositories\Contracts\Workspace;

use App\Models\Company;

interface RegistryRepositoryInterface
{
    public function getMostOutdatedRegistries(Company $company, int $limit): array;
    public function getRecentlyUpdatedRegistries(Company $company, int $limit): array;
    public function getUpToDateRegistries(Company $company);
}
