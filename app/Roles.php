<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'name',
    ];
    protected $primaryKey = 'roles_id';
    protected $table = 'tbl_roles';

    public function admin(){
        return $this->belongsToMany('App\Admin');
    }
}
