<?php

namespace App\Http\Livewire\Page\FixOrder;

use Livewire\Component;
use App\Traits\WithGoTo;

class FixOrderIndex extends Component
{
    use WithGoTo;

    public function render()
    {
        return view('livewire.page.fix-order.fix-order-index');
    }
}
