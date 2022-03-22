<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\User;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /** 
     *A function to return a view on the dashboard file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_dashboard()
    {
        return view('dashboard.dashboard', ['page_name' => 'Dashboard']);
    }

    /**
     * A function to return a view on the customer file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_customers()
    {
        $customerData = Members::all();
        return view('dashboard.customer', ['page_name' => 'Customers', 'customerData' => $customerData]);
    }

    /**
     * A function to return a view on the outlet file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_outlets()
    {
        $outletData = Outlets::where('id', Auth::user()->outlet_id)->get();
        return view('dashboard.outlet', ['page_name' => 'Outlets', 'outletData' => $outletData]);
    }

    /**
     *  A function to return a view on the packages file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_packages()
    {
        $packageData = Packages::where('outlet_id', Auth::user()->outlet_id)->get();
        $outletData = Outlets::all();
        return view('dashboard.package', ['page_name' => 'Packages', 'packageData' => $packageData, 'outletData' => $outletData]);
    }

    /** 
     * A function to return a view on the transaction file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_transactions()
    {
        $transactionData = Transactions::where('outlet_id', Auth::user()->outlet_id)->get();
        $memberData = Members::all();
        $packageData = Packages::where('outlet_id', Auth::user()->outlet_id)->get();
        return view('dashboard.transactions', ['page_name' => 'Transactions', 'transactionData' => $transactionData, 'memberData' => $memberData, 'packageData' => $packageData]);
    }

    /**
     * A function to return a view on the invoice file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_invoices()
    {
        $transactionData = Transactions::where('outlet_id', Auth::user()->outlet_id)->get();
        $memberData = Members::all();
        return view('dashboard.invoices', ['page_name' => 'Invoices', 'transactionData' => $transactionData, 'memberData' => $memberData]);
    }


    /**
     * A function to return a view on the user file with a parameter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_users()
    {
        $userData = User::where('outlet_id', Auth::user()->outlet_id)->get();
        return view('dashboard.users', ['page_name' => 'Users', 'userData' => $userData]);
    }
}
