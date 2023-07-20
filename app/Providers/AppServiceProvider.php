<?php

namespace App\Providers;

use App\Services\LeaseService;
use App\Services\LeaseTemplateService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
