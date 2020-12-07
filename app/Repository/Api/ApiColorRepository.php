<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiColorRepository
{
    use WithWrsApi;

    public function all()
    {
        return Http::get($this->wrsApi.'/color')->json();
    }

    public function getById($id)
    {
        return Http::get($this->wrsApi.'/color/get/'.$id)->json();
    }

    public function allWithPagination()
    {
        return Http::get($this->wrsApi.'/color/pagination/')->json();
    }
}