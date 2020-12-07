<?php

namespace App\Repository\Eloquent;

use App\Models\DetailAdditionalOrderUnit;
use Illuminate\Support\Facades\DB;

class DetailAdditionalOrderRepository extends BaseRepository
{
    public function __construct(DetailAdditionalOrderUnit $model)
    {
        parent::__construct($model);
    }

    public function getByIdMaster($id)
    {
        return $this->model->where(['status' => '1', 'id_master_additional_order_unit' => $id])->get();
    }
}