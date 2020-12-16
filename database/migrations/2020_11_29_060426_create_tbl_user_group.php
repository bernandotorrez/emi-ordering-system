<?php

use App\Models\UserGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_user_group')) {
            Schema::create('tbl_user_group', function (Blueprint $table) {
                $table->id('id_user_group');
                $table->string('nama_group', 100);
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });

            $this->insertUserGroup();
        }

        
    }

    public function insertUserGroup()
    {
        UserGroup::create([
            'nama_group' => 'admin001',
        ]);
        UserGroup::create([
            'nama_group' => 'atpm001',
        ]);
        UserGroup::create([
            'nama_group' => 'dealer001',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user_group');
    }
}
