<?php

namespace App\Providers;

use App\Repository\EmployeeRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DepartmentRepository;
use App\Contract\EmployeeRepositoryInterface;
use App\Contract\DepartmentRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
