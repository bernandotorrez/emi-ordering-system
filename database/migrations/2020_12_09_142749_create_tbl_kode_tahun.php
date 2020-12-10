<?php

use App\Models\KodeTahun;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKodeTahun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_kode_tahun')) {
            Schema::create('tbl_kode_tahun', function (Blueprint $table) {
                $table->id('id_kode_tahun');
                $table->string('tahun', 4);
                $table->string('kode', 2);
                $table->timestamps();
            });
        }
        
        $this->insertData();
    }

    private function insertData()
    {
        $alphabet = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U',
            'V', 'W', 'X', 'Y', 'Z'
        ];

        foreach($alphabet as $key => $alpha) {
            KodeTahun::create([
                'tahun' => 2020+$key,
                'kode' => $alphabet[$key]
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
        Schema::dropIfExists('tbl_kode_tahun');
    }
}
