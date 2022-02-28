<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventoryData = Inventory::all();

        return view('inventory.index', ['page_name' => 'Inventory', 'inventoryData' => $inventoryData]);
    }

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
