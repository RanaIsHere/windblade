<?php

namespace App\Http\Controllers;

use App\Exports\MembersExport;
use App\Exports\PackagesExport;
use App\Exports\ReportTransactionsExport;
use App\Models\Members;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;

class ExportController extends Controller
{
    public function exportPackages()
    {
        return Excel::download(new PackagesExport, 'packages.xlsx');
    }

    public function exportMembersCSV()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    public function exportMembersPDF()
    {
        //
    }

    public function exportTransaction()
    {
        return Excel::download(new ReportTransactionsExport, 'transaction.xlsx');
    }
}
