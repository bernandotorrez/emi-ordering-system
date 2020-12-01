<?php

namespace App\Repository\Eloquent;

use App\Models\SubchildMenu;

class SubChildMenuRepository extends BaseRepository
{
    public function __construct(SubchildMenu $model)
    {
        parent::__construct($model);
    }

    public function deleteByParent(array $arrayId)
    {
        $this->model->whereIn('id_parent_menu', $arrayId)->update(['status' => '0']); 
    }

    public function deleteByChild(array $arrayId)
    {
        $this->model->whereIn('id_child_menu', $arrayId)->update(['status' => '0']);
    }
}