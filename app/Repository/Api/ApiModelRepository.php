<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiModelRepository
{
    use WithWrsApi;

    public function all()
    {
        return Http::get($this->wrsApi.'/model')->json();
    }

    public function getById($id)
    {
        return Http::get($this->wrsApi.'/model/get/'.$id)->json();
    }

    public function allWithPagination()
    {
        return Http::get($this->wrsApi.'/model/pagination/')->json();
    }
}