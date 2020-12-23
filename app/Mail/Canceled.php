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

class Canceled extends Mailable
{
    use Queueable, SerializesModels;

    protected $id = '';
    protected $order = '';
    protected $by = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $order, $by)
    {
        $this->id = $id;
        $this->order = $order;
        $this->by = $by;
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

            return $this->subject('No Additional Order Dealer : '.$dataMaster->no_order_dealer.' Canceled!')
            ->view('email.additional-order.canceled', [
                'dataMaster' => $dataMaster,
                'dataDetail' => $dataDetail,
                'by' => $this->by
            ]);
        } else {
            $dataMaster = $masterFixOrderRepository->getById($this->id);
            $dataDetail = $detailFixOrderRepository->getByIdMaster($this->id);

            return $this->subject('No Fix Order Dealer : '.$dataMaster->no_order_dealer.' Canceled!')
            ->view('email.fix-order.canceled', [
                'dataMaster' => $dataMaster,
                'dataDetail' => $dataDetail,
                'by' => $this->by
            ]);
        }

    }
}
