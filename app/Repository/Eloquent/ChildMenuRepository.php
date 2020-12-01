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
        return $this->model->where(['status' => '1', $this->primaryKey => $id])->get();
    }

    public function getByIdParents($arrayId)
    {
        return $this->model->whereIn($this->primaryKey, $arrayId)->get();
    }

    public function deleteByParent(array $arrayId)
    {
        $this->model->whereIn($this->primaryKey, $arrayId)->update(['status' => '0']); 
    }
}