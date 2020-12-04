<?php

namespace App\Repository\Eloquent;

use App\Models\ChildMenu;

class ChildMenuRepository extends BaseRepository
{
    public function __construct(ChildMenu $model)
    {
        parent::__construct($model);
    }

    public function getByIdParent($id)
    {
        return $this->model->where(['status' => '1', 'id_parent_menu' => $id])->get();
    }

    public function getByIdParents($arrayId)
    {
        return $this->model->whereIn('id_parent_menu', $arrayId)->get();
    }

    public function deleteByParent(array $arrayId)
    {
        $this->model->whereIn('id_parent_menu', $arrayId)->update(['status' => '0']); 
    }
}