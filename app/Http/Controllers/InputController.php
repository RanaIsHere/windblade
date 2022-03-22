<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    /**
     * Returns a view to the user after processing the form on POST request, and inserting records by fields one by one, before saving it (inserting) in the database.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_package(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_id' => ['required'],
            'package_name' => ['required'],
            'package_type' => ['required'],
            'package_price' => ['required']
        ]);

        $package = new Packages;

        $package->outlet_id = $validatedData['outlet_id'];
        $package->package_name = $validatedData['package_name'];
        $package->package_type = $validatedData['package_type'];
        $package->package_price = $validatedData['package_price'];

        if ($package->save()) {
            return redirect()->back()->with('success', 'Package registered successfully.');
        } else {
            return redirect()->back()->with('success', 'Package failed to register.');
        }
    }

    /**
     * Returns a view to the user after processing the form on POST request, and inserting records by fields one by one, before saving it (inserting) in the database.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_outlet(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_name' => ['required'],
            'outlet_address' => ['required'],
            'outlet_phone' => ['required'],
            'status' => ['required']
        ]);

        $validatedData['outlet_phone'] = '62' . $validatedData['outlet_phone'];

        $outlet = new Outlets;

        $outlet->outlet_name = $validatedData['outlet_name'];
        $outlet->outlet_address = $validatedData['outlet_address'];
        $outlet->outlet_phone = $validatedData['outlet_phone'];
        $outlet->status = $validatedData['status'];

        if ($outlet->save()) {
            return redirect()->back()->with('success', 'Outlet registration complete.');
        } else {
            return -redirect()->back()->with('failure', 'Outlet registration failed.');
        }
    }

    /**
     * Returns a view to the user after processing the form on POST request, and inserting records by fields one by one, before saving it (inserting) in the database.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_customer(Request $request)
    {
        $validatedData = $request->validate([
            'member_name' => ['required'],
            'member_address' => ['required'],
            'member_phone' => ['required'],
            'member_gender' => ['required']
        ]);

        $validatedData['member_phone'] = '62' . $validatedData['member_phone'];

        $member = new Members;

        $member->member_name = $validatedData['member_name'];
        $member->member_address = $validatedData['member_address'];
        $member->member_phone = $validatedData['member_phone'];
        $member->member_gender = $validatedData['member_gender'];

        if ($member->save()) {
            return redirect()->back()->with('success', 'Member registration complete.');
        } else {
            return redirect()->back()->with('success', 'Member registration failed.');
        }
    }

    /**
     * Returns a view to the user after processing the form on POST request, and inserting records by fields one by one, before saving it (inserting) in the database.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_package(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => ['required'],
            'outlet_id' => ['required'],
            'package_name' => ['required'],
            'package_type' => ['required'],
            'package_price' => ['required']
        ]);

        $package = Packages::find($validatedData['package_id']);

        if ($package->outlet_id == $validatedData['outlet_id']) {
            $package->package_name = $validatedData['package_name'];
            $package->package_type = $validatedData['package_type'];
            $package->package_price = $validatedData['package_price'];

            if ($package->update()) {
                return redirect()->back()->with('success', 'Package edited successfully!');
            } else {
                return redirect()->back()->with('success', 'Package failed to edit.');
            }
        }
    }

    /**
     * Returns a view to the user after processing the form on POST request, and inserting records by fields one by one, before saving it (inserting) in the database.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_outlet(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_id' => ['required'],
            'outlet_name' => ['required'],
            'outlet_address' => ['required'],
            'outlet_phone' => ['required'],
            'status' => ['required']
        ]);

        $outlet = Outlets::find($validatedData['outlet_id']);

        $validatedData['outlet_phone'] = '62' . $validatedData['outlet_phone'];

        $outlet->outlet_name = $validatedData['outlet_name'];
        $outlet->outlet_address = $validatedData['outlet_address'];
        $outlet->outlet_phone = $validatedData['outlet_phone'];
        $outlet->status = $validatedData['status'];

        if ($outlet->save()) {
            return redirect()->back()->with('success', 'Outlet edited successfully.');
        } else {
            return redirect()->back()->with('success', 'Outlet failed to edit.');
        }
    }

    /**
     * Returns a view to the user after processing the form on POST request, and inserting records by fields one by one, before saving it (inserting) in the database.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_customer(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => ['required'],
            'member_name' => ['required'],
            'member_address' => ['required'],
            'member_phone' => ['required'],
            'member_gender' => ['required']
        ]);

        $member = Members::find($validatedData['member_id']);

        $validatedData['member_phone'] = '62' . $validatedData['member_phone'];

        $member->member_name = $validatedData['member_name'];
        $member->member_address = $validatedData['member_address'];
        $member->member_phone = $validatedData['member_phone'];
        $member->member_gender = $validatedData['member_gender'];

        if ($member->save()) {
            return redirect()->back()->with('success', 'Customer edited successfully.');
        } else {
            return redirect()->back()->with('failure', 'Customer failed to edit.');
        }
    }

    /**
     * Get a POST Request by AJAX to get customer data and return it as JSON.        
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_customer(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $memberData = Members::find($validatedData['id']);

            return response()->json(['response' => $memberData]);
        }
    }

    /**
     * Get a POST Request by AJAX to get package data, and outlet name and return it as JSON.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_package(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $pkgData = Packages::find($validatedData['id']);

            return response()->json(['response' => $pkgData, 'outlet_name' => $pkgData->outlets->outlet_name]);
        }
    }

    /**
     * Get a POST Request by AJAX to get outlet data, and outlet name and return it as JSON.        
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_outlet(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $utilData = Outlets::find($validatedData['id']);

            return response()->json(['response' => $utilData, 'outlet_name' => $utilData->outlet_name]);
        }
    }

    /**
     * Catch a POST Request to delete a specific item by model_type and id.
     * If statement will catch the right model_type, and delete accordingly to the model.
     * Then return a view back to the user.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete_item(Request $request)
    {
        $validatedData = $request->validate([
            'delete_id' => ['required'],
            'model_type' => ['required']
        ]);

        if ($validatedData['model_type'] == 'packages') {
            $package = Packages::find($validatedData['delete_id']);

            if ($package->delete()) {
                return redirect()->back()->with('success', 'Deleted successfully!');
            } else {
                return redirect()->back()->with('failure', 'Invalid deletion.');
            }
        } else if ($validatedData['model_type'] == 'outlets') {
            $outlet = Outlets::find($validatedData['delete_id']);
            $user = User::where('outlet_id', $outlet->id);
            $packages = Packages::where('outlet_id', $outlet->id);

            if ($outlet->delete()) {
                if ($user->delete()) {
                    if ($packages->delete()) {
                        return redirect()->route('page_login')->with('success', 'Deleted successfully!');
                    } else {
                        return redirect()->back()->with('failure', 'Invalid deletion.');
                    }
                }
            }
        } else if ($validatedData['model_type'] == 'members') {
            $member = Members::find($validatedData['delete_id']);

            if ($member->delete()) {
                return redirect()->back()->with('success', 'Deleted successfully!');
            } else {
                return redirect()->back()->with('failure', 'Invalid deletion.');
            }
        } else if ($validatedData['model_type'] == 'users') {
            $user = User::find($validatedData['delete_id']);
            $user_outlet = Outlets::find($user->outlet_id);
            $package_outlet = Packages::where('outlet_id', $user->outlet_id);

            if ($user->delete()) {
                if ($user->count() == 0) {
                    $user_outlet->delete();
                    $package_outlet->delete();
                }

                if ($user->roles == 'OWNER') {
                    User::where('outlet_id', Auth::user()->outlet_id)->delete();
                    $user_outlet->delete();
                    $package_outlet->delete();

                    return redirect('/')->with('success', 'Deleted successfully!');
                }

                return redirect()->back()->with('success', 'Deleted successfully!');
            } else {


                return redirect()->back()->with('failure', 'Invalid deletion.');
            }
        }
    }
}
