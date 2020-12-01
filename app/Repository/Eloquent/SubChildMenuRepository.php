<?php

namespace App\Repository\Eloquent;

use App\Models\SubchildMenu;

class SubChildMenuRepository extends BaseRepository
{
    public function __construct(SubchildMenu $model)
    {
        parent::__construct($model);
    }

    public function deleteByChild(array $arrayId, $childMenuRepository)
    {
        $dataChildMenu = $childMenuRepository->getByIdParents($arrayId);
 
        $arrayIdChild = array();

        foreach($dataChildMenu as $childMenu)
        {
           array_push($arrayIdChild, $childMenu->id_child_menu);
        }

        $this->model->whereIn($this->primaryKey, $arrayIdChild)->update(['status' => '0']);
    }
}