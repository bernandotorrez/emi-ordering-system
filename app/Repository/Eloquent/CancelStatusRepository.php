<?php

namespace App\Repository\Eloquent;

use App\Models\CancelStatus;

class CancelStatusRepository extends BaseRepository
{
    public function __construct(CancelStatus $model)
    {
        parent::__construct($model);
    }
}