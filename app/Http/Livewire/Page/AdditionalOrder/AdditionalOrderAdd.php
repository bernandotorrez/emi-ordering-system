<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AdditionalOrderAdd extends Component
{
    use WithWrsApi;

    public $pageTitle = 'Additional Order - Add';
    public array $detailData = [];
    public $id_model = 0;
    
    public array $bind = [
        'order_number_number' => ''
    ];
    
    public function mount()
    {
        $data = array(
            'no' => 1,
            'id_model' => '',
            'model_name' => '',
            'id_type' => '',
            'type_name' => '',
            'total_qty' => 0,
            'year_prod' => ''
        );

        array_push($this->detailData, $data);
    }

    public function addDetail()
    {
        $end = end($this->detailData);

        $data = array(
            'no' => floatval($end['no'] + 1),
            'id_model' => '',
            'model_name' => '',
            'id_type' => '',
            'type_name' => '',
            'total_qty' => 0,
            'year_prod' => ''
        );

        array_push($this->detailData, $data);
    }

    public function deleteDetail($key)
    {
        unset($this->detailData[$key]);
    }

    public function render()
    {
        $dealerName = Http::get($this->wrsApi.'/dealer/get/'.session()->get('user')['id_dealer']);
        $dataModel = Http::get($this->wrsApi.'/model');
        $dataType = Http::get($this->wrsApi.'/type-model/get/fk_model/'.$this->id_model);

        return view('livewire.page.additional-order.additional-order-add', [
            'dealerName' => $dealerName['data']['nm_dealer'],
            'dataModel' => $dataModel['data'],
            'dataType' => $dataType['data'],
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }
}
