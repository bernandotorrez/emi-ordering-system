<?php

namespace App\Repository\Api;

use App\Traits\WithValidateToken;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiTypeModelRepository
{
    use WithWrsApi;
    use WithValidateToken;

    public function all()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/type-model/')
        ->json();

        return($this->validateToken($data));
    }

    public function getById($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/type-model/get?id='.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function getByIdModel($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/type-model/get/fk_model/'.$id)
        ->json();

        return($this->validateToken($data));
    }

    public function allWithPagination()
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/type-model/pagination/')
        ->json();

        return($this->validateToken($data));
    }
}