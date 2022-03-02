<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
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
}
