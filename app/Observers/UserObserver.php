<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'USER'
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'USER'
        ]);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'USER'
        ]);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'USER'
        ]);
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'USER'
        ]);
    }
}
