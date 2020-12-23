<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMonthExceptionRule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_month_exception_rule')) {
            Schema::create('tbl_month_exception_rule', function (Blueprint $table) {
                $table->id('id_rule_month');
                $table->bigInteger('id_month');
                $table->date('date_input_lock_month_start');
                $table->date('date_input_lock_month_end');
                $table->bigInteger('id_dealer');
                $table->tinyInteger('flag_open_colour');
                $table->tinyInteger('flag_open_volume');
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
        Schema::dropIfExists('tbl_month_exception_rule');
    }
}
