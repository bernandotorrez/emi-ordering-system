<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
                $table->bigInteger('id_child_menu');
                $table->bigInteger('id_parent_menu');
                $table->bigInteger('id_user_group');
                $table->integer('sub_sub_child_position');
                $table->string('nama_sub_sub_child_menu', 100);
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
        DB::unprepared("INSERT IGNORE INTO `tbl_sub_sub_child_menu` (`id_sub_sub_child_menu`, `id_sub_child_menu`, `id_child_menu`, `id_parent_menu`, `id_user_group`, `sub_sub_child_position`, `nama_sub_sub_child_menu`, `url`, `icon`, `status`, `created_at`, `updated_at`) VALUES
        (1, 1, 1, 1, 4, 1, 'Additional Order', 'sales/dealer/additional-order', '', '1', '2020-12-17 10:18:43', '2020-12-17 10:18:43'),
        (2, 1, 1, 1, 4, 1, 'Fix Order', 'sales/dealer/fix-order', '', '1', '2020-12-17 10:19:04', '2020-12-17 10:19:04'),
        (3, 2, 2, 2, 5, 1, 'Approval BM Fix Order', 'sales/dealer/fix-order-bm', '', '1', '2020-12-21 05:09:50', '2020-12-21 05:09:50'),
        (4, 2, 2, 2, 5, 2, 'Approval BM', 'sales/dealer/approval-bm', '', '1', '2020-12-21 08:48:34', '2020-12-21 08:48:34'),
        (5, 2, 2, 2, 5, 3, 'Approved BM', 'sales/dealer/approved-bm', '', '1', '2020-12-21 08:48:51', '2020-12-21 08:48:51'),
        (6, 3, 3, 3, 2, 1, 'Allocated Additional Order', 'sales/atpm/submit-atpm', '', '1', '2020-12-23 02:35:13', '2020-12-23 02:35:13'),
        (7, 3, 3, 3, 2, 2, 'Allocated Fix Order', 'sales/atpm/fix-order-atpm', '', '1', '2020-12-23 02:35:53', '2020-12-23 02:35:53');");
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
