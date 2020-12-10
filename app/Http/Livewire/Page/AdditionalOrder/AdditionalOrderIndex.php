<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use App\Traits\WithGoTo;
use Livewire\Component;

class AdditionalOrderIndex extends Component
{
    use WithGoTo;
    
    public function render()
    {
        return view('livewire.page.additional-order.additional-order-index');
    }

}
