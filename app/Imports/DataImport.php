<?php

namespace App\Imports;

use App\Models\DataUsages;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new DataUsages([
            'nama_barang' => $row[0],
            'nama_pemakai' => $row[1],
            'waktu_pakai' => $row[2],
            'waktu_beres' => $row[3],
            'status' => $row[4]
        ]);
    }

    public function startRow(): int
    {
        return 4;
    }
}
