<?php

namespace App\Repository\Eloquent;

use App\Models\DetailFixOrderUnit;

class DetailFixOrderRepository extends BaseRepository
{
    public function __construct(DetailFixOrderUnit $model)
    {
        parent::__construct($model);
    }

    public function getByIdMaster($id)
    {
        return $this->model->where(['status' => '1', 'id_master_fix_order_unit' => $id])->get();
    }
}