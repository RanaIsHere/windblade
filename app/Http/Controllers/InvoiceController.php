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
    public function fetch_invoice(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $invoice_transaction = Transactions::find($validatedData['id']);
            $transaction_dets = TransactionDetails::with('packages')->where('transaction_id', $invoice_transaction->id)->get();
            $invoice_details = TransactionDetails::find($validatedData['id']);
            $member_details = Members::find($invoice_transaction->id);
            $package_details = Packages::find($invoice_details->package_id);
            $outlet_details = Outlets::find(Auth::user()->outlet_id);

            return response()->json(['response' => [$invoice_details, $invoice_transaction, $member_details, $package_details, $outlet_details], 'lists' => $transaction_dets]);
        }
    }

    public function full_invoice($invoice_code)
    {
        $transaction = Transactions::where('invoice_code', $invoice_code)->first();
        $transaction_dets = TransactionDetails::with('packages')->where('transaction_id', $transaction->id)->get();

        return view('dashboard.invoice', ['page_name' => 'Invoice', 'transactionData' => $transaction, 'invoiceData' => $transaction_dets]);
    }
}
