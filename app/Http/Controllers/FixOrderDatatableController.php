<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MasterFixOrderRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FixOrderDatatableController extends Controller
{
    public function FixOrderJson(MasterFixOrderRepository $masterFixOrderRepository)
    {
        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];
        $datas = $masterFixOrderRepository->allActive();

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
}
