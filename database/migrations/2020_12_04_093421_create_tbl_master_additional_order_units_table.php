<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterAdditionalOrderUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_master_additional_order_unit')) {
            Schema::create('tbl_master_additional_order_unit', function (Blueprint $table) {
                $table->id('id_additional_order_unit');
                $table->string('no_order_atpm', 7);
                $table->string('oreder_no_dealer', 10);
                $table->dateTime('date_save_order');
                $table->dateTime('date_send_approval');
                $table->dateTime('date_approval');
                $table->dateTime('date_submit_atpm_order');
                $table->dateTime('date_alocation_atpm');
                $table->bigInteger('id_dealer');
                $table->bigInteger('id_user');
                $table->string('user_order', 50);
                $table->string('user_approval', 50);
                $table->string('month_order', 25);
                $table->string('year_order', 4);
                $table->float('total_qty')->default(0);
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
        Schema::dropIfExists('tbl_master_additional_order_unit');
    }
}
