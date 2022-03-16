<?php

namespace App\Http\Controllers;

use App\Exports\DeliveryExport;
use App\Imports\DeliveryImport;
use App\Models\Deliveries;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryController extends Controller
{
    // Function untuk mengembalikan view pada halaman browser user

    public function index()
    {
        $deliveryData = Deliveries::all();
        $memberData = Members::all();

        return view('delivery.index', [
            'page_name' => 'Delivery',
            'memberData' => $memberData,
            'deliveryData' => $deliveryData
        ]);
    }

    // Function untuk menyetor data yang terkirim oleh user ke database, dan mengembalikan notifikasi

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => ['required'],
            'carrier' => ['required'],
            'status' => ['required']
        ]);

        $delivery = new Deliveries;

        $delivery->member_id = $validatedData['member_id'];
        $delivery->carrier = $validatedData['carrier'];
        $delivery->status = $validatedData['status'];

        if ($delivery->save()) {
            return redirect()->back()->with('success', 'Delivery added!');
        } else {
            return redirect()->back()->with('failure', 'Delivery failed!');
        }
    }

    // Function untuk query data yang sudah di set dari AJAX, yaitu mencari suatu data.

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $delivery = Deliveries::find($validatedData['id']);

            return response()->json(['response' => $delivery]);
        }
    }

    // Function untuk menyetor data yang diganti, dan terkirim oleh user ke dalam database, dan mengembalikan notifikasi

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'delivery_id' => ['required'],
            'member_id' => ['required'],
            'carrier' => ['required'],
            'status' => ['required']
        ]);

        $delivery = Deliveries::find($validatedData['delivery_id']);

        $delivery->member_id = $validatedData['member_id'];
        $delivery->carrier = $validatedData['carrier'];
        $delivery->status = $validatedData['status'];

        if ($delivery->update()) {
            return redirect()->back()->with('success', 'Delivery edited!');
        } else {
            return redirect()->back()->with('failure', 'Delivery failed to edit!');
        }
    }

    // Function untuk menyetor data status yang diganti secara asynchronous oleh user ke dalam database.

    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required'],
                'status' => ['required']
            ]);

            $delivery = Deliveries::find($validatedData['id']);
            $delivery->status = $validatedData['status'];

            if ($delivery->update()) {
                return response()->json(['response' => $delivery]);
            }
        }
    }

    // Function untuk meng-delete data dengan id yang user sudah memilih di front-end.

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required']
        ]);

        $delivery = Deliveries::find($validatedData['id']);

        if ($delivery->delete()) {
            return redirect()->back()->with('success', 'Delivery deleted!');
        } else {
            return redirect()->back()->with('success', 'Delivery failed to delete itself!');
        }
    }

    // Export dan import yang memakai package LARAVEL EXCEL dan membuat suatu object dari Export/Import untuk dijalankan.

    public function exportData()
    {
        return Excel::download(new DeliveryExport, 'delivery.xlsx');
    }

    // Storage dipakai untuk menyetor file import tersebut ke dalam folder temporary di public, dan ngedelete sesudah di import.

    public function importData(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:csv,xlsx,xls']
        ]);

        $imported_file = $request->file('file');

        if ($imported_file != null) {
            $file_name = $imported_file->getClientOriginalName();
            $imported_file->move('import', $file_name);

            Excel::import(new DeliveryImport, public_path('import/' . $file_name));

            Storage::delete(public_path('import/' . $file_name));

            return redirect()->back()->with('success', 'Import successful!');
        }
    }
}
