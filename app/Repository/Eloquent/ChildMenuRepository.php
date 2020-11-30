<?php

namespace App\Repository\Eloquent;

use App\Models\ChildMenu;

class ChildMenuRepository extends BaseRepository
{
    public function __construct(ChildMenu $model)
    {
        parent::__construct($model);
    }
}