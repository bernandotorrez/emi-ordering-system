<?php

namespace App\Http\Livewire\Page\SubmitAtpm;

use App\Repository\Eloquent\CancelStatusRepository;
use Livewire\Component;

class SubmitAtpmIndex extends Component
{
    public function render(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.submit-atpm.submit-atpm-index',[
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Submit ATPM']);
    }
}
