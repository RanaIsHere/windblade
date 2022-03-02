<?php

namespace App\Imports;

use App\Models\Members;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MembersImport implements ToModel, WithStartRow
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
        return new Members([
            'member_name' => $row[1],
            'member_address' => $row[2],
            'member_phone' => $row[3],
            'member_gender' => $row[4]
        ]);
    }
}
