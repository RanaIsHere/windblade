<?php

namespace App\Imports;

use App\Models\Items;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ItemImport implements ToModel, WithStartRow
{

    /**
     * Returns a model upon import into items and begin inserting a new row.
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Items([
            'item_name' => $row[1],
            'item_quantity' => $row[2],
            'item_price' => $row[3],
            'paydate' => $row[4],
            'item_supplier' => $row[5],
            'item_status' => $row[6],
        ]);
    }

    public function startRow(): int
    {
        return 4;
    }
}
