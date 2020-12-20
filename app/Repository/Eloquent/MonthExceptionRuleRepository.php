<?php

namespace App\Repository\Eloquent;

use App\Models\MonthExceptionRule;

class MonthExceptionRuleRepository extends BaseRepository
{
    public function __construct(MonthExceptionRule $model)
    {
        parent::__construct($model);
    }

    public function getByIdDealerAndIdMonth($idDealer, $idMonth)
    {
        return $this->model->where([
            'status' => '1', 
            'id_dealer' => $idDealer, 
            'id_month' => $idMonth
        ])
        ->orWhere(['status' => '1', 'id_dealer' => '0'])
        ->first();
    }
}