<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\DataUsages;

class DataUsageObserver
{
    /**
     * Handle the DataUsages "created" event.
     *
     * @param  \App\Models\DataUsages  $dataUsages
     * @return void
     */
    public function created(DataUsages $dataUsages)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'DATA_USAGES'
        ]);
    }

    /**
     * Handle the DataUsages "updated" event.
     *
     * @param  \App\Models\DataUsages  $dataUsages
     * @return void
     */
    public function updated(DataUsages $dataUsages)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'DATA_USAGES'
        ]);
    }

    /**
     * Handle the DataUsages "deleted" event.
     *
     * @param  \App\Models\DataUsages  $dataUsages
     * @return void
     */
    public function deleted(DataUsages $dataUsages)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'DATA_USAGES'
        ]);
    }

    /**
     * Handle the DataUsages "restored" event.
     *
     * @param  \App\Models\DataUsages  $dataUsages
     * @return void
     */
    public function restored(DataUsages $dataUsages)
    {
        //
    }

    /**
     * Handle the DataUsages "force deleted" event.
     *
     * @param  \App\Models\DataUsages  $dataUsages
     * @return void
     */
    public function forceDeleted(DataUsages $dataUsages)
    {
        //
    }
}
