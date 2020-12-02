<?php

namespace App\Repository\Eloquent;

use App\Models\MenuUserGroup;
use Illuminate\Database\Eloquent\Builder;

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
}