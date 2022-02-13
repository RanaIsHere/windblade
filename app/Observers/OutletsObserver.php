<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Outlets;

class OutletsObserver
{
    /**
     * Handle the Outlets "created" event.
     *
     * @param  \App\Models\Outlets  $outlets
     * @return void
     */
    public function created(Outlets $outlets)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'OUTLETS'
        ]);
    }

    /**
     * Handle the Outlets "updated" event.
     *
     * @param  \App\Models\Outlets  $outlets
     * @return void
     */
    public function updated(Outlets $outlets)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'OUTLETS'
        ]);
    }

    /**
     * Handle the Outlets "deleted" event.
     *
     * @param  \App\Models\Outlets  $outlets
     * @return void
     */
    public function deleted(Outlets $outlets)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'OUTLETS'
        ]);
    }

    /**
     * Handle the Outlets "restored" event.
     *
     * @param  \App\Models\Outlets  $outlets
     * @return void
     */
    public function restored(Outlets $outlets)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'OUTLETS'
        ]);
    }

    /**
     * Handle the Outlets "force deleted" event.
     *
     * @param  \App\Models\Outlets  $outlets
     * @return void
     */
    public function forceDeleted(Outlets $outlets)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'OUTLETS'
        ]);
    }
}
