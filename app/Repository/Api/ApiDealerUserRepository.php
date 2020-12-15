<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiDealerUserRepository
{
    use WithWrsApi;

    public function all()
    {
        return Http::get($this->wrsApi.'/dealer-user/')->json();
    }

    public function getById($id)
    {
        return Http::get($this->wrsApi.'/dealer-user/get?id='.$id)->json();
    }

    public function login($username, $password)
    {
        return Http::post($this->wrsApi.'/dealer-user/login', [
            'username' => $username,
            'password' => $password
        ])->json();
    }

    public function getByIdDealer($id)
    {
        return Http::get($this->wrsApi.'/dealer-user/get/fk_dealer/'.$id)->json();
    }

    public function allWithPagination()
    {
        return Http::get($this->wrsApi.'/dealer-user/pagination/')->json();
    }
}