<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewMenuUserGroup extends Migration
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
            CREATE VIEW IF NOT EXISTS view_menu_user_group
            AS
            SELECT tmug.*, tug.nama_group, tpm.nama_parent_menu, tcm.nama_child_menu, 
            tscm.nama_sub_child_menu, tsscm.nama_sub_sub_child_menu,
            tpm.status AS status_parent, tcm.status AS status_child, tscm.status AS status_sub_child,
            tsscm.status AS status_sub_sub_child

            FROM tbl_menu_user_group tmug
            LEFT JOIN tbl_sub_sub_child_menu tsscm ON tsscm.id_sub_sub_child_menu = tmug.id_sub_sub_child_menu
            LEFT JOIN tbl_sub_child_menu tscm ON tscm.id_sub_child_menu = tmug.id_sub_child_menu
            LEFT JOIN tbl_child_menu tcm ON tcm.id_child_menu = tmug.id_child_menu
            INNER JOIN tbl_parent_menu tpm ON tpm.id_parent_menu = tmug.id_parent_menu
            INNER JOIN tbl_user_group tug ON tug.id_user_group = tmug.id_user_group
            WHERE tmug.status = "1" 
        ';
    }

    private function dropView()
    {
        return '
            DROP VIEW IF EXISTS view_menu_user_group;
        ';
    }
}
