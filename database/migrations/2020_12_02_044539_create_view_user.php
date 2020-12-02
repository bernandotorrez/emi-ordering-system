<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewUser extends Migration
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
        DB::statement($this->createView());
    }

    private function createView()
    {
        return '
            CREATE VIEW IF NOT EXISTS view_user
            AS
            SELECT tu.*, tug.nama_group 
            FROM tbl_user tu
            INNER JOIN tbl_user_group tug ON tug.id_user_group = tu.id_user_group
            WHERE tu.status = "1";
        ';
    }

    private function dropView()
    {
        return '
            DROP VIEW IF EXISTS view_user;
        ';
    }
}
