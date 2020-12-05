<?php

namespace App\Repository\Eloquent;

use App\Models\MasterAdditionalOrderUnit;
use Illuminate\Support\Facades\DB;

class MasterAdditionalOrderRepository extends BaseRepository
{
    public function __construct(MasterAdditionalOrderUnit $model)
    {
        parent::__construct($model);
    }

    public function createDealerOrder($dataMaster, $dataDetail)
    {
        $insert = DB::transaction(function () use($dataMaster, $dataDetail) {
            $insertMaster = $this->model->create($dataMaster);
            if($insertMaster) {
                $insertDetail = $insertMaster->detailAdditionalOrderUnit()->createMany($dataDetail);
            }

            return $insertMaster;
        }, 5);

        return $insert;
    }
}