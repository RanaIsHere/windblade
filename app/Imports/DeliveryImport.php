<?php

namespace App\Imports;

use App\Models\Deliveries;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DeliveryImport implements ToModel, WithStartRow
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
     * Return a model of Deliveries, which will be used to insert data into the database
     * 
     * @param array $row
     * @return array
     */
    public function model(array $row)
    {
        return new Deliveries([
            'member_id' => $row[1],
            'carrier' => $row[2],
            'status' => $row[3],
        ]);
    }
}
