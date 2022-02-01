<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Transactions;

class TransactionObserver
{
    /**
     * Handle the Transactions "created" event.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return void
     */
    public function created(Transactions $transactions)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'TRANSACTIONS'
        ]);
    }

    /**
     * Handle the Transactions "updated" event.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return void
     */
    public function updated(Transactions $transactions)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'TRANSACTIONS'
        ]);
    }

    /**
     * Handle the Transactions "deleted" event.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return void
     */
    public function deleted(Transactions $transactions)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'TRANSACTIONS'
        ]);
    }

    /**
     * Handle the Transactions "restored" event.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return void
     */
    public function restored(Transactions $transactions)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'TRANSACTIONS'
        ]);
    }

    /**
     * Handle the Transactions "force deleted" event.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return void
     */
    public function forceDeleted(Transactions $transactions)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'TRANSACTIONS'
        ]);
    }
}
