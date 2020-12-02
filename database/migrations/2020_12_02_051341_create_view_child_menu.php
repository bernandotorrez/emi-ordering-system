<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewChildMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    private function createView()
    {
        return '
            CREATE VIEW IF NOT EXISTS view_child_menu
            AS
            SELECT tcm.*, tpm.nama_parent_menu
            FROM tbl_child_menu tcm
            INNER JOIN tbl_parent_menu tpm ON tpm.id_parent_menu = tcm.id_parent_menu
            WHERE tcm.status = "1"
        ';
    }

    private function dropView()
    {
        return '
            DROP VIEW IF EXISTS view_child_menu;
        ';
    }
}
