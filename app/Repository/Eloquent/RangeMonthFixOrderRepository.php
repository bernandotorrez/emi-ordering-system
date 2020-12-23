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
        ->orderBy('month_id_to', 'ASC')
        ->get();
    }

    public function getMonthIdToByIdMonth($idMonth)
    {
        return $this->model->where(['status' => '1', 'id_month' => $idMonth])
        ->orderBy('month_id_to', 'ASC')
        ->first();
    }

    public function getByIdMonthAndMonthIdTo($idMonth, $monthIdTo)
    {
        return $this->model->where(['status' => '1', 'id_month' => $idMonth, 'month_id_to' => $monthIdTo])
        ->orderBy('month_id_to', 'ASC')
        ->first();
    }
}