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
                $table->id('id_master_additional_order_unit');
                $table->string('no_order_atpm', 7)->nullable();
                $table->string('no_order_dealer', 25);
                $table->dateTime('date_save_order')->nullable();
                $table->dateTime('date_send_approval')->nullable();
                $table->dateTime('date_approval')->nullable();
                $table->dateTime('date_revise')->nullable();
                $table->dateTime('date_submit_atpm_order')->nullable();
                $table->dateTime('date_cancel')->nullable();
                $table->dateTime('date_allocation_atpm')->nullable();
                $table->bigInteger('id_dealer');
                $table->bigInteger('id_user');
                $table->string('user_order', 50);
                $table->string('user_approval', 50)->nullable();
                $table->string('month_order', 25);
                $table->string('year_order', 4);
                $table->tinyInteger('flag_send_approval_dealer')->default(0);
                $table->tinyInteger('flag_approval_dealer')->default(0);
                $table->tinyInteger('flag_submit_to_atpm')->default(0);
                $table->tinyInteger('flag_allocation')->default(0);
                $table->bigInteger('id_cancel_status')->default(0);
                $table->text('remark_revise')->nullable();
                $table->text('remark_cancel')->nullable();
                $table->integer('total_qty')->default(0);
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
