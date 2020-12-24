<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTblSubChildMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_sub_child_menu')) {
            Schema::create('tbl_sub_child_menu', function (Blueprint $table) {
                $table->id('id_sub_child_menu');
                $table->bigInteger('id_child_menu');
                $table->bigInteger('id_parent_menu');
                $table->bigInteger('id_user_group');
                $table->integer('sub_child_position');
                $table->string('nama_sub_child_menu', 100);
                $table->text('url');
                $table->string('icon', 100);
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });
        }

        $this->insertData();
    }

    private function insertData()
    {
        DB::unprepared("INSERT IGNORE INTO `tbl_sub_child_menu` (`id_sub_child_menu`, `id_child_menu`, `id_parent_menu`, `id_user_group`, `sub_child_position`, `nama_sub_child_menu`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
        (1, 1, 1, 4, 1, 'Dealer', '#', '', '1', '2020-12-17 10:18:15', '2020-12-17 10:18:15'),
        (2, 2, 2, 5, 1, 'ATPM', '#', '', '1', '2020-12-21 05:09:16', '2020-12-21 05:09:16'),
        (3, 3, 3, 2, 1, 'ATPM', '#', '', '1', '2020-12-23 02:34:03', '2020-12-23 02:34:03');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sub_child_menu');
    }
}
