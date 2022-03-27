<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Items;

class ItemObserver
{
    /**
     * Handle the Items "created" event.
     *
     * @param  \App\Models\Items  $items
     * @return void
     */
    public function created(Items $items)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'ITEMS'
        ]);
    }

    /**
     * Handle the Items "updated" event.
     *
     * @param  \App\Models\Items  $items
     * @return void
     */
    public function updated(Items $items)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'ITEMS'
        ]);
    }

    /**
     * Handle the Items "deleted" event.
     *
     * @param  \App\Models\Items  $items
     * @return void
     */
    public function deleted(Items $items)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'ITEMS'
        ]);
    }

    /**
     * Handle the Items "restored" event.
     *
     * @param  \App\Models\Items  $items
     * @return void
     */
    public function restored(Items $items)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'ITEMS'
        ]);
    }

    /**
     * Handle the Items "force deleted" event.
     *
     * @param  \App\Models\Items  $items
     * @return void
     */
    public function forceDeleted(Items $items)
    {
        Activity::create([
            'activity_type' => 'FORCE_DELETE',
            'model_type' => 'ITEMS'
        ]);
    }
}
