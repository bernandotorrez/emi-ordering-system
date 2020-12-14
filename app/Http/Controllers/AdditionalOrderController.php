<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\CancelStatusRepository;
use Illuminate\Http\Request;

class AdditionalOrderController extends Controller
{
    public function index(CancelStatusRepository $cancelStatusRepository)
    {
        $dataCancelStatus = $cancelStatusRepository->allActive();
        return view('livewire.page.additional-order.additional-order-index', [
            'dataCancelStatus' => $dataCancelStatus
        ])->layout('layouts.app', ['title' => 'Additonal Order']);
    }
}
