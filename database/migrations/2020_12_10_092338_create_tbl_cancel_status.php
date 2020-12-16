<?php

use App\Models\CancelStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCancelStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_cancel_status')) {
            Schema::create('tbl_cancel_status', function (Blueprint $table) {
                $table->id('id_cancel_status');
                $table->string('nama_cancel_status', 100);
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });

            $this->insertData();
        }

        
        
    }

    private function insertData()
    {
        CancelStatus::create(['nama_cancel_status' => 'Cancel Approval']);
        CancelStatus::create(['nama_cancel_status' => 'Cancel Submit ATPM']);
        CancelStatus::create(['nama_cancel_status' => 'Cancel Allocation']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cancel_status');
    }
}
