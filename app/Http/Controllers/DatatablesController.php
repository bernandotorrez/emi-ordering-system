<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\DetailAdditionalOrderRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Illuminate\Support\Facades\Cache;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function additionalOrderJson(MasterAdditionalOrderRepository $masterAdditionalOrderRepository)
    {
        $datas = Cache::remember('datatable-additionalOrderJson', 10, function () use($masterAdditionalOrderRepository){
            return $masterAdditionalOrderRepository->allActive();
        });

        return Datatables::of($datas)
        // ->addColumn('action', function($data) {
        //     return '<input type="checkbox" class="new-control-input" data-id='.$data->id.' 
        //     wire:key='.$data->id.' wire:click="updateId('.$data->id.')">';
        // })
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
