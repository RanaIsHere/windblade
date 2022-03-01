<?php

namespace App\Exports;

use App\Models\Packages;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PackagesExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithCustomValueBinder, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Packages::where('outlet_id', Auth::user()->outlet_id)->get();
    }

    public function registerEvents(): array
    {
        return [];
    }

    public function headings(): array
    {
        return [
            '#',
            'Outlet ID',
            'Package Type',
            'Package Name',
            'Package Price',
            'Created at',
            'Updated at'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->insertNewRowBefore(1, 2);
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Package Table');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:G3')->getFill()->applyFromArray(['fillType' => 'solid', 'rotation' => 0, 'color' => ['rgb' => '66CC8A']]);
        $sheet->getStyle('A3:G3')->getFont()->setBold(true);
        $sheet->getStyle('A3:G3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:G3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb', '000000']
                ]
            ]
        ]);

        $sheet->getStyle('A4:G' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb', '000000']
                ]
            ]
        ]);
    }
}
