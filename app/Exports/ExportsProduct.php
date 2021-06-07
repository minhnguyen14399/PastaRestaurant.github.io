<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportsProduct implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
    public function headings(): array {
        return [
            'category_id',
            'product_name',
            'product_quantity',
            'product_sold',
            'product_desc',
            'product_content',
            'product_price',
            'product_image',
            'product_status',
        ];
    }
    public function map($product): array {
        return [
            $product->category_id,
            $product->product_name,
            $product->product_quantity,
            $product->product_sold,
            $product->product_desc,
            $product->product_content,
            $product->product_price,
            $product->product_image,
            $product->product_status,
            
        ];

    }

}
