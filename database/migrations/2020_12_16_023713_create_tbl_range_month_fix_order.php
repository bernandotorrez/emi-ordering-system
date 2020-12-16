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
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });

            $this->insertData();
        }
       
    }

    private function insertData()
    {
        DB::query(
            "INSERT INTO tbl_range_month_fix_order VALUES ('1', '1', '3', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('2', '1', '4', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('3', '1', '5', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('4', '2', '4', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('5', '2', '5', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('6', '2', '6', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('7', '3', '5', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('8', '3', '6', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('9', '3', '7', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('10', '4', '6', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('11', '4', '7', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('12', '4', '8', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('13', '5', '7', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('14', '5', '8', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('15', '5', '9', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('16', '6', '8', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('17', '6', '9', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('18', '6', '10', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('19', '7', '9', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('20', '7', '10', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('21', '7', '11', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('22', '8', '10', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('23', '8', '11', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('24', '8', '12', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('25', '9', '11', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('26', '9', '12', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('27', '9', '1', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('28', '10', '12', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('29', '10', '1', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('30', '10', '2', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('31', '11', '1', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('32', '11', '2', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('33', '11', '3', '1', '1', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('34', '12', '2', '0', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('35', '12', '3', '1', '0', '1', NOW(), NOW());
            INSERT INTO tbl_range_month_fix_order VALUES ('36', '12', '4', '1', '1', '1', NOW(), NOW());"
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
