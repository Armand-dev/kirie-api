<?php

namespace App\Providers;

use App\Services\Landlord\DocumentService;
use App\Services\Landlord\ImageService;
use App\Services\Landlord\LeaseService;
use App\Services\Landlord\LeaseTemplateService;
use App\Services\Landlord\PropertyService;
use App\Services\Landlord\TenantService;
use App\Services\Landlord\TransactionService;
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
        $this->app->singleton(TenantService::class, function() {
            return new TenantService();
        });
        $this->app->singleton(TransactionService::class, function() {
            return new TransactionService();
        });
        $this->app->singleton(DocumentService::class, function() {
            return new DocumentService();
        });
        $this->app->singleton(ImageService::class, function() {
            return new ImageService();
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
