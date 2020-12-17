<?php

namespace App\Repository\Api;

use App\Traits\WithValidateToken;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiModelColorRepository
{
    use WithWrsApi;
    use WithValidateToken;

    public function getByIdModel($id)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => session()->get('token')
        ])
        ->get($this->wrsApi.'/model-color/get/fk_model/'.$id)
        ->json();

        return($this->validateToken($data));
    }
}