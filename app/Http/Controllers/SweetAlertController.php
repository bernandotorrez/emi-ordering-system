<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Illuminate\Http\Request;

class SweetAlertController extends Controller
{
    public function sendToApproval(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');
        $data = array('flag_send_approval_dealer' => 'flag_send_approval_dealer');
        $update = $masterAdditionalOrderRepository->update($id, $data);

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
