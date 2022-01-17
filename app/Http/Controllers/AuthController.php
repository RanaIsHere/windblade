<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('login.login', ['page_name' => 'Login']);
    }
}
