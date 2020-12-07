<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiAtpmUserRepository
{
    use WithWrsApi;

    public function all()
    {
        return Http::get($this->wrsApi.'/atpm-user/')->json();
    }

    public function getById($id)
    {
        return Http::get($this->wrsApi.'/atpm-user/get?id='.$id)->json();
    }

    public function login($username, $password)
    {
        return Http::post($this->wrsApi.'/atpm-user/login', [
            'username' => $username,
            'password' => $password
        ])->json();
    }

    public function getByIdDept($id)
    {
        return Http::get($this->wrsApi.'/atpm-user/get/fk_atpm_dept/'.$id)->json();
    }

    public function allWithPagination()
    {
        return Http::get($this->wrsApi.'/atpm-user/pagination/')->json();
    }
}