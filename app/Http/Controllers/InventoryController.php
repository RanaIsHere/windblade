<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Return the view of the inventory page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $inventoryData = Inventory::all();

        return view('inventory.index', ['page_name' => 'Inventory', 'inventoryData' => $inventoryData]);
    }

    /**
     * Call a function by AJAX on POST request with id data and find an Inventory with said ID, then return a response as JSON
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $response = Inventory::find($validatedData['id']);

            return response()->json(['response' => $response]);
        }
    }

    /**
     * Call a function by form on POST request and validate the data, then immediately create (insert) a new row to Inventory table, then return a view to the user.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => ['required'],
            'product_brand' => ['required'],
            'quantity' => ['required'],
            'condition' => ['required'],
            'restock_date' => ['required'],
        ]);

        $create = Inventory::create($validatedData);

        if ($create) {
            return redirect()->back()->with('success', 'Inventory filled');
        }
    }

    /**
     * Call a function of update by form on POST request, validate the data, then update the row in Inventory table with the given ID, then return a view to the user.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_id' => ['required'],
            'product_name' => ['required'],
            'product_brand' => ['required'],
            'quantity' => ['required'],
            'condition' => ['required'],
            'restock_date' => ['required'],
        ]);

        $inventory = Inventory::find($validatedData['inventory_id']);

        $inventory->product_name = $validatedData['product_name'];
        $inventory->product_brand = $validatedData['product_brand'];
        $inventory->quantity = $validatedData['quantity'];
        $inventory->condition = $validatedData['condition'];
        $inventory->restock_date = $validatedData['restock_date'];

        if ($inventory->update()) {
            return redirect()->back()->with('success', 'Inventory updated');
        } else {
            return redirect()->back()->with('failure', 'Inventory failed ot update');
        }
    }

    /**
     * Call a function of delete by form on POST request, validate the data, then delete the row in Inventory table with the given ID, then return a view to the user.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_delete' => ['required']
        ]);

        $inventory = Inventory::find($validatedData['inventory_delete']);

        if ($inventory->delete()) {
            return redirect()->back()->with('success', 'Inventory deleted');
        } else {
            return redirect()->back()->with('failure', 'Inventory failed');
        }
    }
}
