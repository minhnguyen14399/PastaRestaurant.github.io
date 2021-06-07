<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialDetails extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id','material_id','material_name','material_details_qty','material_details_unit',
    ];
    protected $primaryKey = 'material_details_id';
    protected $table = 'tbl_material_details';
}
