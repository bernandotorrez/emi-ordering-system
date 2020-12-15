<?php

namespace App\Repository\Eloquent;

use App\Models\DetailColourFixOrderUnit;

class DetailColourFixOrderRepository extends BaseRepository
{
    public function __construct(DetailColourFixOrderUnit $model)
    {
        parent::__construct($model);
    }

    public function getByIdDetail($id)
    {
        return $this->model->where(['status' => '1', 'id_detail_fix_order_unit' => $id])->get();
    }
}