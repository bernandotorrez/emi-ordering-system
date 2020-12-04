<?php

namespace App\Http\Livewire;

use App\Models\MenuUserGroup;
use App\Models\ParentMenu;
use App\Repository\Eloquent\MenuUserGroupRepository;
use App\Repository\Eloquent\ParentMenuRepository;
use Livewire\Component;

class DynamicMenu extends Component
{
    //protected $relation = ['parentsMenu.childsMenu.subChildsMenu.subSubChildsMenu'];
    protected $relation = ['childsMenu.subChildsMenu.subSubChildsMenu'];

    public function render(ParentMenuRepository $parentMenuRepository)
    {
        $idUserGroup = session()->get('user')['id_user_group'];
        // $dataParentMenu = $menuUserGroupRepository->getDynamicMenu($idUserGroup);

        //$dataMenuUserGroup = $menuUserGroupRepository->getMenuPrivilege($idUserGroup);

        $dataParentMenu = ParentMenu::where(['status' => '1', 'id_user_group' => $idUserGroup])
        ->with([
            'childsMenu' => function ($query) use($idUserGroup) {
                $query->where([
                    'tbl_child_menu.status' => '1', 
                    'tbl_child_menu.id_user_group' => $idUserGroup
                    ]);
            },
            'childsMenu.subChildsMenu' => function ($query) use($idUserGroup) {
                $query->where([
                    'tbl_sub_child_menu.status' => '1', 
                    'tbl_sub_child_menu.id_user_group' => $idUserGroup
                    ]);
            },
            'childsMenu.subChildsMenu.subSubChildsMenu' => function ($query) use($idUserGroup) {
                $query->where([
                    'tbl_sub_sub_child_menu.status' => '1', 
                    'tbl_sub_sub_child_menu.id_user_group' => $idUserGroup
                    ]);
            },
        ])->get();
        

        //TODO: buat loopingan untuk get is_exist_Parent, is_exist_child, id_exists_sub_child or is_exists_sub_sub_child
        return view('livewire.dynamic-menu', ['dataParentMenu' => $dataParentMenu]);
    }
}
