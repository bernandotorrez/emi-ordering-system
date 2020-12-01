<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubChildMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_sub_sub_child_menu')) {
            Schema::create('tbl_sub_sub_child_menu', function (Blueprint $table) {
                $table->id('id_sub_sub_child_menu');
                $table->bigInteger('id_sub_child_menu');
                $table->bigInteger('id_parent_menu');
                $table->integer('sub_sub_child_position');
                $table->string('nama_sub_sub_child_menu', 100);
                $table->text('url');
                $table->string('icon', 100);
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
        Schema::dropIfExists('tbl_sub_sub_child_menu');
    }
}
