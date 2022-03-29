<?php

namespace App\Providers;

use App\Models\DataUsages;
use App\Models\Deliveries;
use App\Models\Items;
use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Models\User;
use App\Observers\DataUsageObserver;
use App\Observers\DeliveryObserver;
use App\Observers\ItemObserver;
use App\Observers\MemberObserver;
use App\Observers\OutletsObserver;
use App\Observers\PackageObserver;
use App\Observers\TransactionDetailsObserver;
use App\Observers\TransactionObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Members::observe(MemberObserver::class);
        Outlets::observe(OutletsObserver::class);
        Packages::observe(PackageObserver::class);
        Transactions::observe(TransactionObserver::class);
        TransactionDetails::observe(TransactionDetailsObserver::class);
        User::observe(UserObserver::class);
        Deliveries::observe(DeliveryObserver::class);
        Items::observe(ItemObserver::class);
        DataUsages::observe(DataUsageObserver::class);
    }
}
