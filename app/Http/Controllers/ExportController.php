<?php

namespace App\Http\Controllers;

use App\Exports\PackagesExport;
use App\Exports\ReportTransactionsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPackages()
    {
        return Excel::download(new PackagesExport, 'packages.xlsx');
    }

    public function exportTransaction()
    {
        return Excel::download(new ReportTransactionsExport, 'transaction.xlsx');
    }
}
