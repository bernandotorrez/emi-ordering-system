<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MasterFixOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use App\Models\Cache as CacheModel;
use App\Repository\Eloquent\DetailColourFixOrderRepository;
use App\Repository\Eloquent\DetailFixOrderRepository;

class FixOrderDatatableController extends Controller
{
    public function FixOrderJson(Request $request, MasterFixOrderRepository $masterFixOrderRepository)
    {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $month = $request->get('month');
        $cache_name = 'datatable-fixOrderJson-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month;
        $datas = Cache::remember($cache_name, 10, 
        function () use($masterFixOrderRepository, $idUser, $idDealer, $cache_name, $month){
            CacheModel::firstOrCreate(['cache_name' => $cache_name, 'id_user' => $idUser]);
            return $masterFixOrderRepository->getByIdDealerAndMonth($idDealer, $month ? $month : date('m'));
        });

        return Datatables::of($datas)
        ->addColumn('action', function($data) {
            return '<input type="checkbox" class="new-control-input checkId" 
            onclick="updateCheck('.$data->id_master_fix_order_unit.')" 
            id="'.$data->id_master_fix_order_unit.'" 
            value="'.$data->id_master_fix_order_unit.'">';
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

}
