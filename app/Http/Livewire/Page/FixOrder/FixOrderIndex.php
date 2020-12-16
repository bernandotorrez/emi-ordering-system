<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Repository\Eloquent\MasterMonthOrderRepository;
use App\Repository\Eloquent\RangeMonthFixOrderRepository;
use Livewire\Component;
use App\Traits\WithGoTo;

class FixOrderIndex extends Component
{
    use WithGoTo;

    public function render(
        MasterMonthOrderRepository $masterMonthOrderRepository,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository
    ) {
        $dataMastermonth = $masterMonthOrderRepository->allActive();
        $dataLockDate = $masterMonthOrderRepository->getById(date('m'));
        $dataRangeMonth = $rangeMonthFixOrderRepository->getByIdMonth(date('m'));
        $rangeMonth = array();
        array_push($rangeMonth, date('m'));

        foreach($dataRangeMonth as $month) {
            array_push($rangeMonth, $month->month_id_to);
        }

        return view('livewire.page.fix-order.fix-order-index', [
            'dataMasterMonth' => $dataMastermonth,
            'dataLockDate' => $dataLockDate,
            'rangeMonth' => $rangeMonth
        ])
        ->layout('layouts.app', ['title' => 'Fix Order']);
    }
}
