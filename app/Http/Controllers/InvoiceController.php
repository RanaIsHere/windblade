<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Return the data of invoices as a response of JSON by a specific id.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch_invoice(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $transaction = Transactions::find($validatedData['id']);
            $transaction_dets = TransactionDetails::with('packages')->where('transaction_id', $transaction->id)->get();

            return response()->json(['response' => [$transaction->transactionDetails, $transaction, $transaction->members, $transaction->transactionDetails->packages, $transaction->outlets], 'lists' => $transaction_dets]);
        }
    }

    /**
     * Return the view of invoice page with data of models specified by invoice_code and ids.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function full_invoice($invoice_code)
    {
        $transaction = Transactions::where('invoice_code', $invoice_code)->first();
        $transaction_dets = TransactionDetails::with('packages')->where('transaction_id', $transaction->id)->get();

        return view('dashboard.invoice', ['page_name' => 'Invoice', 'transactionData' => $transaction, 'invoiceData' => $transaction_dets]);
    }
}
