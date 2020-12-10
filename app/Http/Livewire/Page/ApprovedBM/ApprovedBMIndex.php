<?php

namespace App\Http\Livewire\Page\ApprovedBM;

use App\Repository\Eloquent\CancelStatusRepository;
use Livewire\Component;

class ApprovedBMIndex extends Component
{
    public function render(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.approved-b-m.approved-b-m-index', [
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Approved BM']);
    }
}
