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

    public function getByIdDealer($idDealer)
    {
        return $this->model->where(['status' => '1', 'id_dealer' => $idDealer])->get();
    }

    public function getByIdDealerAndMonth($idDealer, $month)
    {
        return $this->model->where(['status' => '1', 'id_dealer' => $idDealer, 'id_month' => $month])->get(); 
    }

    public function createDealerOrder($dataMaster, $dataDetail)
    {
        $insert = DB::transaction(function () use($dataMaster, $dataDetail) {
            $insertMaster = DB::table('tbl_master_fix_order_unit')->insertGetId($dataMaster);

            foreach($dataDetail as $detail) {
                $dataInsertDetail = array(
                    'id_master_fix_order_unit' => $insertMaster,
                    'id_model' => $detail['id_model'],
                    'model_name' => $detail['model_name'],
                    'id_type' => $detail['id_type'],
                    'type_name' => $detail['type_name'],
                    'total_qty' => $detail['total_qty'],
                    'year_production' => $detail['year_production'],
                );

                $insertDetail = DB::table('tbl_detail_fix_order_unit')->insertGetId($dataInsertDetail);

                foreach($detail['selected_colour'] as $selectedColour) {
                    $dataInsertDetailColour = array(
                        'id_detail_fix_order_unit' => $insertDetail,
                        'id_colour' => $selectedColour['id_colour'],
                        'colour_name' => $selectedColour['colour_name'],
                        'qty' => $selectedColour['qty'],
                    );
                    $insertDetailColour = DB::table('tbl_detail_color_fix_order_unit')->insertGetId($dataInsertDetailColour);
                }
            }
            
            return $insertMaster;
        }, 5);

        return $insert;
    }
}