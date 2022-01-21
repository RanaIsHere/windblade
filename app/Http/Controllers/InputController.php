<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function create_package(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_id' => ['required'],
            'package_name' => ['required'],
            'package_type' => ['required'],
            'package_price' => ['required']
        ]);

        dd($validatedData);
    }

    public function create_outlet(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_name' => ['required'],
            'outlet_address' => ['required'],
            'outlet_phone' => ['required'],
            'status' => ['required']
        ]);

        dd($validatedData);
    }

    public function create_customer(Request $request)
    {
        $validatedData = $request->validate([
            'member_name' => ['required'],
            'member_address' => ['required'],
            'member_phone' => ['required'],
            'member_gender' => ['required']
        ]);

        dd($validatedData);
    }
}
