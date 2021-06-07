<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblMaterialDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_material_details', function (Blueprint $table) {
            $table->Increments('material_details_id');
            $table->integer('product_id');
            $table->integer('material_id');
            $table->string('material_name');
            $table->integer('material_qty');
            $table->integer('material_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_material_details');
    }
}
