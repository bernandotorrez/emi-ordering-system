<?php

namespace App\Http\Livewire\Page\UserGroup;

use App\Repository\Eloquent\UserGroupRepository;
use App\Traits\WithSorting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cache as CacheModel;

class UserGroupIndex extends Component
{
    use WithPagination;
    use WithSorting;

    /**
     * Pagination Attributes
     */
    protected $paginationTheme = 'bootstrap';
    public array $perPage = [10, 15, 20, 25, 50];
    public int $perPageSelected = 10;
    public string $search = '';
    protected $idUser = '';

    /**
     * Page Attributes
     */
    protected string $pageTitle = "User Group";
    public bool $is_edit = false, $allChecked = false, $insertDuplicate = false;
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
        'bind.nama_group.required' => 'The Model Name Cant be Empty!',
        'bind.nama_group.min' => 'The Model Name must be at least 3 Characters',
        'bind.nama_group.max' => 'The Model Name Cant be maximal 100 Characters',
    ];

    public function mount()
    {
        $this->sortBy = 'nama_group';
        $this->idUser = session()->get('user')['id_user'];
        $this->fill(request()->only('search', 'page'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->insertDuplicate = false;
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
        $cache_name .= '-sortby-'.$this->sortBy.'-sortdirection-'.$this->sortDirection.'-user-'.$this->idUser;

        $dataUserGroup = Cache::remember($cache_name, 60, function () use($userGroupRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $this->idUser]);
            return $userGroupRepository->allActive();
        });

        dd($dataUserGroup);

        return view('livewire.page.user-group.user-group-index', ['dataUserGroup' => $dataUserGroup])
        ->layouts('layout.app', ['title' => $this->pageTitle]);
    }
}
