<?php

namespace App\Mail;

use App\Repository\Eloquent\DetailAdditionalOrderRepository;
use App\Repository\Eloquent\DetailFixOrderRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use App\Repository\Eloquent\MasterFixOrderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Allocated extends Mailable
{
    use Queueable, SerializesModels;

    protected $id = '';
    protected $order = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $order)
    {
        $this->id = $id;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository, 
        MasterFixOrderRepository $masterFixOrderRepository,
        DetailAdditionalOrderRepository $detailAdditionalOrderRepository,
        DetailFixOrderRepository $detailFixOrderRepository
    ) {
        if($this->order == 'A') {
            $dataMaster = $masterAdditionalOrderRepository->getById($this->id);
            $dataDetail = $detailAdditionalOrderRepository->getByIdMaster($this->id);

            return $this->subject('No Additional Order Dealer : '.$dataMaster->no_order_dealer.' Allocated!')
            ->view('email.additional-order.allocated', [
                'dataMaster' => $dataMaster,
                'dataDetail' => $dataDetail
            ]);
        } else {
            $dataMaster = $masterFixOrderRepository->getById($this->id);
            $dataDetail = $detailFixOrderRepository->getByIdMaster($this->id);

            return $this->subject('No Fix Order Dealer : '.$dataMaster->no_order_dealer.' Allocated!')
            ->view('email.fix-order.allocated', [
                'dataMaster' => $dataMaster,
                'dataDetail' => $dataDetail
            ]);
        }

    }
}
