<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMenuUserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_menu_user_group')) {
            Schema::create('tbl_menu_user_group', function (Blueprint $table) {
                $table->id('id_menu_user_group');
                $table->bigInteger('id_user_group');
                $table->bigInteger('id_parent_menu');
                $table->bigInteger('id_child_menu');
                $table->bigInteger('id_sub_child_menu');
                $table->enum('can_view', ['0', '1']);
                $table->enum('can_add', ['0', '1']);
                $table->enum('can_edit', ['0', '1']);
                $table->enum('can_delete', ['0', '1']);
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
        Schema::dropIfExists('tbl_menu_user_group');
    }
}
