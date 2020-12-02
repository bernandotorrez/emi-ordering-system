<?php

namespace App\Http\Livewire;

use App\Models\MenuUserGroup;
use Livewire\Component;

class DynamicMenu extends Component
{
    public function render()
    {
        $idUserGroup = session()->get('user')['id_user_group'];
        $dataParentMenu = MenuUserGroup::where('id_user_group', $idUserGroup)
        ->with('parentsMenu.childsMenu.subChildsMenu.subSubChildsMenu')
        ->get();

        dd($dataParentMenu);
        
        return view('livewire.dynamic-menu', ['dataParentMenu' => $dataParentMenu]);
    }
}
