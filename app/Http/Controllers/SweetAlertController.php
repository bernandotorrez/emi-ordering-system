<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SweetAlertController extends Controller
{
    public function sendToApproval(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');

        $data = array(
            'flag_send_approval_dealer' => '1',
            'date_send_approval' => date('Y-m-d H:i:s')
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        if($update) {
            $callback = array(
                'status' => 'success',
            );
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }
}
