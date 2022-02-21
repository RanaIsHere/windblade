<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index()
    {
        $transactionData = Transactions::where('outlet_id', Auth::user()->outlet_id)->get();
        $memberData = Members::all();

        return view('reports.index', [
            'page_name' => 'Reports',
            'transactionData' => $transactionData,
            'memberData' => $memberData
        ]);
    }
}
