<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Landlord\Document;
use App\Models\Landlord\Image;
use App\Models\Landlord\Lease;
use App\Models\Landlord\LeaseTemplate;
use App\Models\Landlord\Property;
use App\Models\Landlord\Tenant;
use App\Models\Landlord\Transaction;
use App\Policies\Landlord\DocumentPolicy;
use App\Policies\Landlord\ImagePolicy;
use App\Policies\Landlord\LeasePolicy;
use App\Policies\Landlord\LeaseTemplatePolicy;
use App\Policies\Landlord\PropertyPolicy;
use App\Policies\Landlord\TenantPolicy;
use App\Policies\Landlord\TransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Property::class => PropertyPolicy::class,
        Lease::class => LeasePolicy::class,
        LeaseTemplate::class => LeaseTemplatePolicy::class,
        Tenant::class => TenantPolicy::class,
        Transaction::class => TransactionPolicy::class,
        Document::class => DocumentPolicy::class,
        Image::class => ImagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
