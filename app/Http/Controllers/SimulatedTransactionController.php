<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulatedTransactionController extends Controller
{
    public function index()
    {
        return view('simulated_transaction.index', ['page_name' => 'Simulated Tranactions']);
    }
}
