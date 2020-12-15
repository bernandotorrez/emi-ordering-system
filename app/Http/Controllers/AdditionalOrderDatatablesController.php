<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\DetailAdditionalOrderRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;
use App\Models\Cache as CacheModel;

class AdditionalOrderDatatablesController extends Controller
{
    public function additionalOrderJsonDraft(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'datatable-additionalOrderJsonDraft-idUser-'.$idUser.'-idDealer-'.$idDealer;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterAdditionalOrderRepository, $idUser, $idDealer, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
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
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'datatable-additionalOrderJsonWaitingApprovalDealerPrinciple-idUser-'.$idUser.'-idDealer-'.$idDealer;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterAdditionalOrderRepository, $idUser, $idDealer, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
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
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'datatable-additionalOrderJsonApprovalDealerPrinciple-idUser-'.$idUser.'-idDealer-'.$idDealer;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterAdditionalOrderRepository, $idUser, $idDealer, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
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
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'datatable-additionalOrderJsonSubmittedATPM-idUser-'.$idUser.'-idDealer-'.$idDealer;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterAdditionalOrderRepository, $idUser, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterAdditionalOrderRepository->getSubmittedATPM();
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
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'datatable-additionalOrderJsonATPMAllocation-idUser-'.$idUser.'-idDealer-'.$idDealer;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterAdditionalOrderRepository, $idUser, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterAdditionalOrderRepository->getATPMAllocation();
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

    public function additionalOrderJsonCanceled(
        $idCancel = null,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'datatable-additionalOrderJsonCanceled-idUser-'.$idUser.'-idDealer-'.$idDealer.'-idCancel-'.$idCancel;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterAdditionalOrderRepository, $idUser, $idDealer, $idCancel, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterAdditionalOrderRepository->getCanceledAdditionalOrder($idDealer, $idCancel);
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
        $cache_name = 'datatable-detail-additionalOrderJson-id-'.$id;
        $data = Cache::remember($cache_name, 10, function () use($detailAdditionalOrderRepository, $id, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $detailAdditionalOrderRepository->getByIdMaster($id);
        });

        return Datatables::of($data)->make(true);
    }
}
