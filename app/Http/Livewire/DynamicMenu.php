<?php

namespace App\Http\Livewire;

use App\Repository\Eloquent\ParentMenuRepository;
use Livewire\Component;

class DynamicMenu extends Component
{
    protected $relation = ['childsMenu.subChildsMenu.subSubChildsMenu'];

    public function render(ParentMenuRepository $parentMenuRepository)
    {
        $dataParentMenu = $parentMenuRepository->allActiveWithRelation($this->relation);
        
        return view('livewire.dynamic-menu', ['dataParentMenu' => $dataParentMenu]);
    }
}
