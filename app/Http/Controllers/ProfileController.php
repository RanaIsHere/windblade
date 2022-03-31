<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'page_name' => 'Profile'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'file' => ['file', 'mimes:jpeg,png,jpg'],
            'biodata' => ['required', 'string', 'nullable']
        ]);

        $user = User::find(auth()->user()->id);

        if ($request->file('file') != null) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move('profiles', $fileName);
            $user->profile_picture = $fileName;
        }

        $user->biodata = $request->biodata;

        if ($user->update()) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('failure', 'Profile failed to edit!');
        }
    }
}
