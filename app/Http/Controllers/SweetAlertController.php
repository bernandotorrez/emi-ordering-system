<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SweetAlertController extends Controller
{
    private array $cache = [
        'send_to_approval' => 'datatable-additionalOrderJsonDraft-idDealer-',
        'waiting_approval_dealer_principle' => 'datatable-additionalOrderJsonWaitingApprovalDealerPrinciple-idDealer-',
        'approval_dealer_principle' => 'datatable-additionalOrderJsonApprovalDealerPrinciple-idDealer-',
        'submitted_atpm' => 'datatable-additionalOrderJsonSubmittedATPM-idDealer-',
        'atpm_allocation' => 'datatable-additionalOrderJsonATPMAllocation-idDealer-',
    ];

    public function sendToApproval(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');

        $data = array(
            'flag_send_approval_dealer' => '1',
            'date_send_approval' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCache('send_to_approval');
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function approvedBM(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');

        $data = array(
            'flag_approval_dealer' => '1',
            'date_approval' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCache('waiting_approval_dealer_principle');
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    private function deleteCache($status) {
        $idDealer = session()->get('user')['id_dealer'];
        Cache::forget($this->cache[$status].$idDealer);
    }
}
