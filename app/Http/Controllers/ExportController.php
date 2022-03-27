<?php

namespace App\Http\Controllers;

use App\Exports\MembersExport;
use App\Exports\PackagesExport;
use App\Exports\ReportTransactionsExport;
use App\Models\Members;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Return an Object calling a method by download, and create a new object by the PackagesExport with a file name set 
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportPackages()
    {
        return Excel::download(new PackagesExport, 'packages.xlsx');
    }

    /**
     * Return an Object calling a method by download, and create a new object by the MembersExport with a file name set
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportMembers()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    /**
     * Return an Object calling a method by download, and create a new object by the ReportTransactionsExport with a file name set 
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportReports()
    {
        return Excel::download(new ReportTransactionsExport, date('Y-m-d H:i:s') . '_transaction.xlsx');
    }
}
