<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Members;
use App\Models\Requests;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index()
    {
        $transactionData = Transactions::where('outlet_id', Auth::user()->outlet_id)->with('TransactionDetails')->get();
        $chatData = Requests::all();
        $memberData = Members::all();
        $activityData = Activity::all();

        return view('reports.index', [
            'page_name' => 'Reports',
            'chatData' => $chatData,
            'transactionData' => $transactionData,
            'memberData' => $memberData,
            'activityData' => $activityData
        ]);
    }

    public function sendRequestMessage(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'message' => ['required']
            ]);

            $req = new Requests;

            $req->user_id = Auth::user()->id;
            $req->message = $validatedData['message'];

            if ($req->save()) {
                $user_id = $req->user_id;
                $user = User::where('id', $req->user_id)->first()->username;
                $message = $req;

                return response()->json([
                    'id' => $user_id,
                    'response' => $message,
                    'user' => $user
                ]);
            }
        }
    }

    public function report_monthly(Request $request)
    {
        if ($request->ajax()) {
            $transaction_monthly = Transactions::where('outlet_id', Auth::user()->outlet_id)->whereMonth('created_at', '=', date('m'))->with('TransactionDetails')->get();
            $transaction_previous_month = Transactions::where('outlet_id', Auth::user()->outlet_id)->whereMonth('created_at', '=', date('m') - 1)->with('TransactionDetails')->get();
            $transaction_previous_year = Transactions::where('outlet_id', Auth::user()->outlet_id)->whereYear('created_at', '=', date('Y') - 1)->with('TransactionDetails')->get();
            $transaction_yearly = Transactions::where('outlet_id', Auth::user()->outlet_id)->whereYear('created_at', '=', date('Y'))->with('TransactionDetails')->get();

            return response()->json([
                'transaction_monthly' => $transaction_monthly,
                'transaction_yearly' => $transaction_yearly,
                'transaction_previous_month' => $transaction_previous_month,
                'transaction_previous_year' => $transaction_previous_year
            ]);
        }
    }

    public function report_schedule(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            return response()->json(['date' => Transactions::find($validatedData['id'])->transaction_deadline]);
        }
    }
}
