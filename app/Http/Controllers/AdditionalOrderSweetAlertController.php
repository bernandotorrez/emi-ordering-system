<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailToDealerPrinciple;
use App\Repository\Eloquent\KodeTahunRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use App\Traits\WithDeleteCache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdditionalOrderSweetAlertController extends Controller
{
    use WithDeleteCache;

    private array $cache = [
        'send_to_approval' => 'datatable-additionalOrderJsonDraft-idUser-',
        'waiting_approval_dealer_principle' => 'datatable-additionalOrderJsonWaitingApprovalDealerPrinciple-idUser-',
        'approval_dealer_principle' => 'datatable-additionalOrderJsonApprovalDealerPrinciple-idUser-',
        'submitted_atpm' => 'datatable-additionalOrderJsonSubmittedATPM-idUser-',
        'atpm_allocation' => 'datatable-additionalOrderJsonATPMAllocation-idUser-',
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

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonDraft-idUser-'.$idUser.'-idDealer-'.$idDealer);

            Mail::to('Bernand.Hermawan@eurokars.co.id')->send(new SendEmailToDealerPrinciple);
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

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonWaitingApprovalDealerPrinciple-idUser-'.$idUser.'-idDealer-'.$idDealer);
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

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonApprovalDealerPrinciple-idUser-'.$idUser.'-idDealer-'.$idDealer);
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
        $remark_revise = $request->post('remark_revise');

        $data = array(
            'flag_approval_dealer' => '0',
            'flag_send_approval_dealer' => '2',
            'remark_revise' => $remark_revise,
            'date_revise' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonApprovalDealerPrinciple-idUser-'.$idUser.'-idDealer-'.$idDealer);
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
        $remark_cancel = $request->post('remark_cancel');

        $data = array(
            'status' => '0',
            'id_cancel_status' => '1',
            'remark_cancel' => $remark_cancel,
            'date_cancel' => Carbon::now(),
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonApprovalDealerPrinciple-idUser-'.$idUser.'-idDealer-'.$idDealer);
            $this->deleteCache();
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function submittedAtpm(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');

        $data = array(
            'flag_allocation' => '1',
            'date_allocation_atpm' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonSubmittedATPM-idUser-'.$idUser.'-idDealer-'.$idDealer);
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function cancelSubmitATPM(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');
        $remark_cancel = $request->post('remark_cancel');

        $data = array(
            'status' => '0',
            'id_cancel_status' => '2',
            'remark_cancel' => $remark_cancel,
            'date_cancel' => Carbon::now(),
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonSubmittedATPM-idUser-'.$idUser.'-idDealer-'.$idDealer);
            $this->deleteCache();
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function cancelAllocatedATPM(
        Request $request,
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository
    ) {
        $id = $request->post('id');
        $remark_cancel = $request->post('remark_cancel');

        $data = array(
            'status' => '0',
            'id_cancel_status' => '3',
            'remark_cancel' => $remark_cancel,
            'date_cancel' => Carbon::now(),
        );
        
        $update = DB::transaction(function () use($masterAdditionalOrderRepository, $id, $data) {
            return $masterAdditionalOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-additionalOrderJsonATPMAllocation-idUser-'.$idUser.'-idDealer-'.$idDealer);
            $this->deleteCache();
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    private function deleteCaches($status) {
        $idUser = session()->get('user')['id_user'];
        Cache::forget($status);
    }
}
