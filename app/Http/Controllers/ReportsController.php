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
    /**
     * Return the view of the reports page with model data specified.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @deprecated
     * Sent by POST from AJAX request with message data and insert a new row with current user logged in to the site,
     * then return a response as JSON.
     */
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

    /**
     * Return the data of transactions by previous months as a response of JSON by a specific id.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function report_monthly(Request $request)
    {
        if ($request->ajax()) {
            $transaction_monthly = Transactions::where('outlet_id', Auth::user()->outlet_id)->whereMonth('created_at', '<=', date('m'))->with('TransactionDetails')->get();

            return response()->json([
                'transaction_monthly' => $transaction_monthly
            ]);
        }
    }

    /**
     * Return the data of transaction by transaction_deadline for scheduling and by specific id.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
