<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\KodeTahunRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SweetAlertController extends Controller
{
    private array $cache = [
        'send_to_approval' => 'datatable-additionalOrderJsonDraft-idUser-',
        'waiting_approval_dealer_principle' => 'datatable-additionalOrderJsonWaitingApprovalDealerPrinciple-idUser-',
        'approval_dealer_principle' => 'datatable-additionalOrderJsonApprovalDealerPrinciple-idUser-',
        'submitted_atpm' => 'datatable-additionalOrderJsonSubmittedATPM-idUser-',
        'atpm_allocation' => 'datatable-additionalOrderJsonATPMAllocation-idUser-',
        'canceled' => 'datatable-additionalOrderJsonCanceled-idUser-',
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

    public function submitToAtpm(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository,
        KodeTahunRepository $kodeTahunRepository
    ) {
        $id = $request->post('id');
        
        $update = $masterAdditionalOrderRepository->updateSubmitAtpm($id, $kodeTahunRepository);

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCache('approval_dealer_principle');
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function reviseBMDealer(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');

        $data = array(
            'flag_approval_dealer' => '0',
            'flag_send_approval_dealer' => '2',
            'date_revise_dealer' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCache('approval_dealer_principle');
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function cancelBMDealer(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');

        $data = array(
            'status' => '0',
            'date_cancel_dealer' => Carbon::now(),
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCache('approval_dealer_principle');
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    private function deleteCache($status) {
        $idUser = session()->get('user')['id_user'];
        Cache::forget($this->cache[$status].$idUser);
    }
}
