<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiDealerRepository
{
    use WithWrsApi;

    public function all()
    {
        return Http::get($this->wrsApi.'/dealer')->json();
    }

    public function getById($id)
    {
        return Http::get($this->wrsApi.'/dealer/get/'.$id)->json();
    }

    public function allWithPagination()
    {
        return Http::get($this->wrsApi.'/dealer/pagination/')->json();
    }
}