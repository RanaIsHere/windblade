<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view_dashboard()
    {
        return view('dashboard.dashboard', ['page_name' => 'Dashboard']);
    }

    public function view_customers()
    {
        return view('dashboard.customer', ['page_name' => 'Customers']);
    }

    public function view_outlets()
    {
        return view('dashboard.outlet', ['page_name' => 'Outlets']);
    }

    public function view_packages()
    {
        return view('dashboard.package', ['page_name' => 'Packages']);
    }
}
