<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait WithWrsApi
{

    public string $wrsApi;

    public function __construct()
    {
        $this->wrsApi = Config::get('constants.wrs_api');
    }
}