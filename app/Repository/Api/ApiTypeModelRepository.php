<?php

namespace App\Repository\Api;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;

class ApiTypeModelRepository
{
    use WithWrsApi;

    public function all()
    {
        return Http::get($this->wrsApi.'/type-model/')->json();
    }

    public function getById($id)
    {
        return Http::get($this->wrsApi.'/type-model/get?id='.$id)->json();
    }

    public function getByIdModel($id)
    {
        return Http::get($this->wrsApi.'/type-model/get/fk_model/'.$id)->json();
    }

    public function allWithPagination()
    {
        return Http::get($this->wrsApi.'/type-model/pagination/')->json();
    }
}