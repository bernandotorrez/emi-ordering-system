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
    protected array $relation = ['subChildMenu', 'childMenu', 'parentMenu'];

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public $bind = [
        'id_sub_sub_child_menu' => '',
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

        $dataSubSubChildMenu = Cache::remember('key', 60, function () use($subSubChildMenuRepository, $cache_name) {
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $subSubChildMenuRepository->paginationWithRelation(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
                $this->perPageSelected,
                $this->relation
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
        $datas = $subSubChildMenuRepository->checked(
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
}
