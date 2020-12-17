<?php

namespace App\Repository\Api;

use App\Traits\WithValidateToken;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiAtpmUserRepository
{
    use WithWrsApi;
    use WithValidateToken;

    public function all()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/atpm-user/')
        ->json();

        return($this->validateToken($data));
    }

    public function getById($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/atpm-user/get?id='.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function login($username, $password)
    {
        return Http::post($this->wrsApi.'/atpm-user/login', [
            'username' => $username,
            'password' => $password
        ]);
    }

    public function getByIdDept($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/atpm-user/get/fk_atpm_dept/'.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function allWithPagination()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/atpm-user/pagination/')
        ->json();

        return($this->validateToken($data));
    }
}