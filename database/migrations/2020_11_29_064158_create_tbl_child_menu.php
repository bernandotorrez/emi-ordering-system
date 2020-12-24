<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTblChildMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_child_menu')) {
            Schema::create('tbl_child_menu', function (Blueprint $table) {
                $table->id('id_child_menu');
                $table->bigInteger('id_parent_menu');
                $table->bigInteger('id_user_group');
                $table->integer('child_position');
                $table->string('nama_child_menu', 100);
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
        DB::unprepared("INSERT IGNORE INTO `tbl_child_menu` (`id_child_menu`, `id_parent_menu`, `id_user_group`, `child_position`, `nama_child_menu`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
        (1, 1, 4, 1, 'Sales Order', '#', '', '1', '2020-12-17 10:17:51', '2020-12-17 10:17:51'),
        (2, 2, 5, 1, 'Sales Order', '#', '', '1', '2020-12-21 05:09:02', '2020-12-21 05:09:02'),
        (3, 3, 2, 1, 'Sales Order', '#', '', '1', '2020-12-23 02:33:49', '2020-12-23 02:33:49');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_child_menu');
    }
}
