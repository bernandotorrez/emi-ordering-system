<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use App\Repository\Eloquent\CancelStatusRepository;
use App\Traits\WithGoTo;
use Livewire\Component;

class AdditionalOrderIndex extends Component
{
    use WithGoTo;
    
    public function render(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.additional-order.additional-order-index', [
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Additonal Order']);
    }

}
