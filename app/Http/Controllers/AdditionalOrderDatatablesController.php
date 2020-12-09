<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\DetailAdditionalOrderRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;

class AdditionalOrderDatatablesController extends Controller
{
    public function additionalOrderJsonDraft(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $idDealer = session()->get('user')['id_dealer'];
        $datas = Cache::remember('datatable-additionalOrderJsonDraft-idDealer-'.$idDealer, 60, 
        function () use($masterAdditionalOrderRepository, $idDealer){
            return $masterAdditionalOrderRepository->getDraft($idDealer);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            return '<input type="checkbox" class="new-control-input checkId" 
            onclick="updateCheck('.$data->id_master_additional_order_unit.')" 
            id="'.$data->id_master_additional_order_unit.'" 
            value="'.$data->id_master_additional_order_unit.'">';
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailAdditionalOrderJson/' . $data->id_master_additional_order_unit);
        })
        ->make(true);
    }

    public function additionalOrderJsonWaitingApprovalDealerPrinciple(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $idDealer = session()->get('user')['id_dealer'];
        $datas = Cache::remember('datatable-additionalOrderJsonWaitingApprovalDealerPrinciple-idDealer-'.$idDealer, 10, 
        function () use($masterAdditionalOrderRepository, $idDealer){
            return $masterAdditionalOrderRepository->getWaitingApprovalDealerPrinciple($idDealer);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            return '<input type="checkbox" class="new-control-input checkId" 
            onclick="updateCheck('.$data->id_master_additional_order_unit.')" 
            id="'.$data->id_master_additional_order_unit.'" 
            value="'.$data->id_master_additional_order_unit.'">';
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailAdditionalOrderJson/' . $data->id_master_additional_order_unit);
        })
        ->make(true);
    }

    public function additionalOrderJsonApprovalDealerPrinciple(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $idDealer = session()->get('user')['id_dealer'];
        $datas = Cache::remember('datatable-additionalOrderJsonApprovalDealerPrinciple-idDealer-'.$idDealer, 10, 
        function () use($masterAdditionalOrderRepository, $idDealer){
            return $masterAdditionalOrderRepository->getApprovalDealerPrinciple($idDealer);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            return '<input type="checkbox" class="new-control-input checkId" 
            onclick="updateCheck('.$data->id_master_additional_order_unit.')" 
            id="'.$data->id_master_additional_order_unit.'" 
            value="'.$data->id_master_additional_order_unit.'">';
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailAdditionalOrderJson/' . $data->id_master_additional_order_unit);
        })
        ->make(true);
    }

    public function additionalOrderJsonSubmittedATPM(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $idDealer = session()->get('user')['id_dealer'];
        $datas = Cache::remember('datatable-additionalOrderJsonSubmittedATPM-idDealer-'.$idDealer, 10, 
        function () use($masterAdditionalOrderRepository, $idDealer){
            return $masterAdditionalOrderRepository->getApprovalDealerPrinciple($idDealer);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            return '<input type="checkbox" class="new-control-input checkId" 
            onclick="updateCheck('.$data->id_master_additional_order_unit.')" 
            id="'.$data->id_master_additional_order_unit.'" 
            value="'.$data->id_master_additional_order_unit.'">';
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailAdditionalOrderJson/' . $data->id_master_additional_order_unit);
        })
        ->make(true);
    }

    public function additionalOrderJsonATPMAllocation(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $idDealer = session()->get('user')['id_dealer'];
        $datas = Cache::remember('datatable-additionalOrderJsonATPMAllocation-idDealer-'.$idDealer, 10, 
        function () use($masterAdditionalOrderRepository, $idDealer){
            return $masterAdditionalOrderRepository->getATPMAllocation($idDealer);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            return '<input type="checkbox" class="new-control-input checkId" 
            onclick="updateCheck('.$data->id_master_additional_order_unit.')" 
            id="'.$data->id_master_additional_order_unit.'" 
            value="'.$data->id_master_additional_order_unit.'">';
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailAdditionalOrderJson/' . $data->id_master_additional_order_unit);
        })
        ->make(true);
    }

    public function detailAdditionalOrderJson($id, DetailAdditionalOrderRepository $detailAdditionalOrderRepository)
    {
        $data = Cache::remember('datatable-detail-additionalOrderJson-id-'.$id, 10, function () use($detailAdditionalOrderRepository, $id){
            return $detailAdditionalOrderRepository->getByIdMaster($id);
        });

        return Datatables::of($data)->make(true);
    }
}
