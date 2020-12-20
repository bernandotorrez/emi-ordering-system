<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\RangeMonthFixOrderRepository;
use Illuminate\Support\Facades\Cache;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Repository\Eloquent\MasterMonthOrderRepository;
use App\Repository\Eloquent\MonthExceptionRuleRepository;
use Illuminate\Http\Request;

class FixOrderAjaxController extends Controller
{
    public function rangeMonthFixOrder(
        Request $request,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository,
        MasterMonthOrderRepository $masterMonthOrderRepository,
        MasterFixOrderRepository $masterFixOrderRepository,
        MonthExceptionRuleRepository $monthExceptionRuleRepository
    ) {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $idMonth = $request->get('idMonth');
        $monthIdTo = $request->get('monthIdTo');
        $cache_name = 'fixOrder-ButtonRule-idUser-'.$idUser.'-idMonth-'.$idMonth;
        $data = Cache::remember($cache_name, 10, 
        function () use($rangeMonthFixOrderRepository, $idMonth, $monthIdTo, $idUser, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);

            return $rangeMonthFixOrderRepository->getByIdMonthAndMonthIdTo($idMonth, $monthIdTo);
        });

        $dataMonthExceptionRule = $monthExceptionRuleRepository->getByIdDealerAndIdMonth($idDealer, date('m'));
        
        if($dataMonthExceptionRule) {
            $dataLockDate = $dataMonthExceptionRule;
        } else {
            $dataLockDate = $masterMonthOrderRepository->getById(date('m'));
        }

        $checkBeforeOrAfter = eval("return ((string) date('Y-m-d') $dataLockDate->operator_start '$dataLockDate->date_input_lock_start')
                    && ((string) date('Y-m-d') $dataLockDate->operator_end '$dataLockDate->date_input_lock_end');");

        $where = array(
            'status' => '1',
            'id_dealer' => $idDealer,
            'id_month' => $monthIdTo
        );
        $countOrder = $masterFixOrderRepository->findDuplicate($where);

        return response()->json([
            'checkBeforeOrAfter' => $checkBeforeOrAfter,
            'countOrder' => $countOrder,
            'data' => $data
        ], 200);
    }
}