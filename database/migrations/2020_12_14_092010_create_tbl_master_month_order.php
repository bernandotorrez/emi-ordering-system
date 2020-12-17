<?php

use App\Models\MasterMonthOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterMonthOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_master_month_order')) {
            Schema::create('tbl_master_month_order', function (Blueprint $table) {
                $table->id('id_month');
                $table->string('month', 25);
                $table->date('date_input_lock_start')->nullable();
                $table->date('date_input_lock_end')->nullable();
                $table->string('operator_start', 5);
                $table->string('operator_end', 5);
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });

            $this->insertData();
        }
        
        
    }

    private function insertData()
    {
        $months = array(
            1 => 'January', 
            2 => 'February', 
            3 => 'March',
            4 => 'April', 
            5 => 'May', 
            6 => 'June', 
            7 => 'July', 
            8 => 'August', 
            9 => 'September', 
            10 => 'October',
            11 => 'November', 
            12 => 'December'
        );

        foreach($months as $key => $month) {
            $monthNumber = ($key < 10) ? $key : '0'.$key;
            MasterMonthOrder::create([
                'month' => $month,
                'date_input_lock_start' => date('Y').'-'.$monthNumber.'-01',
                'date_input_lock_end' => date('Y').'-'.$monthNumber.'-10',
                'operator_start' => '>=',
                'operator_end' => '<='
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_month_order');
    }
}
