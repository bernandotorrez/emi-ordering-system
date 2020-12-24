<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
                $table->bigInteger('id_user_group');
                $table->integer('parent_position');
                $table->string('nama_parent_menu', 100);
                $table->string('prefix', 100);
                $table->text('url');
                $table->string('icon', 100)->default('fas fa-bars');
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });
        }

        $this->insertData();
    }

    private function insertData()
    {
        DB::unprepared("INSERT IGNORE INTO `tbl_parent_menu` (`id_parent_menu`, `id_user_group`, `parent_position`, `nama_parent_menu`, `prefix`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
        (1, 4, 1, 'Sales', 'sales', '#', 'fas fa-car', '1', '2020-12-17 10:17:23', '2020-12-17 10:17:23'),
        (2, 5, 1, 'Sales', 'sales', '#', 'fas fa-car', '1', '2020-12-21 04:03:03', '2020-12-21 04:03:03'),
        (3, 2, 1, 'Sales', 'sales', '#', 'fas fa-car', '1', '2020-12-23 02:33:30', '2020-12-23 02:33:30');");
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
