<?php

namespace App\Http\Livewire;

use App\Repository\Eloquent\ParentMenuRepository;
use Livewire\Component;

class DynamicMenu extends Component
{
    
    public function render(ParentMenuRepository $parentMenuRepository)
    {
        $dataParentMenu = $parentMenuRepository->orderByPosition();
        return view('livewire.dynamic-menu', ['dataParentMenu' => $dataParentMenu]);
    }
}
