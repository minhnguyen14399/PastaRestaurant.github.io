<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'material_name','material_qty','material_unit','material_status',
    ];
    protected $primaryKey = 'material_id';
    protected $table = 'tbl_material';
}
