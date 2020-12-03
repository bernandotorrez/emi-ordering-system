<?php

namespace App\Http\Livewire\Page\MenuUserGroup;

use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\ChildMenuRepository;
use App\Repository\Eloquent\MenuUserGroupRepository;
use App\Repository\Eloquent\ParentMenuRepository;
use App\Repository\Eloquent\SubChildMenuRepository;
use App\Repository\Eloquent\SubSubChildMenuRepository;
use App\Repository\Eloquent\UserGroupRepository;
use Illuminate\Support\Facades\Cache;

class MenuUserGroupIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

     /**
     * Page Attributes
     */
    public string $pageTitle = "Menu User Group";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    protected string $view = 'view_menu_user_group';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public $bind = [
        'id_menu_user_group' => '',
        'id_user_group' => '',
        'id_sub_sub_child_menu' => '',
        'id_sub_child_menu' => '',
        'id_parent_menu' => '',
        'id_child_menu' => '',
        'can_view_parent' => '',
        'can_add_parent' => '',
        'can_edit_parent' => '',
        'can_delete_parent' => '',
        'can_view_child' => '',
        'can_add_child' => '',
        'can_edit_child' => '',
        'can_delete_child' => '',
        'can_view_sub_child' => '',
        'can_add_sub_child' => '',
        'can_edit_sub_child' => '',
        'can_delete_sub_child' => '',
        'can_view_sub_sub_child' => '',
        'can_add_sub_sub_child' => '',
        'can_edit_sub_sub_child' => '',
        'can_delete_sub_sub_child' => '',
        
    ];

    /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.id_user_group' => 'required',
        // 'bind.id_sub_sub_child_menu' => 'required',
        // 'bind.id_sub_child_menu' => 'required',
        // 'bind.id_child_menu' => 'required',
        'bind.id_parent_menu' => 'required',
    ];

    protected $messages = [
        'bind.id_user_group.required' => 'Please Choose ID User Group',
        'bind.id_sub_sub_child_menu.required' => 'Please Choose ID Sub Sub Child Menu',
        'bind.id_sub_child_menu.required' => 'Please Choose ID Sub Child Menu',
        'bind.id_child_menu.required' => 'Please Choose ID Child Menu',
        'bind.id_parent_menu.required' => 'Please Choose ID Parent Menu',
    ];

    public function mount()
    {
        $this->sortBy = 'nama_group';
        $this->fill(request()->only('search', 'page'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if($this->bind['id_child_menu'] == false) {
            $this->bind['can_view_child'] = false;
            $this->bind['can_add_child'] = false;
            $this->bind['can_edit_child'] = false;
            $this->bind['can_delete_child'] = false;
        }

        if($this->bind['id_sub_child_menu'] == false) {
            $this->bind['can_view_sub_child'] = false;
            $this->bind['can_add_sub_child'] = false;
            $this->bind['can_edit_sub_child'] = false;
            $this->bind['can_delete_sub_child'] = false;
        }

        if($this->bind['id_sub_sub_child_menu'] == false) {
            $this->bind['can_view_sub_sub_child'] = false;
            $this->bind['can_add_sub_sub_child'] = false;
            $this->bind['can_edit_sub_sub_child'] = false;
            $this->bind['can_delete_sub_sub_child'] = false;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['bind']);
    }

    public function render(
        MenuUserGroupRepository $menuUserGroupRepository,
        ParentMenuRepository $parentMenuRepository,
        ChildMenuRepository $childMenuRepository,
        SubChildMenuRepository $subChildMenuRepository,
        SubSubChildMenuRepository $subSubChildMenuRepository,
        UserGroupRepository $userGroupRepository
    )
    {
        $cache_name = 'menu-user-group-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataMenuUserGroup = Cache::remember($cache_name, 60, function () use($menuUserGroupRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $menuUserGroupRepository->viewPagination(
                $this->view,
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected,
            );
        });

        return view('livewire.page.menu-user-group.menu-user-group-index', [
            'dataMenuUserGroup' => $dataMenuUserGroup,
            'dataUserGroup' => $userGroupRepository->allActive(),
            'dataParentMenu' => $parentMenuRepository->allActive(),
            'dataChildMenu' => $childMenuRepository->getByIdParent($this->bind['id_parent_menu']),
            'dataSubChildMenu' => $subChildMenuRepository->getByIdChild($this->bind['id_child_menu']),
            'dataSubSubChildMenu' => $subSubChildMenuRepository->getByIdSubChild($this->bind['id_sub_child_menu'])

        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(MenuUserGroupRepository $menuUserGroupRepository)
    {
        $datas = $menuUserGroupRepository->viewChecked(
            $this->view,
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $menuUserGroupRepository->getPrimaryKey();
      
        // Dari Unchecked ke Checked
        if($this->allChecked == true) {
            foreach($datas as $data) {
                if(!in_array($data->$id, $this->checked)) {
                    array_push($this->checked, (string) $data->$id);
                }
            }
        } else {
            // Checked ke Unchecked
            $this->checked = [];
        }
    }

    public function addForm()
    {
        $this->isEdit = false;
        $this->resetForm();
        $this->emit('openModal');
    }

    public function addProcess(MenuUserGroupRepository $MenuUserGroupRepository)
    {
        $this->validate();

        $data = array(
            'id_sub_sub_child_menu' => $this->bind['id_sub_sub_child_menu'] ? $this->bind['id_sub_sub_child_menu'] : 0,
            'id_sub_child_menu' => $this->bind['id_sub_child_menu'] ? $this->bind['id_sub_child_menu'] : 0,
            'id_child_menu' => $this->bind['id_child_menu'] ? $this->bind['id_child_menu'] : 0,
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_user_group' => $this->bind['id_user_group'],
            'can_view_parent' => $this->bind['can_view_parent'] ? '1': '0',
            'can_add_parent' => $this->bind['can_add_parent'] ? '1': '0',
            'can_edit_parent' => $this->bind['can_edit_parent'] ? '1': '0',
            'can_delete_parent' => $this->bind['can_delete_parent'] ? '1': '0',
            'can_view_child' => $this->bind['can_view_child'] ? '1': '0',
            'can_add_child' => $this->bind['can_add_child'] ? '1': '0',
            'can_edit_child' => $this->bind['can_edit_child'] ? '1': '0',
            'can_delete_child' => $this->bind['can_delete_child'] ? '1': '0',
            'can_view_sub_child' => $this->bind['can_view_sub_child'] ? '1': '0',
            'can_add_sub_child' => $this->bind['can_add_sub_child'] ? '1': '0',
            'can_edit_sub_child' => $this->bind['can_edit_sub_child'] ? '1': '0',
            'can_delete_sub_child' => $this->bind['can_delete_sub_child'] ? '1': '0',
            'can_view_sub_sub_child' => $this->bind['can_view_sub_sub_child'] ? '1': '0',
            'can_add_sub_sub_child' => $this->bind['can_add_sub_sub_child'] ? '1': '0',
            'can_edit_sub_sub_child' => $this->bind['can_edit_sub_sub_child'] ? '1': '0',
            'can_delete_sub_sub_child' => $this->bind['can_delete_sub_sub_child'] ? '1': '0',
        );

        $where = array(
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_user_group' => $this->bind['id_user_group'],
        );

        $count = $MenuUserGroupRepository->findDuplicate($where);

        if($count <= 0) {
            $insert = $MenuUserGroupRepository->create($data);

            if($insert) {
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');

                session()->flash('action_message', '<div class="alert alert-success">Insert Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Insert Data Failed!</div>');
            }
        } else {
            session()->flash('message_duplicate', '<div class="alert alert-warning"> Already Exists!</div>');
        }
    }

    public function editForm(MenuUserGroupRepository $menuUserGroupRepository)
    {
        $this->isEdit = true;

        $data = $menuUserGroupRepository->getByID($this->checked[0]);
        $this->bind['id_menu_user_group'] = $data->id_menu_user_group;
        $this->bind['id_user_group'] = $data->id_user_group;
        $this->bind['id_sub_sub_child_menu'] = $data->id_sub_sub_child_menu;
        $this->bind['id_sub_child_menu'] = $data->id_sub_child_menu;
        $this->bind['id_child_menu'] = $data->id_child_menu;
        $this->bind['id_parent_menu'] = $data->id_parent_menu;
        $this->bind['can_view_parent'] = ($data->can_view_parent == '1') ? true : false;
        $this->bind['can_add_parent'] = ($data->can_add_parent == '1') ? true : false;
        $this->bind['can_edit_parent'] = ($data->can_edit_parent == '1') ? true : false;
        $this->bind['can_delete_parent'] = ($data->can_delete_parent == '1') ? true : false;
        $this->bind['can_view_child'] = ($data->can_view_child == '1') ? true : false;
        $this->bind['can_add_child'] = ($data->can_add_child == '1') ? true : false;
        $this->bind['can_edit_child'] = ($data->can_edit_child == '1') ? true : false;
        $this->bind['can_delete_child'] = ($data->can_delete_child == '1') ? true : false;
        $this->bind['can_view_sub_child'] = ($data->can_view_sub_child == '1') ? true : false;
        $this->bind['can_add_sub_child'] = ($data->can_add_sub_child == '1') ? true : false;
        $this->bind['can_edit_sub_child'] = ($data->can_edit_sub_child == '1') ? true : false;
        $this->bind['can_delete_sub_child'] = ($data->can_delete_sub_child == '1') ? true : false;
        $this->bind['can_view_sub_sub_child'] = ($data->can_view_sub_sub_child == '1') ? true : false;
        $this->bind['can_add_sub_sub_child'] = ($data->can_add_sub_sub_child == '1') ? true : false;
        $this->bind['can_edit_sub_sub_child'] = ($data->can_edit_sub_sub_child == '1') ? true : false;
        $this->bind['can_delete_sub_sub_child'] = ($data->can_delete_sub_sub_child == '1') ? true : false;

        $this->emit('openModal');
    }

    public function editProcess(MenuUserGroupRepository $menuUserGroupRepository)
    {
        $this->validate();

        $data = array(
            'id_sub_sub_child_menu' => $this->bind['id_sub_sub_child_menu'] ? $this->bind['id_sub_sub_child_menu'] : 0,
            'id_sub_child_menu' => $this->bind['id_sub_child_menu'] ? $this->bind['id_sub_child_menu'] : 0,
            'id_child_menu' => $this->bind['id_child_menu'] ? $this->bind['id_child_menu'] : 0,
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_user_group' => $this->bind['id_user_group'],
            'can_view_parent' => $this->bind['can_view_parent'] ? '1': '0',
            'can_add_parent' => $this->bind['can_add_parent'] ? '1': '0',
            'can_edit_parent' => $this->bind['can_edit_parent'] ? '1': '0',
            'can_delete_parent' => $this->bind['can_delete_parent'] ? '1': '0',
            'can_view_child' => $this->bind['can_view_child'] ? '1': '0',
            'can_add_child' => $this->bind['can_add_child'] ? '1': '0',
            'can_edit_child' => $this->bind['can_edit_child'] ? '1': '0',
            'can_delete_child' => $this->bind['can_delete_child'] ? '1': '0',
            'can_view_sub_child' => $this->bind['can_view_sub_child'] ? '1': '0',
            'can_add_sub_child' => $this->bind['can_add_sub_child'] ? '1': '0',
            'can_edit_sub_child' => $this->bind['can_edit_sub_child'] ? '1': '0',
            'can_delete_sub_child' => $this->bind['can_delete_sub_child'] ? '1': '0',
            'can_view_sub_sub_child' => $this->bind['can_view_sub_sub_child'] ? '1': '0',
            'can_add_sub_sub_child' => $this->bind['can_add_sub_sub_child'] ? '1': '0',
            'can_edit_sub_sub_child' => $this->bind['can_edit_sub_sub_child'] ? '1': '0',
            'can_delete_sub_sub_child' => $this->bind['can_delete_sub_sub_child'] ? '1': '0',
        );

        $where = array(
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_user_group' => $this->bind['id_user_group'],
        );

        $count = $menuUserGroupRepository->findDuplicateEdit($where, $this->bind['id_menu_user_group']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong> Already Exists!</div>');
        } else {
            $update = $menuUserGroupRepository->update($this->bind['id_menu_user_group'], $data);

            if($update) {
                $this->isEdit = false;
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');
                
                session()->flash('action_message', '<div class="alert alert-success">Update Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Update Data Failed!</div>');
            }
        }
    }

    public function deleteProcess(
        MenuUserGroupRepository $menuUserGroupRepository
    )
    {
        $delete = $menuUserGroupRepository->massDelete($this->checked);
        
        if($delete) {
            $this->resetForm();
            $this->deleteCache();
            $deleteStatus = 'success';

        } else {
            $deleteStatus = 'failed';
        }

        $this->emit('deleted', $deleteStatus);
    }
}
