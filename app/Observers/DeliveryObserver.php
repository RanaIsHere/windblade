<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Deliveries;

class DeliveryObserver
{
    /**
     * Handle the Deliveries "created" event.
     *
     * @param  \App\Models\Deliveries  $deliveries
     * @return void
     */
    public function created(Deliveries $deliveries)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'DELIVERIES'
        ]);
    }

    /**
     * Handle the Deliveries "updated" event.
     *
     * @param  \App\Models\Deliveries  $deliveries
     * @return void
     */
    public function updated(Deliveries $deliveries)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'DELIVERIES'
        ]);
    }

    /**
     * Handle the Deliveries "deleted" event.
     *
     * @param  \App\Models\Deliveries  $deliveries
     * @return void
     */
    public function deleted(Deliveries $deliveries)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'DELIVERIES'
        ]);
    }

    /**
     * Handle the Deliveries "restored" event.
     *
     * @param  \App\Models\Deliveries  $deliveries
     * @return void
     */
    public function restored(Deliveries $deliveries)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'DELIVERIES'
        ]);
    }

    /**
     * Handle the Deliveries "force deleted" event.
     *
     * @param  \App\Models\Deliveries  $deliveries
     * @return void
     */
    public function forceDeleted(Deliveries $deliveries)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'DELIVERIES'
        ]);
    }
}
