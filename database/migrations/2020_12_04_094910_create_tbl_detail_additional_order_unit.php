<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDetailAdditionalOrderUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_detail_additional_order_unit')) {
            Schema::create('tbl_detail_additional_order_unit', function (Blueprint $table) {
                $table->id('id_detail_additional_order_unit');
                $table->bigInteger('id_master_additional_order_unit');
                $table->bigInteger('id_model');
                $table->bigInteger('id_colour');
                $table->integer('qty');
                $table->string('year_production', 4);
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_detail_additional_order_unit');
    }
}
