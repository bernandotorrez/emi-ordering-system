<?php

namespace App\Http\Livewire\Page\AllocatedAtpm;

use App\Repository\Eloquent\CancelStatusRepository;
use Livewire\Component;

class AllocatedAtpmIndex extends Component
{
    public function render(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.allocated-atpm.allocated-atpm-index',[
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Additonal Order']);
    }
}
