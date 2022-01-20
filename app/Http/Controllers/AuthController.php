<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('login.login', ['page_name' => 'Login']);
    }

    public function login(Request $request)
    {
        $auth_data = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($auth_data)) {
            $request->session()->regenerate();

            return redirect()->route('page_dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid data.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('page_login')->with('success', 'Logout successful!');;
    }
}
