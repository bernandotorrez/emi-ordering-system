<?php

namespace App\Http\Livewire\Page\User;

use App\Repository\Eloquent\UserRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithPaginationAttribute;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\UserGroupRepository;

class UserIndex extends Component
{
    use WithPagination;
    use WithPaginationAttribute;
    use WithSorting;
    use WithDeleteCache;

     /**
     * Page Attributes
     */
    public string $pageTitle = "User";
    public bool $isEdit = false, $allChecked = false;
    public array $checked = [];
    protected string $view = 'view_user';
    
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];
    
    public $bind = [
        'id_user' => '',
        'username' => '',
        'nama_user' => '',
        'email' => '',
        'id_user_group' => '',
        'level_access' => '',
        'status_atpm' => '',
    ];

    /**
     * Validation Attributes
     */
    protected $rules = [
        'bind.username' => 'required|min:3|max:100',
        'bind.nama_user' => 'required|min:3|max:100',
        'bind.email' => 'required|email|min:3|max:100',
        'bind.id_user_group' => 'required',
        'bind.level_access' => 'required',
        'bind.status_atpm' => 'required|in:atpm,dealer',
    ];

    protected $messages = [
        'bind.username.required' => 'The Username Cant be Empty!',
        'bind.username.min' => 'The Username must be at least 3 Characters',
        'bind.username.max' => 'The Username Cant be maximal 100 Characters',
        'bind.nama_user.required' => 'The Nama User Cant be Empty!',
        'bind.nama_user.min' => 'The Nama User must be at least 3 Characters',
        'bind.nama_user.max' => 'The Nama User Cant be maximal 100 Characters',
        'bind.email.required' => 'The Email Cant be Empty!',
        'bind.email.email' => 'The Email not Valid!',
        'bind.email.min' => 'The Email must be at least 3 Characters',
        'bind.email.max' => 'The Email Cant be maximal 100 Characters',
        'bind.id_user_group.required' => 'Please Choose ID Group',
        'bind.level_access.required' => 'Please Choose Level Access',
        'bind.status_atpm.required' => 'Please Choose Status ATPM',
    ];

    public function mount()
    {
        $this->sortBy = 'username';
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
        UserRepository $userRepository,
        UserGroupRepository $userGroupRepository
        )
    {
        $cache_name = 'user-index-page-'.$this->page.'-pageselected-'.$this->perPageSelected.'-search-'.$this->search;
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.session()->get('user')['id_user'];

        $dataUser = Cache::remember($cache_name, 60, function () use($userRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $userRepository->viewPagination(
                $this->view,
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected
            );
        });

        return view('livewire.page.user.user-index', [
            'dataUser' => $dataUser,
            'dataUserGroup' => $userGroupRepository->allActive()
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function allChecked(UserRepository $userRepository)
    {
        $datas = $userRepository->viewChecked(
            $this->view,
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->perPageSelected
        );

        $id = $userRepository->getPrimaryKey();
      
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

    public function addProcess(UserRepository $userRepository)
    {
        $this->validate();

        $data = array(
            'username' => $this->bind['username'],
            'nama_user' => $this->bind['nama_user'],
            'password' => md5($this->bind['username']),
            'email' => $this->bind['email'],
            'id_user_group' => $this->bind['id_user_group'],
            'level_access' => $this->bind['level_access'],
            'status_atpm' => $this->bind['status_atpm'],
        );

        $where = array('username' => $this->bind['username']);

        $count = $userRepository->findDuplicate($where);

        if($count <= 0) {
            $insert = $userRepository->create($data);

            if($insert) {
                $this->resetForm();
                $this->deleteCache();
                $this->emit('closeModal');

                session()->flash('action_message', '<div class="alert alert-success">Insert Data Success!</div>');
            } else {
                session()->flash('action_message', '<div class="alert alert-danger">Insert Data Failed!</div>');
            }
        } else {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['username'].'</strong> Already Exists!</div>');
        }
    }

    public function editForm(UserRepository $userRepository)
    {
        $this->isEdit = true;

        $data = $userRepository->getByID($this->checked[0]);
        $this->bind['id_user'] = $data->id_user;
        $this->bind['id_user_group'] = $data->id_user_group;
        $this->bind['username'] = $data->username;
        $this->bind['nama_user'] = $data->nama_user;
        $this->bind['email'] = $data->email;
        $this->bind['id_user_group'] = $data->id_user_group;
        $this->bind['level_access'] = $data->level_access;
        $this->bind['status_atpm'] = $data->status_atpm;
        $this->bind['password'] = '';

        $this->emit('openModal');
    }

    public function editProcess(UserRepository $userRepository)
    {
        $this->validate();

        $data = array(
            'username' => $this->bind['username'],
            'nama_user' => $this->bind['nama_user'],
            'email' => $this->bind['email'],
            'id_user_group' => $this->bind['id_user_group'],
            'level_access' => $this->bind['level_access'],
            'status_atpm' => $this->bind['status_atpm'],
        );

        $where = array('id_user' => $this->bind['id_user']);

        $count = $userRepository->findDuplicateEdit($where, $this->bind['id_user']);

        if($count >= 1) {
            session()->flash('message_duplicate', '<div class="alert alert-warning"><strong>'.$this->bind['username'].'</strong> Already Exists!</div>');
        } else {
            $update = $userRepository->update($this->bind['id_user'], $data);

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

    public function deleteProcess(UserRepository $userRepository)
    {
        $delete = $userRepository->massDeleteUser($this->checked);
        
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
