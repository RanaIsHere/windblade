<?php

namespace App\Http\Controllers;

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

        return view('reports.index', [
            'page_name' => 'Reports',
            'chatData' => $chatData,
            'transactionData' => $transactionData,
            'memberData' => $memberData
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
