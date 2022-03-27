<?php

namespace App\Exports;

use App\Models\Members;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    /**
     * Return a collection of Members by specific select.
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Members::all(['id', 'member_name', 'member_address', 'member_phone', 'member_gender']);
    }

    /**
     * Return a headings to be put into the export
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'NAME',
            'ADDRESS',
            'CONTACT',
            'GENDER'
        ];
    }

    /**
     * Format a specific column of the export
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER
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
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Customer Table');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:E3')->getFill()->applyFromArray(['fillType' => 'solid', 'rotation' => 0, 'color' => ['rgb' => '66CC8A']]);
        $sheet->getStyle('A3:E3')->getFont()->setBold(true);
        $sheet->getStyle('A3:E3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:E3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb', '000000']
                ]
            ]
        ]);

        $sheet->getStyle('A4:E' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb', '000000']
                ]
            ]
        ]);
    }
}
