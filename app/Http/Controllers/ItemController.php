<?php

namespace App\Http\Controllers;

use App\Exports\ItemExport;
use App\Imports\ItemImport;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    /**
     * Return a view to the user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = Items::all();
        return view('items.index', [
            'page_name' => 'Items',
            'itemData' => $items
        ]);
    }

    /**
     * On request from an AJAX, update the selected column and row then return a success to the user with JSON.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * On POST request from a form, validate the data received and create a new item, if successful, return with a success.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * On AJAX request upon opening an edit modal, receive a request with id parameter, validate, then return the data to the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * On POST request from an edit modal, validate the data received and update the item, if successful, return with a success.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * On AJAX request upon opening a delete modal, receive a request with id parameter, validate, then return the data to the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * On POST request from a delete modal, validate the data received and delete the item, if successful, return with a success.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * On GET request from an anchor in the blade, return a downloaded file in the form of xlsx format with the data from the database
     */
    public function export()
    {
        return Excel::download(new ItemExport, date('Y-m-d H:i:s') . '_items.xlsx');
    }

    /**
     * On POST request from a form in the import modal, validate the file data received, if exists, then get the file name,
     * and move it inside a folder within the public with the intended filename, then import the data from the file into the database.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xls,xlsx']
        ]);

        $file = $request->file('file');

        if ($file != null) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('import'), $fileName);

            Excel::import(new ItemImport, public_path('import/' . $fileName));

            Storage::delete('import/' . $fileName);

            return redirect()->back()->with('success', 'Items imported successfully');
        }
    }
}
