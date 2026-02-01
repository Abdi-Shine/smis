<?php

namespace App\Imports;

use App\Models\employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Carbon;

class EmployeeImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new employee([
            'employee_id' => $row[0],
            'name'     => $row[1],
            'position' => $row[2],
            'gender' => $row[3],
            'start_date' => $row[4], // Assumes YYYY-MM-DD
            'end_date' => $row[5],   // Assumes YYYY-MM-DD
            'status' => $row[6],
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
