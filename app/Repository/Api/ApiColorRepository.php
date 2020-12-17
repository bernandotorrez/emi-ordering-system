<?php

namespace App\Repository\Api;

use App\Traits\WithValidateToken;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiColorRepository
{
    use WithWrsApi;
    use WithValidateToken;

    public function all()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/color')
        ->json();

        return($this->validateToken($data));
    }

    public function getById($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/color/get/'.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function allWithPagination()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/color/pagination/')
        ->json();

        return($this->validateToken($data));
    }
}