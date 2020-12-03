<?php

namespace App\Http\Livewire\Page\SubChildMenu;

use App\Repository\Eloquent\SubChildMenuRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;
use App\Models\SubchildMenu;
use App\Repository\Eloquent\ChildMenuRepository;
use App\Repository\Eloquent\ParentMenuRepository;
use App\Repository\Eloquent\SubSubChildMenuRepository;

class SubChildMenuIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

    /**
     * Page Attributes
     */
    public string $pageTitle = "Sub Child Menu";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    protected string $view = 'view_sub_child_menu';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public $bind = [
        'id_sub_child_menu' => '',
        'id_parent_menu' => '',
        'id_child_menu' => '',
        'sub_child_position' => '',
        'nama_sub_child_menu' => '',
        'url' => '',
        'icon' => '',
    ];

     /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.id_child_menu' => 'required',
        'bind.id_parent_menu' => 'required',
        'bind.sub_child_position' => 'required|numeric|min:1',
        'bind.nama_sub_child_menu' => 'required|min:3|max:100',
        'bind.url' => 'required|min:1',
    ];

    protected $messages = [
        'bind.id_parent_menu.required' => 'Please Choose ID Parent Menu',
        'bind.id_child_menu.required' => 'Please Choose ID Child Menu',
        'bind.sub_child_position.required' => 'The Sub Child Position Cant be Empty!',
        'bind.sub_child_position.numeric' => 'The Sub Child Position must be Numeric',
        'bind.sub_child_position.min' => 'The Sub Child Position must be at least :min Characters',
        'bind.nama_sub_child_menu.required' => 'The Sub Nama Child Menu Cant be Empty!',
        'bind.nama_sub_child_menu.min' => 'The Sub Nama Child Menu must be at least :min Characters',
        'bind.nama_sub_child_menu.max' => 'The Sub Nama Child Menu Cant be maximal :max Characters',
        'bind.url.required' => 'The URL Cant be Empty!',
        'bind.url.min' => 'The URL must be at least :min Characters',
    ];

    public function mount()
    {
        $this->sortBy = 'nama_sub_child_menu';
        $this->fill(request()->only('search', 'page'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
        SubChildMenuRepository $subChildMenuRepository,
        ParentMenuRepository $parentMenuRepository,
        ChildMenuRepository $childMenuRepository
        )
    {
        $cache_name = 'sub-child-menu-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataSubChildMenu = Cache::remember($cache_name, 60, function () use($subChildMenuRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $subChildMenuRepository->viewPagination(
                $this->view,
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected,
            );
        });
        
        $dataParentMenu = $parentMenuRepository->allActive();
        $dataChildMenu = $childMenuRepository->getByIdParent($this->bind['id_parent_menu']);

        return view('livewire.page.sub-child-menu.sub-child-menu-index', [
            'dataSubChildMenu' => $dataSubChildMenu,
            'dataParentMenu' => $dataParentMenu,
            'dataChildMenu' => $dataChildMenu
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(SubChildMenuRepository $subChildMenuRepository)
    {
        $datas = $subChildMenuRepository->viewChecked(
            $this->view,
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $subChildMenuRepository->getPrimaryKey();
      
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

    public function addProcess(SubChildMenuRepository $subChildMenuRepository)
    {
        $this->validate();

        $data = array(
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_child_menu' => $this->bind['id_child_menu'],
            'sub_child_position' => $this->bind['sub_child_position'],
            'nama_sub_child_menu' => $this->bind['nama_sub_child_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array(
            'nama_sub_child_menu' => $this->bind['nama_sub_child_menu'], 
            'id_child_menu' => $this->bind['id_child_menu']
        );

        $count = $subChildMenuRepository->findDuplicate($where);

        if($count <= 0) {
            $insert = $subChildMenuRepository->create($data);

            if($insert) {
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');

                session()->flash('action_message', '<div class="alert alert-success">Insert Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Insert Data Failed!</div>');
            }
        } else {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_sub_child_menu'].'</strong> Already Exists!</div>');
        }
    }

    public function editForm(SubChildMenuRepository $subChildMenuRepository)
    {
        $this->isEdit = true;

        $data = $subChildMenuRepository->getByID($this->checked[0]);
        $this->bind['id_sub_child_menu'] = $data->id_sub_child_menu;
        $this->bind['id_child_menu'] = $data->id_child_menu;
        $this->bind['id_parent_menu'] = $data->id_parent_menu;
        $this->bind['sub_child_position'] = $data->sub_child_position;
        $this->bind['nama_sub_child_menu'] = $data->nama_sub_child_menu;
        $this->bind['url'] = $data->url;
        $this->bind['icon'] = $data->icon;

        $this->emit('openModal');
    }

    public function editProcess(SubChildMenuRepository $subChildMenuRepository)
    {
        $this->validate();

        $data = array(
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_child_menu' => $this->bind['id_child_menu'],
            'sub_child_position' => $this->bind['sub_child_position'],
            'nama_sub_child_menu' => $this->bind['nama_sub_child_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array(
            'nama_sub_child_menu' => $this->bind['nama_sub_child_menu'], 
            'id_child_menu' => $this->bind['id_child_menu']
        );

        $count = $subChildMenuRepository->findDuplicateEdit($where, $this->bind['id_sub_child_menu']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_sub_child_menu'].'</strong> Already Exists!</div>');
        } else {
            $update = $subChildMenuRepository->update($this->bind['id_sub_child_menu'], $data);

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
        SubChildMenuRepository $subChildMenuRepository,
        SubSubChildMenuRepository $subSubChildMenuRepository
        )
    {
        $delete = $subChildMenuRepository->massDelete($this->checked);
        
        if($delete) {
            $this->resetForm();
            $this->deleteCache();
            $deleteStatus = 'success';

            $subSubChildMenuRepository->deleteBySubChild($this->checked);
        } else {
            $deleteStatus = 'failed';
        }

        $this->emit('deleted', $deleteStatus);
    }
}
