<?php

use App\Traits\WithWrsApi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateUsersTable extends Migration
{
    use WithWrsApi;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_user')) {
            Schema::create('tbl_user', function (Blueprint $table) {
                $table->string('id_user', 100)->unique()->primary();
                $table->string('username', 100);
                $table->string('password', 50)->default(md5('userwrs'));
                $table->string('nama_user', 150);
                $table->string('email', 150);
                $table->bigInteger('id_group');
                $table->integer('level_access')->default(4);
                $table->enum('status_atpm', ['atpm', 'dealer'])->default('dealer');
                $table->enum('status', ['0', '1'])->default(1);
                $table->timestamps();
            });
        }

        $this->insertAtpm();
        $this->insertDealer();
        $this->insertAdmin();
    }

    public function insertAtpm()
    {
        $data = Http::get($this->wrsApi.'/atpm-user');

        foreach($data['data'] as $atpm)
        {
            $checkDuplicate = User::firstWhere('id_user', $atpm['kd_atpm_user']);

            if(!$checkDuplicate) {
                User::create([
                    'id_user' => $atpm['kd_atpm_user'],
                    'nama_user' => $atpm['nm_atpm_user'],
                    'username' => $atpm['username'],
                    'email' => $atpm['email'],
                    'id_group' => 1,
                    'status_atpm' => 'atpm',
                ]);
            }
        }
    }

    public function insertDealer()
    {
        $data = Http::get($this->wrsApi.'/dealer-user');

        foreach($data['data'] as $dealer)
        {
            $checkDuplicate = User::firstWhere('id_user', $dealer['kd_dealer_user']);

            if(!$checkDuplicate) {
                User::create([
                    'id_user' => $dealer['kd_dealer_user'],
                    'nama_user' => $dealer['nm_dealer_user'],
                    'username' => $dealer['username'],
                    'email' => $dealer['email'],
                    'id_group' => 1,
                    'status_atpm' => 'dealer',
                ]);
            }
        }
    }

    public function insertAdmin()
    {
        User::create([
            'id_user' => '1',
            'nama_user' => 'Bernando Torrez',
            'username' => 'bernand.hermawan',
            'email' => 'Bernand.Dayamuntari@eurokars.co.id',
            'id_group' => 1,
            'status_atpm' => 'atpm',
            'level_access' => 1,
            'password' => md5('bernand.hermawan')
        ]);

        User::create([
            'id_user' => '2',
            'nama_user' => 'Dewi Purnamasari',
            'username' => 'dewi.purnamasari',
            'email' => 'Dewi.Purnamasari@eurokars.co.id',
            'id_group' => 1,
            'status_atpm' => 'atpm',
            'level_access' => 1,
            'password' => md5('dewi.purnamasari')
        ]);

        User::create([
            'id_user' => '3',
            'nama_user' => 'Brian Yunanda',
            'username' => 'brian.yunanda',
            'email' => 'Brian.Yunanda@eurokars.co.id',
            'id_group' => 1,
            'status_atpm' => 'atpm',
            'level_access' => 1,
            'password' => md5('brian.yunanda')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user');
    }
}
