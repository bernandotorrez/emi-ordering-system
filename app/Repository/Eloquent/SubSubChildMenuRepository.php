<?php

namespace App\Repository\Eloquent;

use App\Models\SubSubChildMenu;

class SubSubChildMenuRepository extends BaseRepository
{
    public function __construct(SubSubChildMenu $model)
    {
        parent::__construct($model);
    }
}