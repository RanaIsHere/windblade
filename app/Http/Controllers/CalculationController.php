<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalculationController extends Controller
{
    /** 
     * Calculate the price of discount sent by AJAX POST from Transaction, if valid, 
     * calculate the total of discount and package price,
     * then return the total of discount and package price, and the value of tax divied by 2 of the total of discount and package price 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate_price(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required'],
                'discount' => ['required']
            ]);

            if ($validatedData['discount'] == 0 || $validatedData['discount'] == 10 || $validatedData['discount'] == 20 || $validatedData['discount'] == 30) {
                $total_price = 0;
                $tax_price = 0;
                $discount = intval($validatedData['discount']);
                $calculated_discount = 0;

                foreach ($validatedData['id'] as $data) {
                    $packageData = Packages::Find($data['id']);

                    if ($packageData->outlet_id != Auth::user()->outlet_id) {
                        return 'INVALID RESPONSE';
                    }

                    $total_price += intval($packageData->package_price) * $data['quantity'];
                    $calculated_discount = intval($total_price) * ($discount / 100);
                }

                $total_price = intval($total_price - $calculated_discount);
                $tax_price = $total_price * (2 / 100);

                return response()->json(['price' => $total_price, 'tax' => $tax_price]);
            }
        }
    }
}
