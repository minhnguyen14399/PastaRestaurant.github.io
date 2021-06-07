<?php

namespace App\Imports;

use App\Admin;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportsUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Admin([
            'admin_email' => $row[0],
            'admin_password' => $row[1],
            'admin_name' => $row[2],
            'admin_phone' => $row[4],
            'admin_role' => $row[5],
        ]);
    }
}
