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

    /**
     * Which should the row start to pull in the import from the Excel?
     * @return int
     */
    public function startRow(): int
    {
        return 4;
    }

    /**
     * Return a model of Packages, which will be used to insert data into the database
     * @param array $row
     * @return array
     */
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
