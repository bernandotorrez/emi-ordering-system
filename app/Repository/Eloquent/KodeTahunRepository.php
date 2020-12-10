<?php

namespace App\Repository\Eloquent;

use App\Models\KodeTahun;
use Carbon\Carbon;

class KodeTahunRepository
{
    protected $model;

    public function __construct(KodeTahun $model)
    {
        $this->model = $model;
    }

    public function getOrderSequence($id)
    {
        $typeOrder = 'A';
        $dataTahun = $this->model->where('tahun',  Carbon::now()->year)->first();

        if($id < 10) {
            $sequence = '0000'.$id;
        } else if($id < 100) {
            $sequence = '000'.$id;
        } else if($id < 1000) {
            $sequence = '00'.$id;
        } else if($id < 10000) {
            $sequence = '0'.$id;
        } else {
            $sequence = $id;
        }

        $orderSequence = $typeOrder.$dataTahun->kode.$sequence;

        return $orderSequence;
    }
}