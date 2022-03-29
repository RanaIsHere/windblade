<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Imports\DataImport;
use App\Models\DataUsages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DataUsageController extends Controller
{
    /**
     * Return view as a page with DataUsages model data.
     */
    public function index()
    {
        return view('penggunaan_barang.index', [
            'page_name' => 'Data Usage',
            'usageData' => DataUsages::all()
        ]);
    }

    /**
     * Store data received through POST request, validate them, and then create a new row in DataUsages model.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => ['required'],
            'status' => ['required'],
            'nama_pemakai' => ['required'],
            'waktu_pakai' => ['required'],
            'waktu_beres' => ['required']
        ]);

        $data = DataUsages::create($validatedData);

        if ($data) {
            return redirect()->back()->with('success', 'Data successfully created!');
        }
    }

    /**
     * Get data by id through POST REQUEST, validate the id, then use a temporary variable to find the DataUsages by id.
     * Return the data by JSON as Response.
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $data = DataUsages::find($validatedData['id']);

            return response()->json($data);
        }
    }

    /**
     * Update data by id through POST REQUEST, validate data that has been inputted, if validated, find the DataUsage by ID.
     * Update the data, then return a message that data has been updated.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'nama_barang' => ['required'],
            'status' => ['required'],
            'nama_pemakai' => ['required'],
            'waktu_pakai' => ['required'],
            'waktu_beres' => ['required']
        ]);

        $data = DataUsages::find($validatedData['id']);
        $data->nama_barang = $validatedData['nama_barang'];
        $data->status = $validatedData['status'];
        $data->nama_pemakai = $validatedData['nama_pemakai'];
        $data->waktu_pakai = $validatedData['waktu_pakai'];
        $data->waktu_beres = $validatedData['waktu_beres'];

        if ($data->update()) {
            return redirect()->back()->with('success', 'Data is successfully updated!');
        }
    }

    /**
     * Get data by id through POST REQUEST, validate the id, then use a temporary variable to find the DataUsages by id.
     * Return the data by JSON as Response.
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required']
            ]);

            $data = DataUsages::find($validatedData['id']);

            return response()->json($data);
        }
    }

    /**
     * Delete data by id through POST request, validate the id, then use a temporary variable to find the DataUsages by id.
     * Delete the data, then return with a message.
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required']
        ]);

        $data = DataUsages::find($validatedData['id']);

        if ($data->delete()) {
            return redirect()->back()->with('success', 'Data is successfully deleted!');
        }
    }

    /**
     * Receive ID and STATUS and update the status of the data by finding the id of DataUsages, then return a success as JSON.
     */
    public function status(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'id' => ['required', 'numeric'],
                'status' => ['required', 'string']
            ]);

            $data = DataUsages::find($validatedData['id']);
            $data->status = $validatedData['status'];

            if ($data->update()) {
                return response()->json(['success' => 'Status changed successfully.']);
            }
        }
    }

    /**
     * Export data to Excel file with DataExport
     */
    public function export()
    {
        return Excel::download(new DataExport, date('Y-m-d H:i:S') . '_data_usage.xlsx');
    }

    /**
     * Import data from Excel to DataUsages model by receiving the request file, if file is not null, then get the file's original name
     * and then use the original name to store the file in storage, then use the file's path to import the data to DataUsages model.
     * If done, delete the file and return with a success message.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:csv,xlsx,xls']
        ]);

        $file = $request->file('file');

        if ($file != null) {
            $fileName = $file->getClientOriginalName();
            $file->move('import', $fileName);

            Excel::import(new DataImport, public_path('import/' . $fileName));

            Storage::delete(public_path('import/' . $fileName));

            return redirect()->back()->with('success', 'Import successful!');
        }
    }
}
