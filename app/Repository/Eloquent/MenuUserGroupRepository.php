<?php

namespace App\Repository\Eloquent;

use App\Models\MenuUserGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MenuUserGroupRepository extends BaseRepository
{
    protected $relation = ['parentsMenu.childsMenu.subChildsMenu.subSubChildsMenu'];

    public function __construct(MenuUserGroup $model)
    {
        parent::__construct($model);
    }

    public function getDynamicMenu($idUserGroup)
    {
        return $this->model->whereHas($this->relation, function(Builder $query) {
            $query->where('status', '1');
        })->get();
    }

    public function getByIdUserGroup($idUserGroup)
    {
        return $this->model->where(['status' => '1', 'id_user_group' => $idUserGroup])->get();
    }

    public function getMenuPrivilege($idUserGroup)
    {
        return DB::table('view_menu_user_group')
        ->where('id_user_group', $idUserGroup)
        ->get();
    }
}