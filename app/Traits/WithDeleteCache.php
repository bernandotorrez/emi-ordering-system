<?php

namespace App\Traits;
use App\Models\Cache as CacheModel;
use Illuminate\Support\Facades\Cache;

trait WithDeleteCache
{
    private function deleteCache()
    {
        $dataCache = CacheModel::where('id_user', session()->get('user')['id_user'])->get();

        foreach($dataCache as $cache)
        {
            Cache::forget($cache->cache_name);
        }

        CacheModel::where('id_user', session()->get('user')['id_user'])->delete();
    }
}