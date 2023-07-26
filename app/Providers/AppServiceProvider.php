<?php

namespace App\Providers;

use App\Services\Landlord\LeaseService;
use App\Services\Landlord\LeaseTemplateService;
use App\Services\Landlord\PropertyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LeaseService::class, function() {
            return new LeaseService();
        });
        $this->app->singleton(LeaseTemplateService::class, function() {
            return new LeaseTemplateService();
        });
        $this->app->singleton(PropertyService::class, function() {
            return new PropertyService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
