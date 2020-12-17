<?php

namespace App\Repository\Api;

use App\Traits\WithValidateToken;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiModelRepository
{
    use WithWrsApi;
    use WithValidateToken;

    public function all()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/model')
        ->json();

        return($this->validateToken($data));
    }

    public function getById($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/model/get/'.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function allWithPagination()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/model/pagination/')
        ->json();

        return($this->validateToken($data));
    }
}