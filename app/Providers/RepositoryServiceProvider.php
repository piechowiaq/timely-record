<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\Workspace\RegistryRepositoryInterface;
use App\Repositories\Eloquent\Workspace\EloquentRegistryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RegistryRepositoryInterface::class, EloquentRegistryRepository::class);

        // ... other repository bindings ...
    }
}
