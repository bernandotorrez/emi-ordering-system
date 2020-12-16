<?php

namespace App\Repository\Eloquent;

use App\Models\RangeMonthFixOrder;

class RangeMonthFixOrderRepository extends BaseRepository
{
    public function __construct(RangeMonthFixOrder $model)
    {
        parent::__construct($model);
    }

    public function getByIdMonth($idMonth)
    {
        return $this->model->where(['status' =>'1', 'id_month' => $idMonth])
        ->with('month')
        ->get();
    }
}