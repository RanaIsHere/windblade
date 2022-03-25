<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Items::all();
        return view('items.index', [
            'page_name' => 'Items',
            'itemData' => $items
        ]);
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => 'required|numeric',
                'item_status' => 'required|string'
            ]);

            $item = Items::find($validatedData['id']);
            $item->item_status = $validatedData['item_status'];

            if ($item->update()) {
                return response()->json(['success' => 'Status changed successfully.']);
            }
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|max:100',
            'item_quantity' => 'required|integer',
            'item_price' => 'required|integer',
            'item_supplier' => 'required|max:100',
            'item_status' => 'required',
            'paydate' => 'required'
        ]);

        $item = Items::create($validatedData);

        if ($item) {
            return redirect()->back()->with('success', 'Item created successfully');
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => 'required|numeric'
            ]);

            $item = Items::find($validatedData['id']);

            return response()->json($item);
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'item_name' => 'required|max:100',
            'item_quantity' => 'required|integer',
            'item_price' => 'required|integer',
            'item_supplier' => 'required|max:100',
            'item_status' => 'required',
            'paydate' => 'required'
        ]);

        $item = Items::find($validatedData['id']);
        $item->item_name = $validatedData['item_name'];
        $item->item_quantity = $validatedData['item_quantity'];
        $item->item_price = $validatedData['item_price'];
        $item->item_supplier = $validatedData['item_supplier'];
        $item->item_status = $validatedData['item_status'];
        $item->paydate = $validatedData['paydate'];

        if ($item->update()) {
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => 'required'
            ]);

            $item = Items::find($validatedData['id']);

            return response()->json($item);
        }
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        $item = Items::find($validatedData['id']);

        if ($item->delete()) {
            return redirect()->back();
        }
    }
}
