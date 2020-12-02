<?php

namespace App\Http\Livewire;

use App\Models\MenuUserGroup;
use App\Repository\Eloquent\MenuUserGroupRepository;
use App\Repository\Eloquent\ParentMenuRepository;
use Livewire\Component;

class DynamicMenu extends Component
{
    //protected $relation = ['parentsMenu.childsMenu.subChildsMenu.subSubChildsMenu'];
    protected $relation = ['childsMenu.subChildsMenu.subSubChildsMenu'];

    public function render(MenuUserGroupRepository $menuUserGroupRepository)
    {
        $idUserGroup = session()->get('user')['id_user_group'];
        // $dataParentMenu = $menuUserGroupRepository->getDynamicMenu($idUserGroup);

        $dataMenuUserGroup = $menuUserGroupRepository->getByIdUserGroup($idUserGroup);
        
        return view('livewire.dynamic-menu', ['dataMenuUserGroup' => $dataMenuUserGroup]);
    }
}
