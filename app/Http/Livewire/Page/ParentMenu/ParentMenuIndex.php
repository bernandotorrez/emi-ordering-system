<?php

namespace App\Http\Livewire\Page\ParentMenu;

use App\Repository\Eloquent\ParentMenuRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\ChildMenuRepository;
use App\Repository\Eloquent\SubChildMenuRepository;

class ParentMenuIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

     /**
     * Page Attributes
     */
    public string $pageTitle = "Parent Menu";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    protected array $relation = ['userGroup'];
    
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];
    
    public $bind = [
        'id_parent_menu' => '',
        'parent_position' => '',
        'nama_parent_menu' => '',
        'url' => '',
        'icon' => '',
    ];

    /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.parent_position' => 'required|numeric|min:1',
        'bind.nama_parent_menu' => 'required|min:3|max:100',
        'bind.url' => 'required|min:1',
    ];

    protected $messages = [
        'bind.parent_position.required' => 'The Parent Position Cant be Empty!',
        'bind.parent_position.numeric' => 'The Parent Position must be Numeric',
        'bind.parent_position.min' => 'The Parent Position must be at least :min Characters',
        'bind.nama_parent_menu.required' => 'The Nama Parent Menu Cant be Empty!',
        'bind.nama_parent_menu.min' => 'The Nama Parent Menu must be at least :min Characters',
        'bind.nama_parent_menu.max' => 'The Nama Parent Menu Cant be maximal :max Characters',
        'bind.url.required' => 'The URL Cant be Empty!',
        'bind.url.min' => 'The URL must be at least :min Characters',
    ];

    public function mount()
    {
        $this->sortBy = 'parent_position';
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

    public function render(ParentMenuRepository $parentMenuRepository)
    {
        $cache_name = 'parent-menu-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataParentMenu = Cache::remember($cache_name, 60, function () use($parentMenuRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $parentMenuRepository->pagination(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected,
                $this->relation
            );
        });

        return view('livewire.page.parent-menu.parent-menu-index', ['dataParentMenu' => $dataParentMenu])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(ParentMenuRepository $parentMenuRepository)
    {
        $datas = $parentMenuRepository->checked(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $parentMenuRepository->getPrimaryKey();
      
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

    public function addProcess(ParentMenuRepository $parentMenuRepository)
    {
        $this->validate();

        $data = array(
            'parent_position' => $this->bind['parent_position'],
            'nama_parent_menu' => $this->bind['nama_parent_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array('nama_parent_menu' => $this->bind['nama_parent_menu']);

        $count = $parentMenuRepository->findDuplicate($where);

        if($count <= 0) {
            $insert = $parentMenuRepository->create($data);

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

    public function editForm(ParentMenuRepository $parentMenuRepository)
    {
        $this->isEdit = true;

        $data = $parentMenuRepository->getByID($this->checked[0]);
        $this->bind['id_parent_menu'] = $data->id_parent_menu;
        $this->bind['parent_position'] = $data->parent_position;
        $this->bind['nama_parent_menu'] = $data->nama_parent_menu;
        $this->bind['url'] = $data->url;
        $this->bind['icon'] = $data->icon ;

        $this->emit('openModal');
    }

    public function editProcess(ParentMenuRepository $parentMenuRepository)
    {
        $this->validate();

        $data = array(
            'parent_position' => $this->bind['parent_position'],
            'nama_parent_menu' => $this->bind['nama_parent_menu'],
            'url' => $this->bind['url'],
            'icon' => $this->bind['icon'],
        );

        $where = array('nama_parent_menu' => $this->bind['nama_parent_menu']);

        $count = $parentMenuRepository->findDuplicateEdit($where, $this->bind['id_parent_menu']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_parent_menu'].'</strong> Already Exists!</div>');
        } else {
            $update = $parentMenuRepository->update($this->bind['id_parent_menu'], $data);

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
        ParentMenuRepository $parentMenuRepository,
        ChildMenuRepository $childMenuRepository,
        SubChildMenuRepository $subChildMenuRepository
        )
    {
        $delete = $parentMenuRepository->massDelete($this->checked);
        
        if($delete) {
            $this->resetForm();
            $this->deleteCache();
            $deleteStatus = 'success';
            
            $childMenuRepository->deleteByParent($this->checked);
            $subChildMenuRepository->deleteByParent($this->checked, $childMenuRepository);
        } else {
            $deleteStatus = 'failed';
        }

        $this->emit('deleted', $deleteStatus);
    }
}
