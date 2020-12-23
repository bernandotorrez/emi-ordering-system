<?php

namespace App\Http\Controllers;

use App\Mail\Allocated;
use App\Mail\Approved;
use App\Mail\Revised;
use App\Mail\SendEmailToDealerPrinciple;
use App\Mail\Submitted;
use App\Mail\WaitingApproval;
use App\Repository\Api\ApiDealerUserRepository;
use App\Repository\Eloquent\KodeTahunRepository;
use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Traits\WithDeleteCache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FixOrderSweetAlertController extends Controller
{
    use WithDeleteCache;

    public function sendToApproval(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository,
        ApiDealerUserRepository $apiDealerUserRepository
    ) {
        $id = $request->post('id');
        $month = $request->post('id_month');

        $data = array(
            'flag_send_approval_dealer' => '1',
            'date_send_approval' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterFixOrderRepository, $id, $data) {
            return $masterFixOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-fixOrderJson-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);
            $this->deleteCache();

            Mail::to($this->getEmailTo($apiDealerUserRepository))->send(new WaitingApproval($id, 'F'));
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function approvalBM(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository,
        ApiDealerUserRepository $apiDealerUserRepository
    ) {
        $id = $request->post('id');
        $month = $request->post('id_month');

        $data = array(
            'flag_approval_dealer' => '1',
            'date_approval' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterFixOrderRepository, $id, $data) {
            return $masterFixOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-FixOrderJsonApprovalBM-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);
            $this->deleteCache();

            Mail::to($this->getEmailTo($apiDealerUserRepository))->send(new Approved($id, 'F'));
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function reviseBM(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository,
        ApiDealerUserRepository $apiDealerUserRepository
    ) {
        $id = $request->post('id');
        $month = $request->post('id_month');
        $remark_revise = $request->post('remark_revise');

        $data = array(
            'flag_send_approval_dealer' => '2',
            'flag_approval_dealer' => '0',
            'remark_revise' => $remark_revise,
            'date_revise' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterFixOrderRepository, $id, $data) {
            return $masterFixOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-FixOrderJsonApprovalBM-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);
            $this->deleteCache();

            Mail::to($this->getEmailTo($apiDealerUserRepository))->send(new Revised($id, 'F'));
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function planningToAtpm(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository
    ) {
        $id = $request->post('id');
        $month = $request->post('id_month');

        $data = array(
            'flag_planning' => '1',
            'date_planning' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterFixOrderRepository, $id, $data) {
            return $masterFixOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-FixOrderJsonApprovalBM-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);
            $this->deleteCache();

            //Mail::to('Bernand.Hermawan@eurokars.co.id')->send(new SendEmailToDealerPrinciple);
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function submitToAtpm(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository,
        KodeTahunRepository $kodeTahunRepository,
        ApiDealerUserRepository $apiDealerUserRepository
    ) {
        $id = $request->post('id');
        $month = $request->post('id_month');

        $update = $masterFixOrderRepository->updateSubmitAtpm($id, $kodeTahunRepository);

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-FixOrderJsonApprovalBM-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);
            $this->deleteCache();

            Mail::to($this->getEmailTo($apiDealerUserRepository))->send(new Submitted($id, 'F'));
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    public function allocatedAtpm(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository,
        KodeTahunRepository $kodeTahunRepository,
        ApiDealerUserRepository $apiDealerUserRepository
    ) {
        $id = $request->post('id');
        $month = $request->post('id_month');

        $data = array(
            'flag_allocation' => '1',
            'date_allocation_atpm' => Carbon::now()
        );
        
        $update = DB::transaction(function () use($masterFixOrderRepository, $id, $data) {
            return $masterFixOrderRepository->massUpdate($id, $data);
        });

        $idUser = session()->get('user')['id_user'];
        $idDealer = session()->get('user')['id_dealer'];

        if($update) {
            $callback = array(
                'status' => 'success',
            );

            $this->deleteCaches('datatable-FixOrderJsonAllocationAtpm-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);
            $this->deleteCache();
            // TODO: $this->deleteCaches('datatable-FixOrderJsonApprovedBM-idUser-'.$idUser.'-idDealer-'.$idDealer.'-month-'.$month);

            Mail::to($this->getEmailTo($apiDealerUserRepository))->send(new Allocated($id, 'F'));
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    private function getEmailTo($apiDealerUserRepository)
    {
        $idDealer = session()->get('user')['id_dealer'];
        $cache_name = 'api-apiDealerUserRepository->getByIdDealer-idDealer-'.$idDealer;
        $dataDealer = Cache::remember($cache_name, 60, function () use($apiDealerUserRepository, $idDealer) {
            return $apiDealerUserRepository->getByIdDealer($idDealer);
        });

        $email = array();
        foreach($dataDealer['data'] as $dealer) {
            if($dealer['fk_dealer_level'] == 'BM') {
                array_push($email, $dealer['email']);
            }
        }

        if (App::environment(['local', 'staging'])) {
            return ['Bernand.Hermawan@eurokars.co.id'];
        } else {
            return $email;
        }

        // TODO: return $email;
        // 'evan.yofiyanto@Mazda.co.id'
        
    }

    private function getEmailUser($id, $masterAdditionalOrderRepository)
    {
        $dataMaster = $masterAdditionalOrderRepository->getById($id);
        if (App::environment(['local', 'staging'])) {
            return ['Bernand.Hermawan@eurokars.co.id'];
        } else {
            return $dataMaster->email;
        }
    }

    private function deleteCaches($cacheName) {
        $idUser = session()->get('user')['id_user'];
        Cache::forget($cacheName);
    }
}
