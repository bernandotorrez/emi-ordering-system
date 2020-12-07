<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiModelColorRepository
{
    use WithWrsApi;

    public function getByIdModel($id)
    {
        return Http::get($this->wrsApi.'/model-color/get/fk_model/'.$id)->json();
    }
}