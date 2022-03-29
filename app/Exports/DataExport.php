<?php

namespace App\Exports;

use App\Models\DataUsages;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DataUsages::all(['nama_barang', 'nama_pemakai', 'waktu_pakai', 'waktu_beres', 'status']);
    }

    public function headings(): array
    {
        return [
            'NAMA BARANG',
            'NAMA PEMAKAI',
            'WAKTU PAKAI',
            'WAKTU BERES',
            'STATUS'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->insertNewRowBefore(1, 2);
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Penggunaan Barang Table');
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
