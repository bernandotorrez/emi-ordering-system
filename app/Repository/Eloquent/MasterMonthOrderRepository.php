<?php

namespace App\Repository\Eloquent;

use App\Models\MasterMonthOrder;

class MasterMonthOrderRepository extends BaseRepository
{
    public function __construct(MasterMonthOrder $model)
    {
        parent::__construct($model);
    }
}