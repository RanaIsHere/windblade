<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function fetch_invoice(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $invoice_transaction = Transactions::find($validatedData['id']);
            $invoice_details = TransactionDetails::find($validatedData['id']);
            $member_details = Members::find($invoice_transaction->id);
            $package_details = Packages::find($invoice_details->package_id);

            return response()->json(['response' => [$invoice_details, $invoice_transaction, $member_details, $package_details]]);
        }
    }
}
