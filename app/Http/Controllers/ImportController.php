<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use App\Imports\PackagesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * Call a function by importMember by form on POST request, validate and process the file by moving the file into a temp folder and inserting a new row into the database,
     * then return the result of the import to the view.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importMembers(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:csv,xlsx,xls']
        ]);

        $imported_file = $request->file('file');

        if ($imported_file != null) {
            $file_name = $imported_file->getClientOriginalName();
            $imported_file->move('import', $file_name);

            Excel::import(new MembersImport, public_path('import/' . $file_name));

            Storage::delete(public_path('import/' . $file_name));

            return redirect()->back()->with('success', 'Import successful!');
        }
    }

    /**
     * Call a function by importPackages by form on POST request, validate and process the file by moving the file into a temp folder and inserting a new row into the database,
     * then return the result of the import to the view.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importPackages(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:csv,xlsx,xls']
        ]);

        $imported_file = $request->file('file');

        if ($imported_file != null) {
            $file_name = $imported_file->getClientOriginalName();
            $imported_file->move('import', $file_name);

            Excel::import(new PackagesImport, public_path('import/' . $file_name));

            Storage::delete(public_path('import/' . $file_name));

            return redirect()->back()->with('success', 'Import successful!');
        }
    }
}
