<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Repository\Eloquent\MasterMonthOrderRepository;
use Livewire\Component;
use App\Traits\WithGoTo;

class FixOrderIndex extends Component
{
    use WithGoTo;

    public function render(MasterMonthOrderRepository $masterMonthOrderRepository)
    {
        $dataMastermonth = $masterMonthOrderRepository->allActive();
        $dataLockDate = $masterMonthOrderRepository->getById(date('m'));
        return view('livewire.page.fix-order.fix-order-index', [
            'dataMasterMonth' => $dataMastermonth,
            'dataLockDate' => $dataLockDate
        ])
        ->layout('layouts.app', ['title' => 'Fix Order']);
    }
}
