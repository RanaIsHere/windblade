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

    public function startRow(): int
    {
        return 4;
    }


    public function model(array $row)
    {
        return new Deliveries([
            'member_id' => $row[1],
            'carrier' => $row[2],
            'status' => $row[3],
        ]);
    }
}
