<?php

namespace App\Repository\Eloquent;

use App\Models\SubSubChildMenu;

class SubSubChildMenuRepository extends BaseRepository
{
    public function __construct(SubSubChildMenu $model)
    {
        parent::__construct($model);
    }

    public function deleteBySubChild(array $arrayId)
    {
        $this->model->whereIn('id_sub_child_menu', $arrayId)->update(['status' => '0']); 
    }
}