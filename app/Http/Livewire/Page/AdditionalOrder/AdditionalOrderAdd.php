<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use Livewire\Component;

class AdditionalOrderAdd extends Component
{
    public $pageTitle = 'Additional Order';
    public function render()
    {
        return view('livewire.page.additional-order.additional-order-add');
    }
}
