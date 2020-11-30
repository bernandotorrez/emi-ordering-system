<?php

namespace App\Repository\Eloquent;

use App\Models\ParentMenu;

class ParentMenuRepository extends BaseRepository
{
    public function __construct(ParentMenu $model)
    {
        parent::__construct($model);
    }

    public function orderByPosition()
    {
        return $this->model->where('status', '1')->orderBy('parent_position', 'asc')->get();
    }
}