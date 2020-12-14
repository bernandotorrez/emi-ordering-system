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
        return view('livewire.page.fix-order.fix-order-index', [
            'dataMasterMonth' => $dataMastermonth
        ])
        ->layout('layouts.app', ['title' => 'Fix Order']);
    }
}
