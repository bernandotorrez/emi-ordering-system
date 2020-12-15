<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewParentMenu extends Migration
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
            CREATE VIEW IF NOT EXISTS view_parent_menu
            AS
            SELECT tpm.*, tug.nama_group
            FROM tbl_parent_menu tpm
            INNER JOIN tbl_user_group tug ON tug.id_user_group = tpm.id_user_group
            WHERE tpm.status = "1"
        ';
    }

    private function dropView()
    {
        return '
            DROP VIEW IF EXISTS view_parent_menu
        ';
    }
}
