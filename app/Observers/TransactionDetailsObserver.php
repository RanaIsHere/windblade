<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\TransactionDetails;

class TransactionDetailsObserver
{
    /**
     * Handle the TransactionDetails "created" event.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return void
     */
    public function created(TransactionDetails $transactionDetails)
    {
        Activity::create([
            'activity_type' => 'CREATE',
            'model_type' => 'TRANSACTION_DETAILS'
        ]);
    }

    /**
     * Handle the TransactionDetails "updated" event.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return void
     */
    public function updated(TransactionDetails $transactionDetails)
    {
        Activity::create([
            'activity_type' => 'UPDATE',
            'model_type' => 'TRANSACTION_DETAILS'
        ]);
    }

    /**
     * Handle the TransactionDetails "deleted" event.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return void
     */
    public function deleted(TransactionDetails $transactionDetails)
    {
        Activity::create([
            'activity_type' => 'DELETE',
            'model_type' => 'TRANSACTION_DETAILS'
        ]);
    }

    /**
     * Handle the TransactionDetails "restored" event.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return void
     */
    public function restored(TransactionDetails $transactionDetails)
    {
        Activity::create([
            'activity_type' => 'RESTORED',
            'model_type' => 'TRANSACTION_DETAILS'
        ]);
    }

    /**
     * Handle the TransactionDetails "force deleted" event.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return void
     */
    public function forceDeleted(TransactionDetails $transactionDetails)
    {
        Activity::create([
            'activity_type' => 'fDELETE',
            'model_type' => 'TRANSACTION_DETAILS'
        ]);
    }
}
