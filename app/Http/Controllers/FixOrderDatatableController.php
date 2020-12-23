<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MasterFixOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\DetailColourFixOrderRepository;
use App\Repository\Eloquent\DetailFixOrderRepository;
use App\Repository\Eloquent\RangeMonthFixOrderRepository;

class FixOrderDatatableController extends Controller
{
    // In Dealer Admin
    public function FixOrderJson(
        Request $request, 
        MasterFixOrderRepository $masterFixOrderRepository,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository
    ) {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $month = $request->get('month');
        $monthIdTo = $rangeMonthFixOrderRepository->getMonthIdToByIdMonth(date('m'));
        $cache_name = 'datatable-fixOrderJson-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterFixOrderRepository, $idUser, $idDealer, $cache_name, $month, $monthIdTo){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterFixOrderRepository->getByIdDealerAndMonth($idDealer, $month ? $month : $monthIdTo->month_id_to);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            if($data->flag_send_approval_dealer == '1') {
                return '<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                <input type="checkbox" checked class="new-control-input child-chk select-customers-info" id="customer-all-info" disabled>
                <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                </label>';
            } else {
                return '<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                <input type="checkbox" class="new-control-input child-chk checkId" 
                onclick="updateCheck('.$data->id_master_fix_order_unit.')" 
                id="'.$data->id_master_fix_order_unit.'" 
                value="'.$data->id_master_fix_order_unit.'">
                <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                </label>
                ';
            }

        })
        ->addColumn('status_progress', function($data) {
            $statusProgress = $this->checkStatusProgress($data);

            return $statusProgress;
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailFixOrderJson/' . $data->id_master_fix_order_unit);
        })
        ->make(true);
    }

    // In Dealer Principle
    public function FixOrderJsonApprovalBM(
        Request $request, 
        MasterFixOrderRepository $masterFixOrderRepository,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository
    ) {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $month = $request->get('month');
        $monthIdTo = $rangeMonthFixOrderRepository->getMonthIdToByIdMonth(date('m'));
        $cache_name = 'datatable-FixOrderJsonApprovalBM-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterFixOrderRepository, $idUser, $idDealer, $cache_name, $month, $monthIdTo){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterFixOrderRepository->getByIdDealerAndMonthApprovalBM($idDealer, $month ? $month : $monthIdTo->month_id_to);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            if($data->flag_approval_dealer == '1' && $data->flag_submit_to_atpm == '1') {
                return '<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                <input type="checkbox" checked class="new-control-input child-chk select-customers-info" id="customer-all-info" disabled>
                <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                </label>';
            } else {
                return '<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                <input type="checkbox" class="new-control-input child-chk checkId" 
                onclick="updateCheck('.$data->id_master_fix_order_unit.', '.$data->flag_approval_dealer.')" 
                id="'.$data->id_master_fix_order_unit.'" 
                data-approved="'.$data->flag_approval_dealer.'"
                value="'.$data->id_master_fix_order_unit.'">
                <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                </label>
                ';
            }
        })
        ->addColumn('status_progress', function($data) {
            $statusProgress = $this->checkStatusProgress($data);

            return $statusProgress;
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailFixOrderJson/' . $data->id_master_fix_order_unit);
        })
        ->make(true);
    }

     // In ATPM
     public function FixOrderJsonAllocationAtpm(
        Request $request, 
        MasterFixOrderRepository $masterFixOrderRepository,
        RangeMonthFixOrderRepository $rangeMonthFixOrderRepository
    ) {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $month = $request->get('month');
        $monthIdTo = $rangeMonthFixOrderRepository->getMonthIdToByIdMonth(date('m'));
        $cache_name = 'datatable-FixOrderJsonAllocationAtpm-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterFixOrderRepository, $idUser, $idDealer, $cache_name, $month, $monthIdTo){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterFixOrderRepository->getByIdDealerAndMonthAllocationAtpm($idDealer, $month ? $month : $monthIdTo->month_id_to);
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            if($data->flag_allocation == '1') {
                return '<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                <input type="checkbox" checked class="new-control-input child-chk select-customers-info" id="customer-all-info" disabled>
                <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                </label>';
            } else {
                return '<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                <input type="checkbox" class="new-control-input child-chk checkId" 
                onclick="updateCheck('.$data->id_master_fix_order_unit.', '.$data->flag_approval_dealer.')" 
                id="'.$data->id_master_fix_order_unit.'" 
                data-approved="'.$data->flag_approval_dealer.'"
                value="'.$data->id_master_fix_order_unit.'">
                <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
                </label>
                ';
            }
        })
        ->addColumn('status_progress', function($data) {
            $statusProgress = $this->checkStatusProgress($data);

            return $statusProgress;
        })
        ->addColumn('details_url', function($data) {
            return url('datatable/detailFixOrderJson/' . $data->id_master_fix_order_unit);
        })
        ->make(true);
    }

    public function detailFixOrderJson($id, DetailFixOrderRepository $detailFixOrderRepository)
    {
        $cache_name = 'datatable-detail-fixOrderJson-id-'.$id;
        $data = Cache::remember($cache_name, 10, function () use($detailFixOrderRepository, $id, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $detailFixOrderRepository->getByIdMaster($id);
        });

        return Datatables::of($data)
        ->addColumn('details_url', function($data) {
            return url('datatable/subDetailFixOrderJson/' . $data->id_detail_fix_order_unit);
        })->make(true);
    }

    public function subDetailFixOrderJson($id, DetailColourFixOrderRepository $detailColourFixOrderRepository)
    {
        $cache_name = 'datatable-sub-detail-fixOrderJson-id-'.$id;
        $data = Cache::remember($cache_name, 10, function () use($detailColourFixOrderRepository, $id, $cache_name){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => session()->get('user')['id_user']]);
            return $detailColourFixOrderRepository->getByIdDetail($id);
        });

        return Datatables::of($data)->make(true);
    }

    private function checkStatusProgress($data)
    {
        $flag_send_approval_dealer = $data->flag_send_approval_dealer;
        $flag_approval_dealer = $data->flag_approval_dealer;
        $flag_submit_to_atpm = $data->flag_submit_to_atpm;
        $flag_allocation = $data->flag_allocation;

        if($flag_send_approval_dealer == '0' && $flag_approval_dealer == '0' 
        && $flag_submit_to_atpm == '0' && $flag_allocation == '0') {
            $statusProgress = 'Draft';
        } else if($flag_send_approval_dealer == '1' && $flag_approval_dealer == '0' 
        && $flag_submit_to_atpm == '0' && $flag_allocation == '0') {
            $statusProgress = 'Waiting Approval';
        } else if($flag_send_approval_dealer == '1' && $flag_approval_dealer == '1' 
        && $flag_submit_to_atpm == '0' && $flag_allocation == '0') {
            $statusProgress = 'Approved';
        } else if($flag_send_approval_dealer == '1' && $flag_approval_dealer == '1' 
        && $flag_submit_to_atpm == '1' && $flag_allocation == '0') {
            $statusProgress = 'Submitted';
        }  else if($flag_send_approval_dealer == '1' && $flag_approval_dealer == '1' 
        && $flag_submit_to_atpm == '1' && $flag_allocation == '1') {
            $statusProgress = 'Allocated';
        } elseif($flag_send_approval_dealer == '2' && $flag_approval_dealer == '0' 
        && $flag_submit_to_atpm == '0' && $flag_allocation == '0') {
            $statusProgress = 'Revised';
        } else {
            $statusProgress = '-';
        }

        return $statusProgress;
    }
}
