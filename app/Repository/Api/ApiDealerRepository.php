<?php

namespace App\Repository\Api;

use App\Traits\WithValidateToken;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiDealerRepository
{
    use WithWrsApi;
    use WithValidateToken;

    public function all()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/dealer')
        ->json();

        return($this->validateToken($data));
    }

    public function getById($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/dealer/get/'.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function allWithPagination()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/dealer/pagination/')
        ->json();

        return($this->validateToken($data));
    }
}