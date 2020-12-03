<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblParentMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_parent_menu')) {
            Schema::create('tbl_parent_menu', function (Blueprint $table) {
                $table->id('id_parent_menu');
                $table->integer('parent_position');
                $table->string('nama_parent_menu', 100);
                $table->string('prefix', 100);
                $table->text('url');
                $table->string('icon', 100)->default('fas fa-bars');
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
        Schema::dropIfExists('tbl_parent_menu');
    }
}
