<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Repository\Eloquent\MasterMonthOrderRepository;
use App\Repository\Eloquent\MonthExceptionRuleRepository;
use App\Repository\Eloquent\RangeMonthFixOrderRepository;
use Livewire\Component;

class FixOrderPrinciple extends Component
{
    public function render(
        MasterMonthOrderRepository $masterMonthOrderRepository,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository,
        MonthExceptionRuleRepository $monthExceptionRuleRepository
    ) {
        $idDealer = session()->get('user')['id_dealer'];
        $dataMastermonth = $masterMonthOrderRepository->allActive();
        $dataRangeMonth = $rangeMonthFixOrderRepository->getByIdMonth(date('m'));
        $rangeMonth = array();

        foreach($dataRangeMonth as $month) {
            array_push($rangeMonth, $month->month_id_to);
        }

        $dataMonthExceptionRule = $monthExceptionRuleRepository->getByIdDealerAndIdMonth($idDealer, date('m'));
        
        if($dataMonthExceptionRule) {
            $dataLockDate = $dataMonthExceptionRule;
        } else {
            $dataLockDate = $masterMonthOrderRepository->getById(date('m'));
        }

        $checkBeforeOrAfter = eval("return ((string) date('Y-m-d') $dataLockDate->operator_start '$dataLockDate->date_input_lock_start')
                    && ((string) date('Y-m-d') $dataLockDate->operator_end '$dataLockDate->date_input_lock_end');");

        return view('livewire.page.fix-order.fix-order-principle', [
            'dataMasterMonth' => $dataMastermonth,
            'dataLockDate' => $dataLockDate,
            'dataRangeMonth' => $dataRangeMonth,
            'rangeMonth' => $rangeMonth,
            'checkBeforeOrAfter' => $checkBeforeOrAfter
        ])->layout('layouts.app', ['title' => 'Fix Order Dealer Principle']);
    }
}
