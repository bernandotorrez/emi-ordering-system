<?php

namespace App\Http\Livewire\Page\ApprovalBM;

use App\Repository\Eloquent\CancelStatusRepository;
use Livewire\Component;

class ApprovalBMIndex extends Component
{
    public function render(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.approval-b-m.approval-b-m-index', [
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Approval BM']);
    }
}
