<?php

namespace App\Http\Livewire\Page\SubSubChildMenu;

use App\Repository\Eloquent\ChildMenuRepository;
use App\Repository\Eloquent\ParentMenuRepository;
use App\Repository\Eloquent\SubChildMenuRepository;
use App\Repository\Eloquent\SubSubChildMenuRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;

class SubSubChildMenuIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

     /**
     * Page Attributes
     */
    public string $pageTitle = "Sub Sub Child Menu";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    protected string $view = 'view_sub_sub_child_menu';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public $bind = [
        'id_sub_sub_child_menu' => '',
        'id_sub_child_menu' => '',
        'id_parent_menu' => '',
        'id_child_menu' => '',
        'sub_sub_child_position' => '',
        'nama_sub_sub_child_menu' => '',
        'url' => '',
        'icon' => '',
    ];

    /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.id_sub_child_menu' => 'required',
        'bind.id_child_menu' => 'required',
        'bind.id_parent_menu' => 'required',
        'bind.sub_sub_child_position' => 'required|numeric|min:1',
        'bind.nama_sub_sub_child_menu' => 'required|min:3|max:100',
        'bind.url' => 'required|min:1',
    ];

    protected $messages = [
        'bind.id_parent_menu.required' => 'Please Choose ID Parent Menu',
        'bind.id_sub_child_menu.required' => 'Please Choose ID Sub Child Menu',
        'bind.id_child_menu.required' => 'Please Choose ID Child Menu',
        'bind.sub_sub_child_position.required' => 'The Sub Sub Child Position Cant be Empty!',
        'bind.sub_sub_child_position.numeric' => 'The Sub Sub Child Position must be Numeric',
        'bind.sub_sub_child_position.min' => 'The Sub Sub Child Position must be at least :min Characters',
        'bind.nama_sub_sub_child_menu.required' => 'The Sub Sub Nama Child Menu Cant be Empty!',
        'bind.nama_sub_sub_child_menu.min' => 'The Sub Sub Nama Child Menu must be at least :min Characters',
        'bind.nama_sub_sub_child_menu.max' => 'The Sub Sub Nama Child Menu Cant be maximal :max Characters',
        'bind.url.required' => 'The URL Cant be Empty!',
        'bind.url.min' => 'The URL must be at least :min Characters',
    ];

    public function mount()
    {
        $this->sortBy = 'nama_sub_sub_child_menu';
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
        SubSubChildMenuRepository $subSubChildMenuRepository,
        SubChildMenuRepository $subChildMenuRepository,
        ChildMenuRepository $childMenuRepository,
        ParentMenuRepository $parentMenuRepository
    )
    {

        $cache_name = 'sub-sub-child-menu-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataSubSubChildMenu = Cache::remember($cache_name, 60, function () use($subSubChildMenuRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $subSubChildMenuRepository->viewPagination(
                $this->view,
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected,
            );
        });

        return view('livewire.page.sub-sub-child-menu.sub-sub-child-menu-index', [
            'dataSubSubChildMenu' => $dataSubSubChildMenu,
            'dataParentMenu' => $parentMenuRepository->allActive(),
            'dataChildMenu' => $childMenuRepository->getByIdParent($this->bind['id_parent_menu']),
            'dataSubChildMenu' => $subChildMenuRepository->getByIdChild($this->bind['id_child_menu'])
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(SubSubChildMenuRepository $subSubChildMenuRepository)
    {
        $datas = $subSubChildMenuRepository->viewChecked(
            $this->view,
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $subSubChildMenuRepository->getPrimaryKey();
      
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

    public function addProcess(SubSubChildMenuRepository $subSubChildMenuRepository)
    {
        $this->validate();

        $data = array(
            'id_sub_child_menu' => $this->bind['id_sub_child_menu'],
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_child_menu' => $this->bind['id_child_menu'],
            'sub_sub_child_position' => $this->bind['sub_sub_child_position'],
            'nama_sub_sub_child_menu' => $this->bind['nama_sub_sub_child_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array(
            'nama_sub_sub_child_menu' => $this->bind['nama_sub_sub_child_menu'], 
            'id_sub_child_menu' => $this->bind['id_sub_child_menu']
        );

        $count = $subSubChildMenuRepository->findDuplicate($where);

        if($count <= 0) {
            $insert = $subSubChildMenuRepository->create($data);

            if($insert) {
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');

                session()->flash('action_message', '<div class="alert alert-success">Insert Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Insert Data Failed!</div>');
            }
        } else {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_sub_sub_child_menu'].'</strong> Already Exists!</div>');
        }
    }

    public function editForm(SubSubChildMenuRepository $subSubChildMenuRepository)
    {
        $this->isEdit = true;

        $data = $subSubChildMenuRepository->getByID($this->checked[0]);
        $this->bind['id_sub_sub_child_menu'] = $data->id_sub_child_menu;
        $this->bind['id_sub_child_menu'] = $data->id_sub_child_menu;
        $this->bind['id_child_menu'] = $data->id_child_menu;
        $this->bind['id_parent_menu'] = $data->id_parent_menu;
        $this->bind['sub_sub_child_position'] = $data->sub_sub_child_position;
        $this->bind['nama_sub_sub_child_menu'] = $data->nama_sub_sub_child_menu;
        $this->bind['url'] = $data->url;
        $this->bind['icon'] = $data->icon;

        $this->emit('openModal');
    }

    public function editProcess(SubSubChildMenuRepository $subSubChildMenuRepository)
    {
        $this->validate();

        $data = array(
            'id_sub_child_menu' => $this->bind['id_child_menu'],
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'id_child_menu' => $this->bind['id_child_menu'],
            'sub_sub_child_position' => $this->bind['sub_sub_child_position'],
            'nama_sub_sub_child_menu' => $this->bind['nama_sub_sub_child_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array(
            'nama_sub_sub_child_menu' => $this->bind['nama_sub_sub_child_menu'], 
            'id_sub_child_menu' => $this->bind['id_sub_child_menu']
        );

        $count = $subSubChildMenuRepository->findDuplicateEdit($where, $this->bind['id_sub_sub_child_menu']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_sub_sub_child_menu'].'</strong> Already Exists!</div>');
        } else {
            $update = $subSubChildMenuRepository->update($this->bind['id_sub_sub_child_menu'], $data);

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
        SubSubChildMenuRepository $subSubChildMenuRepository
    )
    {
        $delete = $subSubChildMenuRepository->massDelete($this->checked);
        
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
