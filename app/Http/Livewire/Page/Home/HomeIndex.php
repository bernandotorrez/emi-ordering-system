<?php

namespace App\Http\Livewire\Page\Home;

use App\Repository\Eloquent\MenuUserGroupRepository;
use Livewire\Component;

class HomeIndex extends Component
{
    protected $pageTitle = "Home";
    
    public function render(MenuUserGroupRepository $menuUserGroupRepository)
    {
        $dataParentMenu = $menuUserGroupRepository->getDynamicMenu(2);
        dd($dataParentMenu);
        return view('livewire.page.home.home-index')->layout('layouts.app', array('title' => $this->pageTitle));
    }
}
