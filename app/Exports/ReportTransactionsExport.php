<?php

namespace App\Exports;

use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportTransactionsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Return a collection of Transactions by specific select.
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transactions::where('outlet_id', Auth::user()->outlet_id)->get(['id', 'member_id', 'transaction_paid', 'transaction_date']);
    }

    /**
     * @deprecated
     * Register events
     * @return array
     */
    public function registerEvents(): array
    {
        return [];
    }

    /**
     * Return a headings to be put into the export
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Customer Name',
            'Customer Paid',
            'On Date'
        ];
    }

    /**
     * Format many specific columns and row of the export with specific styles
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->insertNewRowBefore(1, 2);
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', 'Transaction Table');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:D3')->getFill()->applyFromArray(['fillType' => 'solid', 'rotation' => 0, 'color' => ['rgb' => '66CC8A']]);
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);
        $sheet->getStyle('A3:D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:D3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb', '000000']
                ]
            ]
        ]);

        $sheet->getStyle('A4:D' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb', '000000']
                ]
            ]
        ]);
    }
}
