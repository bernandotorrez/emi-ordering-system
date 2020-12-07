<?php

namespace App\Repository\Eloquent;

use App\Models\DetailAdditionalOrderUnit;
use App\Models\MasterAdditionalOrderUnit;
use Illuminate\Support\Facades\DB;

class MasterAdditionalOrderRepository extends BaseRepository
{
    public function __construct(MasterAdditionalOrderUnit $model)
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
                $insertDetail = $insertMaster->detailAdditionalOrderUnit()->createMany($dataDetail);
            }

            return $insertMaster;
        }, 5);

        return $insert;
    }

    public function updateDealerOrder($idMaster, $dataMaster, $dataDetail)
    {
        $update = DB::transaction(function () use($idMaster, $dataMaster, $dataDetail) {
            $updateMaster = MasterAdditionalOrderUnit::where($this->primaryKey, $idMaster)
            ->update($dataMaster);
            if($updateMaster) {
                foreach($dataDetail as $key => $detail) {
                    $updateData = array(
                        'id_master_additional_order_unit' => $idMaster,
                        'id_model' => $dataDetail[$key]['id_model'],
                        'model_name' => $dataDetail[$key]['model_name'],
                        'id_colour' => $dataDetail[$key]['id_colour'],
                        'colour_name' => $dataDetail[$key]['colour_name'],
                        'id_type' => $dataDetail[$key]['id_type'],
                        'type_name' => $dataDetail[$key]['type_name'],
                        'qty' => $dataDetail[$key]['qty'],
                        'year_production' => $dataDetail[$key]['year_production'],
                    );
                    if($dataDetail[$key]['id_detail_additional_order_unit'] == '') {
                        $insertDetail = DetailAdditionalOrderUnit::create($updateData);
                    } else {
                        $updateDetail = DetailAdditionalOrderUnit::where('id_detail_additional_order_unit', 
                        $dataDetail[$key]['id_detail_additional_order_unit'])
                        ->update($updateData);
                    }
                }
            }

            return $updateMaster;
        }, 5);

        return $update;
    }

    public function getWaitingApprovalDealerPrinciple()
    {
        return $this->model->where(['status' => '1', 'flag_send_approval_dealer' => '1'])->get();
    }
}