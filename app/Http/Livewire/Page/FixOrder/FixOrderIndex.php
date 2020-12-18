<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Repository\Eloquent\MasterMonthOrderRepository;
use App\Repository\Eloquent\RangeMonthFixOrderRepository;
use Livewire\Component;
use App\Traits\WithGoTo;

class FixOrderIndex extends Component
{
    use WithGoTo;

    public function render(
        MasterMonthOrderRepository $masterMonthOrderRepository,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository,
        MasterFixOrderRepository $masterFixOrderRepository

    ) {
        $dataMastermonth = $masterMonthOrderRepository->allActive();
        $dataLockDate = $masterMonthOrderRepository->getById(date('m'));
        $dataRangeMonth = $rangeMonthFixOrderRepository->getByIdMonth(date('m'));
        $rangeMonth = array();
        //array_push($rangeMonth, date('m'));

        $checkBeforeOrAfter = eval("return ((string) date('Y-m-d') $dataLockDate->operator_start '$dataLockDate->date_input_lock_start')
                    && ((string) date('Y-m-d') $dataLockDate->operator_end '$dataLockDate->date_input_lock_end');");

        foreach($dataRangeMonth as $month) {
            array_push($rangeMonth, $month->month_id_to);
        }

        $where = array(
            'status' => '1',
            'id_dealer' => session()->get('user')['id_dealer'],
            'id_month' => $rangeMonth[0]
        );
        $countOrder = $masterFixOrderRepository->findDuplicate($where);

        return view('livewire.page.fix-order.fix-order-index', [
            'dataMasterMonth' => $dataMastermonth,
            'dataLockDate' => $dataLockDate,
            'dataRangeMonth' => $dataRangeMonth,
            'rangeMonth' => $rangeMonth,
            'countOrder' => $countOrder,
            'checkBeforeOrAfter' => $checkBeforeOrAfter
        ])
        ->layout('layouts.app', ['title' => 'Fix Order']);
    }
}
