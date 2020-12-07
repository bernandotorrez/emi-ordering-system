<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewSubChildMenu extends Migration
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
            CREATE VIEW IF NOT EXISTS view_sub_child_menu
            AS
            SELECT tscm.*, tcm.nama_child_menu, tpm.nama_parent_menu, tug.nama_group
            FROM tbl_sub_child_menu tscm
            INNER JOIN tbl_child_menu tcm ON tcm.id_child_menu = tscm.id_child_menu
            INNER JOIN tbl_parent_menu tpm ON tpm.id_parent_menu = tscm.id_parent_menu
            INNER JOIN tbl_user_group tug ON tug.id_user_group = tscm.id_user_group
            WHERE tscm.status = "1"
        ';
    }

    private function dropView()
    {
        return '
            DROP VIEW IF EXISTS view_sub_child_menu
        ';
    }
}
