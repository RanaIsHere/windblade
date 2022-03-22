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

    /**
     * Which should the row start to pull in the import from the Excel?
     * @return int
     */
    public function startRow(): int
    {
        return 4;
    }

    /**
     * Return a model of Members, which will be used to insert data into the database
     * @param array $row
     * @return array
     */
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
