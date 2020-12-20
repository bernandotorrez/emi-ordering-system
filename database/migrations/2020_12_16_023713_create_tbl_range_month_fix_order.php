<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTblRangeMonthFixOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_range_month_fix_order')) {
            Schema::create('tbl_range_month_fix_order', function (Blueprint $table) {
                $table->id('id_range_rule');
                $table->bigInteger('id_month');
                $table->string('month_id_to', 2);
                $table->tinyInteger('flag_open_colour');
                $table->tinyInteger('flag_open_volume');
                $table->tinyInteger('flag_button_add_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10');
                $table->tinyInteger('flag_button_amend_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10');
                $table->tinyInteger('flag_button_send_approval_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10');
                $table->tinyInteger('flag_button_revise_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10');
                $table->tinyInteger('flag_button_planning_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10'); 
                $table->tinyInteger('flag_button_submit_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10');
                $table->tinyInteger('flag_button_approve_before')->comment('Ini akan di ambil ketika tanggal kurang dari tanggal 10');
                $table->tinyInteger('flag_button_add_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10');
                $table->tinyInteger('flag_button_amend_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10');
                $table->tinyInteger('flag_button_send_approval_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10');
                $table->tinyInteger('flag_button_revise_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10');
                $table->tinyInteger('flag_button_planning_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10'); 
                $table->tinyInteger('flag_button_submit_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10');
                $table->tinyInteger('flag_button_approve_after')->comment('Ini akan di ambil ketika tanggal lebih dari tanggal 10');
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });

            $this->insertData();
        }
       
    }

    private function insertData()
    {
        DB::query(
            "INSERT IGNORE INTO `tbl_range_month_fix_order` (`id_range_rule`, `id_month`, `month_id_to`, `flag_open_colour`, `flag_open_volume`, `flag_button_add_before`, `flag_button_amend_before`, `flag_button_send_approval_before`, `flag_button_revise_before`, `flag_button_planning_before`, `flag_button_submit_before`, `flag_button_approve_before`, `flag_button_add_after`, `flag_button_amend_after`, `flag_button_send_approval_after`, `flag_button_revise_after`, `flag_button_planning_after`, `flag_button_submit_after`, `flag_button_approve_after`, `status`, `created_at`, `updated_at`) VALUES
            (1, 1, 3, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (2, 1, 4, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (3, 1, 5, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (4, 2, 4, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (5, 2, 5, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (6, 2, 6, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (7, 3, 5, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (8, 3, 6, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (9, 3, 7, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (10, 4, 6, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (11, 4, 7, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (12, 4, 8, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (13, 5, 7, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (14, 5, 8, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (15, 5, 9, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (16, 6, 8, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (17, 6, 9, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (18, 6, 10, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (19, 7, 9, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (20, 7, 10, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (21, 7, 11, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (22, 8, 10, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (23, 8, 11, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (24, 8, 12, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (25, 9, 11, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (26, 9, 12, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (27, 9, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (28, 10, 12, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (29, 10, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (30, 10, 2, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (31, 11, 1, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (32, 11, 2, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (33, 11, 3, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (34, 12, 2, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (35, 12, 3, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26'),
            (36, 12, 4, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '17-12-20 16:26', '17-12-20 16:26');"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_range_month_fix_order');
    }
}
