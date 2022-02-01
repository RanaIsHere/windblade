<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Packages;

class PackageObserver
{
    /**
     * Handle the Packages "created" event.
     *
     * @param  \App\Models\Packages  $packages
     * @return void
     */
    public function created(Packages $packages)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'PACKAGES'
        ]);
    }

    /**
     * Handle the Packages "updated" event.
     *
     * @param  \App\Models\Packages  $packages
     * @return void
     */
    public function updated(Packages $packages)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'PACKAGES'
        ]);
    }

    /**
     * Handle the Packages "deleted" event.
     *
     * @param  \App\Models\Packages  $packages
     * @return void
     */
    public function deleted(Packages $packages)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'PACKAGES'
        ]);
    }

    /**
     * Handle the Packages "restored" event.
     *
     * @param  \App\Models\Packages  $packages
     * @return void
     */
    public function restored(Packages $packages)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'PACKAGES'
        ]);
    }

    /**
     * Handle the Packages "force deleted" event.
     *
     * @param  \App\Models\Packages  $packages
     * @return void
     */
    public function forceDeleted(Packages $packages)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'PACKAGES'
        ]);
    }
}
