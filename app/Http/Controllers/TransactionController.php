<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Packages;

class TransactionController extends Controller
{
    public function get_member(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $memberData = Members::find($validatedData['id']);

            return response()->json(['response' => $memberData]);
        }
    }

    public function get_package(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $packageData = Packages::find($validatedData['id']);

            return response()->json(['response' => $packageData]);
        }
    }

    public function start_transaction(Request $request)
    {
        $validatedData = $request->validate([
            'paid_today_with_card' => ['required'],
            'paid_today_with_cash' => ['required'],
            'transaction_price' => ['required'],
            'fee_price' => ['required'],
            'tax_price' => ['required'],
        ]);
    }
}
