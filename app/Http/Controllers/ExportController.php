<?php

namespace App\Http\Controllers;

use App\Exports\PackagesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPackages()
    {
        return Excel::download(new PackagesExport, 'packages.xlsx');
    }
}
