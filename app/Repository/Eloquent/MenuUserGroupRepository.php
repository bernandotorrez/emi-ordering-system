<?php

namespace App\Repository\Eloquent;

use App\Models\MenuUserGroup;

class MenuUserGroupRepository extends BaseRepository
{
    public function __construct(MenuUserGroup $model)
    {
        parent::__construct($model);
    }
}