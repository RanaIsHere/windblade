<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'page_name' => 'Profile'
        ]);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            //     
        }
    }
}
