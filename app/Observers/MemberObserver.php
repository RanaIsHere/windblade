<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Members;

class MemberObserver
{
    /**
     * Handle the Members "created" event.
     *
     * @param  \App\Models\Members  $members
     * @return void
     */
    public function created(Members $members)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'MEMBERS'
        ]);
    }

    /**
     * Handle the Members "updated" event.
     *
     * @param  \App\Models\Members  $members
     * @return void
     */
    public function updated(Members $members)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'MEMBERS'
        ]);
    }

    /**
     * Handle the Members "deleted" event.
     *
     * @param  \App\Models\Members  $members
     * @return void
     */
    public function deleted(Members $members)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'MEMBERS'
        ]);
    }

    /**
     * Handle the Members "restored" event.
     *
     * @param  \App\Models\Members  $members
     * @return void
     */
    public function restored(Members $members)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'MEMBERS'
        ]);
    }

    /**
     * Handle the Members "force deleted" event.
     *
     * @param  \App\Models\Members  $members
     * @return void
     */
    public function forceDeleted(Members $members)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'MEMBERS'
        ]);
    }
}
