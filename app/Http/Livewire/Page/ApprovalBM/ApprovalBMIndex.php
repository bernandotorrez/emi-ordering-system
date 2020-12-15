<?php

namespace App\Http\Livewire\Page\ApprovalBM;

use App\Repository\Eloquent\CancelStatusRepository;
use Livewire\Component;
use App\Traits\WithGoTo;

class ApprovalBMIndex extends Component
{
    use WithGoTo;
    
    public function render(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.approval-b-m.approval-b-m-index', [
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Approval BM']);
    }
}
