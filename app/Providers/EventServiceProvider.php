<?php

namespace App\Providers;

use App\Events\Landlord\LeaseCreatedEvent;
use App\Events\PropertyCreated;
use App\Events\RentTransactionCreatedEvent;
use App\Listeners\GetMapImage;
use App\Listeners\Landlord\GenerateLeasePDFListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
//            SendEmailVerificationNotification::class,
        ],
        LeaseCreatedEvent::class => [
            GenerateLeasePDFListener::class
        ],
        RentTransactionCreatedEvent::class => [
            // TODO: generate receipt
            // TODO: send notif, etc
        ],
        PropertyCreated::class => [
            GetMapImage::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
