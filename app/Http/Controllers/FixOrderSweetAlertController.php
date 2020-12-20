<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailToDealerPrinciple;
use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Traits\WithDeleteCache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FixOrderSweetAlertController extends Controller
{
    use WithDeleteCache;

    public function sendToApproval(
        Request $request,
        MasterFixOrderRepository $masterFixOrderRepository
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

            Mail::to('Bernand.Hermawan@eurokars.co.id')->send(new SendEmailToDealerPrinciple);
        } else {
            $callback = array(
                'status' => 'fail',
            );
        }

        return $callback;
    }

    private function deleteCaches($cacheName) {
        $idUser = session()->get('user')['id_user'];
        Cache::forget($cacheName);
    }
}
