<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view_dashboard()
    {
        return view('dashboard.dashboard', ['page_name' => 'Dashboard']);
    }

    public function view_customers()
    {
        $customerData = Members::all();
        return view('dashboard.customer', ['page_name' => 'Customers', 'customerData' => $customerData]);
    }

    public function view_outlets()
    {
        $outletData = Outlets::all();
        return view('dashboard.outlet', ['page_name' => 'Outlets', 'outletData' => $outletData]);
    }

    public function view_packages()
    {
        $packageData = Packages::all();
        $outletData = Outlets::all();
        return view('dashboard.package', ['page_name' => 'Packages', 'packageData' => $packageData, 'outletData' => $outletData]);
    }

    public function view_users()
    {
        $userData = User::all();
        return view('dashboard.users', ['page_name' => 'Users', 'userData' => $userData]);
    }
}
