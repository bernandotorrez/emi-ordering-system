<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use Livewire\Component;

class AdditionalOrderIndex extends Component
{
    public function goTo($value)
    {
        return redirect()->to(url($value));
    }
    
    public function render()
    {
        return view('livewire.page.additional-order.additional-order-index');
    }
}
