<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\RangeMonthFixOrderRepository;
use Illuminate\Support\Facades\Cache;
use App\Models\Cache as CacheModel;
use Illuminate\Http\Request;

class FixOrderAjaxController extends Controller
{
    public function rangeMonthFixOrder(
        Request $request,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository
    ) {
        $idUser = session()->get('user')['id_user'];
        $idMonth = $request->get('idMonth');
        $monthIdTo = $request->get('monthIdTo');
        $cache_name = 'fixOrder-ButtonRule-idUser-'.$idUser.'-idMonth-'.$idMonth;
        $data = Cache::remember($cache_name, 10, 
        function () use($rangeMonthFixOrderRepository, $idMonth, $monthIdTo, $idUser, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);

            return $rangeMonthFixOrderRepository->getByIdMonthAndMonthIdTo($idMonth, $monthIdTo);
        });

        return response()->json([
            'data' => $data
        ], 200);
    }
}