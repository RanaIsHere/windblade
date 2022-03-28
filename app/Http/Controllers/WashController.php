<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WashController extends Controller
{
    public function index()
    {
        return view('transaction_wash.index', [
            'page_name' => 'Laundry Transactions'
        ]);
    }
}
