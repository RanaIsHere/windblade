<?php

namespace App\Exports;

use App\Models\Items;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Items::all(['id', 'item_name', 'item_quantity', 'item_price', 'paydate', 'item_supplier', 'item_status']);
    }

    public function headings(): array
    {
        return [
            '#',
            'NAME',
            'QUANTITY',
            'PRICE',
            'PAYDATE',
            'SUPPLIER',
            'STATUS'
        ];
    }

    /**
     * Format many columns and rows of the export with specific styles
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->insertNewRowBefore(1, 2);
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Customer Table');
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
