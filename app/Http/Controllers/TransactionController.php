<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // dd($request->all());

        $validatedData = $request->validate([
            'paid_today_with_card' => ['required'],
            'paid_today_with_cash' => ['required'],
            'transaction_price' => ['required'],
            'fee_price' => ['required'],
            'tax_price' => ['required'],
            'outlet_id' => ['required'],
            'member_id' => ['required'],
            'notes' => ['required', 'nullable'],
            'deadline_time' => ['required'],
            'package_id' => ['required'],
            'package_quantity' => ['required'],
            'discount' => ['required']
        ]);

        if ($validatedData['outlet_id'] == Auth::user()->outlet_id) {
            if ($validatedData['transaction_price'] != 0) {
                /* 
                    Validation Section
                */

                $package = Packages::find($validatedData['package_id']);

                $isDiscountQualified = false;
                $isPriceQualified = false;
                $isTaxQualified = false;
                $isFeeQualified = false;
                $isTimeQualified = false;

                $calculated_price = $package->package_price * $validatedData['package_quantity'];
                $calculated_discount = $calculated_price * ($validatedData['discount'] / 100);

                $calculated_price = $calculated_price - $calculated_discount;
                $calculated_tax = $calculated_price * (2 / 100);

                if ($validatedData['discount'] <= 30) {
                    $isDiscountQualified = true;
                }

                if ($validatedData['transaction_price'] == $calculated_price) {
                    $isPriceQualified = true;
                }

                if ($validatedData['tax_price'] == $calculated_tax) {
                    $isTaxQualified = true;
                }

                if ($validatedData['notes'] == "NONE") {
                    if ($validatedData['fee_price'] == 0) {
                        $isFeeQualified = true;
                    }
                } else {
                    if ($validatedData['fee_price'] == 5000) {
                        $isFeeQualified = true;
                    }
                }

                if ($validatedData['deadline_time'] > now()->toDateString()) {
                    $isTimeQualified = true;
                }

                if ($isDiscountQualified && $isPriceQualified && $isTaxQualified && $isFeeQualified && $isTimeQualified) {
                    $transaction = new Transactions;

                    $transaction->outlet_id = $validatedData['outlet_id'];
                    $transaction->member_id = $validatedData['member_id'];
                    $transaction->user_id = Auth::user()->id;
                    $transaction->transaction_date = now()->toDateTimeString();
                    $transaction->transaction_deadline = $validatedData['deadline_time'];

                    if ($validatedData['paid_today_with_card'] == 1 || $validatedData['paid_today_with_cash'] == 1) {
                        $transaction->transaction_paydate = now()->toDateString();
                        $transaction->paid_status = 'PAID';
                    } else {
                        $transaction->transaction_paydate = $validatedData['deadline_time'];
                        $transaction->paid_status = 'UNPAID';
                    }

                    $transaction->transaction_paid = $validatedData['transaction_price'];
                    $transaction->transaction_paid_extra = $validatedData['fee_price'];
                    $transaction->transaction_tax = $validatedData['tax_price'];
                    $transaction->transaction_discount = $validatedData['discount'];
                    $transaction->status = 'NEW';

                    $transaction->invoice_code = 'NULL';

                    if ($transaction->save()) {
                        $day = now()->day;
                        $month = now()->month;

                        $id  = $transaction->id;
                        $mid = $transaction->member_id;
                        $uid = $transaction->user_id;
                        $oud = $transaction->outlet_id;

                        $transaction->invoice_code = $day . $month . $mid . $uid . $oud . $id;

                        if ($transaction->update()) {
                            $transaction_details = new TransactionDetails;

                            $transaction_details->transaction_id = $transaction->id;
                            $transaction_details->package_id = $validatedData['package_id'];
                            $transaction_details->quantity = $validatedData['package_quantity'];
                            $transaction_details->notes = $validatedData['notes'];

                            if ($transaction_details->save()) {
                                return redirect()->back()->with('success', 'Transaction successful! Invoice has been saved.');
                            } else {
                                $transaction->delete();

                                return redirect()->back()->with('failure', 'Transaction has failed to save.');
                            }
                        } else {
                            $transaction->delete();
                        }
                    }

                    return redirect()->back()->with('failure', 'Transaction has failed to save.');
                }
            }
        }

        return redirect()->back()->with('Invalid price origin');
    }
}
