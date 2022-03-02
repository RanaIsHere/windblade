<?php

namespace App\Imports;

use App\Models\Packages;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PackagesImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 4;
    }

    public function model(array $row)
    {
        return new Packages([
            'outlet_id' => $row[1],
            'package_type' => $row[2],
            'package_name' => $row[3],
            'package_price' => $row[4],
        ]);
    }
}
