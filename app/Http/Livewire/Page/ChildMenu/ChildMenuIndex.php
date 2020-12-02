<?php

namespace App\Http\Livewire\Page\ChildMenu;

use App\Repository\Eloquent\ChildMenuRepository;
use App\Repository\Eloquent\ParentMenuRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\SubChildMenuRepository;

class ChildMenuIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

    /**
     * Page Attributes
     */
    public string $pageTitle = "Child Menu";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    protected array $relation = ['parentMenu'];
    
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];
    
    public $bind = [
        'id_child_menu' => '',
        'id_parent_menu' => '',
        'child_position' => '',
        'nama_child_menu' => '',
        'url' => '',
        'icon' => '',
    ];

    /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.id_parent_menu' => 'required',
        'bind.child_position' => 'required|numeric|min:1',
        'bind.nama_child_menu' => 'required|min:3|max:100',
        'bind.url' => 'required|min:1',
    ];

    protected $messages = [
        'bind.id_parent_menu.required' => 'Please Choose ID Parent Menu',
        'bind.child_position.required' => 'The Child Position Cant be Empty!',
        'bind.child_position.numeric' => 'The Child Position must be Numeric',
        'bind.child_position.min' => 'The Child Position must be at least :min Characters',
        'bind.nama_child_menu.required' => 'The Nama Child Menu Cant be Empty!',
        'bind.nama_child_menu.min' => 'The Nama Child Menu must be at least :min Characters',
        'bind.nama_child_menu.max' => 'The Nama Child Menu Cant be maximal :max Characters',
        'bind.url.required' => 'The URL Cant be Empty!',
        'bind.url.min' => 'The URL must be at least :min Characters',
    ];

    public function mount()
    {
        $this->sortBy = 'nama_child_menu';
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
        ChildMenuRepository $childMenuRepository,
        ParentMenuRepository $parentMenuRepository
        )
    {

        $cache_name = 'child-menu-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataChildMenu = Cache::remember($cache_name, 60, function () use($childMenuRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $childMenuRepository->paginationWithRelation(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected,
                $this->relation
            );
        });

        $dataParentMenu = $parentMenuRepository->allActive();

        return view('livewire.page.child-menu.child-menu-index', [
            'dataChildMenu' => $dataChildMenu,
            'dataParentMenu' => $dataParentMenu
        ])->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(ChildMenuRepository $childMenuRepository)
    {
        $datas = $childMenuRepository->checked(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $childMenuRepository->getPrimaryKey();
      
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

    public function addProcess(ChildMenuRepository $childMenuRepository)
    {
        $this->validate();

        $data = array(
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'child_position' => $this->bind['child_position'],
            'nama_child_menu' => $this->bind['nama_child_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array(
            'nama_child_menu' => $this->bind['nama_child_menu'], 
            'id_parent_menu' => $this->bind['id_parent_menu']
        );

        $count = $childMenuRepository->findDuplicate($where);

        if($count <= 0) {
            $insert = $childMenuRepository->create($data);

            if($insert) {
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');

                session()->flash('action_message', '<div class="alert alert-success">Insert Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Insert Data Failed!</div>');
            }
        } else {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_parent_menu'].'</strong> Already Exists!</div>');
        }
    }

    public function editForm(ChildMenuRepository $childMenuRepository)
    {
        $this->isEdit = true;

        $data = $childMenuRepository->getByID($this->checked[0]);
        $this->bind['id_child_menu'] = $data->id_child_menu;
        $this->bind['id_parent_menu'] = $data->id_parent_menu;
        $this->bind['child_position'] = $data->child_position;
        $this->bind['nama_child_menu'] = $data->nama_child_menu;
        $this->bind['url'] = $data->url;
        $this->bind['icon'] = $data->icon ;

        $this->emit('openModal');
    }

    public function editProcess(ChildMenuRepository $childMenuRepository)
    {
        $this->validate();

        $data = array(
            'id_parent_menu' => $this->bind['id_parent_menu'],
            'child_position' => $this->bind['child_position'],
            'nama_child_menu' => $this->bind['nama_child_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array(
            'nama_child_menu' => $this->bind['nama_child_menu'], 
            'id_parent_menu' => $this->bind['id_parent_menu']
        );

        $count = $childMenuRepository->findDuplicateEdit($where, $this->bind['id_child_menu']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_child_menu'].'</strong> Already Exists!</div>');
        } else {
            $update = $childMenuRepository->update($this->bind['id_child_menu'], $data);

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
        ChildMenuRepository $childMenuRepository,
        SubChildMenuRepository $subChildMenuRepository
        )
    {
        $delete = $childMenuRepository->massDelete($this->checked);
        
        if($delete) {
            $this->resetForm();
            $this->deleteCache();
            $deleteStatus = 'success';

            $subChildMenuRepository->deleteByChild($this->checked);
        } else {
            $deleteStatus = 'failed';
        }

        $this->emit('deleted', $deleteStatus);
    }
}
