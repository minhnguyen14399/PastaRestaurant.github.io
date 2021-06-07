<?php

namespace App\Exports;

use App\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExports implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::all();
    }
    public function headings(): array {
        return [
            'category_id',
            'category_name',
            'category_desc',    
            'category_status',
        ];
    }
    public function map($category): array {
        return [
            $category->category_id,
            $category->category_name,
            $category->category_desc,
            $category->category_status,
        ];

    }

}
