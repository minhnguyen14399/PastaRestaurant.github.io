<?php

namespace App\Exports;

use App\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportsUser implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::all();
    }
    public function headings(): array {
        return [
            'admin_email',
            'admin_password',
            'admin_name',
            'admin_phone',
            'admin_role',
        ];
    }
    public function map($admin): array {
        return [
            $admin->admin_email,
            $admin->admin_password,
            $admin->admin_name,
            $admin->admin_phone,
            $admin->admin_role,
        ];

    }

}
