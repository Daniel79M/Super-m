<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SaleInterface;
use App\Repositories\SaleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SaleInterface::class, SaleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
