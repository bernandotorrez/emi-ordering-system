<?php

namespace App\Repository\Eloquent;

use App\Models\MasterFixOrderUnit;
use Illuminate\Support\Facades\DB;

class MasterFixOrderRepository extends BaseRepository
{
    public function __construct(MasterFixOrderUnit $model)
    {
        parent::__construct($model);
    }

    public function getByIdDealer($id)
    {
        return $this->model->where(['status' => '1', 'id_dealer' => $id])->get();
    }

    public function createDealerOrder($dataMaster, $dataDetail)
    {
        $insert = DB::transaction(function () use($dataMaster, $dataDetail) {
            $insertMaster = $this->model->create($dataMaster);
            if($insertMaster) {
                $insertDetail = $insertMaster->detailFixOrderUnit()->createMany($dataDetail);

                if($insertDetail) {
                    $insertDetailColour = $insertDetail->detailColorFixOrder()->createMany($dataDetail['selected_colour']);
                }
            }

            return $insertMaster;
        }, 5);

        return $insert;
    }
}