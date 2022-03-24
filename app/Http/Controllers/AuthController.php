<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /** 
     * A function that returns the view of a login page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_login()
    {
        return view('login.login', ['page_name' => 'Login']);
    }

    /** 
     * A function that returns the view of a regiser page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View 
     */
    public function view_register()
    {
        return view('login.register', ['page_name' => 'Register']);
    }

    /** A function called by the login request by POST and
     * set the current session logged into a specific user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $auth_data = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($auth_data, true)) {
            $request->session()->regenerate();

            return redirect()->route('page_dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid data.');
        }
    }

    /**
     * A function called by the logout request by GET to remove the current session and logout then regenerating the token
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('page_login')->with('success', 'Logout successful!');;
    }
}
