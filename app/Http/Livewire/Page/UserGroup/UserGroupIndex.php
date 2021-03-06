<?php

namespace App\Http\Livewire\Page\UserGroup;

use App\Repository\Eloquent\UserGroupRepository;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;
use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;

class UserGroupIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

    /**
     * Page Attributes
     */
    public string $pageTitle = "User Group";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];
    
    public $bind = [
        'id_user_group' => '',
        'nama_group' => ''
    ];

    /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.nama_group' => 'required|min:3|max:100'
    ];

    protected $messages = [
        'bind.nama_group.required' => 'The Group Name Cant be Empty!',
        'bind.nama_group.min' => 'The Group Name must be at least 3 Characters',
        'bind.nama_group.max' => 'The Group Name Cant be maximal 100 Characters',
    ];

    public function mount()
    {
        $this->sortBy = 'nama_group';
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

    public function render(UserGroupRepository $userGroupRepository)
    {
        $cache_name = 'user-group-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataUserGroup = Cache::remember($cache_name, 60, function () use($userGroupRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $userGroupRepository->pagination(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected
            );
        });

        return view('livewire.page.user-group.user-group-index', ['dataUserGroup' => $dataUserGroup])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(UserGroupRepository $userGroupRepository)
    {
        $datas = $userGroupRepository->checked(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $userGroupRepository->getPrimaryKey();
      
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

    public function addProcess(UserGroupRepository $userGroupRepository)
    {
        $this->validate();

        $data = array('nama_group' => $this->bind['nama_group']);

        $count = $userGroupRepository->findDuplicate($data);

        if($count <= 0) {
            $insert = $userGroupRepository->create($data);

            if($insert) {
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');

                session()->flash('action_message', '<div class="alert alert-success">Insert Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Insert Data Failed!</div>');
            }
        } else {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_group'].'</strong> Already Exists!</div>');
        }
    }

    public function editForm(UserGroupRepository $userGroupRepository)
    {
        $this->isEdit = true;

        $data = $userGroupRepository->getByID($this->checked[0]);
        $this->bind['id_user_group'] = $data->id_user_group;
        $this->bind['nama_group'] = $data->nama_group;

        $this->emit('openModal');
    }

    public function editProcess(UserGroupRepository $userGroupRepository)
    {
        $this->validate();

        $data = array('nama_group' => $this->bind['nama_group']);

        $count = $userGroupRepository->findDuplicateEdit($data, $this->bind['id_user_group']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['nama_group'].'</strong> Already Exists!</div>');
        } else {
            $update = $userGroupRepository->update($this->bind['id_user_group'], $data);

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

    public function deleteProcess(UserGroupRepository $userGroupRepository)
    {
        $delete = $userGroupRepository->massDelete($this->checked);

        if($delete) {
            $this->resetForm();
            $this->checked = [];
            $this->deleteCache();

            $deleteStatus = 'success';
        } else {
            $deleteStatus = 'failed';
        }

        $this->emit('deleted', $deleteStatus);
    }
}
