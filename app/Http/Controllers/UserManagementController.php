<?php

namespace App\Http\Controllers;

use App\Models\Outlets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function register_owner(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'outlet_name' => ['required'],
            'outlet_address' => ['required'],
            'outlet_phone' => ['required'],
            'admin_name' => ['required'],
            'admin_username' => ['required'],
            'admin_password' => ['required']
        ]);

        $owner_creation = false;
        $outlet_creation = false;
        $admin_creation = false;

        $user_owner = new User;

        $user_owner->name = $validatedData['name'];
        $user_owner->username = $validatedData['username'];
        $user_owner->password = Hash::make($validatedData['password']);
        $user_owner->roles = 'OWNER';

        $outlet = new Outlets;

        $validatedData['outlet_phone'] = '62' . $validatedData['outlet_phone'];

        $outlet->outlet_name = $validatedData['outlet_name'];
        $outlet->outlet_address = $validatedData['outlet_address'];
        $outlet->outlet_phone = $validatedData['outlet_phone'];
        $outlet->status = 'CLOSED';

        $user_admin = new User;

        $user_admin->name = $validatedData['admin_name'];
        $user_admin->username = $validatedData['admin_username'];
        $user_admin->password = Hash::make($validatedData['password']);


        if ($outlet->save()) {
            $outlet_creation = true;

            $user_owner->outlet_id = $outlet->id;
            $user_admin->outlet_id = $outlet->id;
        }

        if ($user_owner->save()) {
            $owner_creation = true;
        }

        if ($user_admin->save()) {
            $admin_creation = true;
        }

        if ($owner_creation == true && $outlet_creation == true && $admin_creation == true) {
            return redirect()->route('page_login')->with('success', 'Your outlet has been registered successfully!');
        } else {
            $outlet->delete();
            $user_admin->delete();
            $user_owner->delete();
        }
    }

    public function register_admin(Request $request)
    {
        //
    }

    public function register_user(Request $request)
    {
        //
    }
}
