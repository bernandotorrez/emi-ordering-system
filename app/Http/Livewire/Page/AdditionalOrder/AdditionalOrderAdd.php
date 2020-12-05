<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Cache;
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
            'year_prod' => '',
            'data_type' => []
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
            'year_prod' => '',
            'data_type' => []
        );

        array_push($this->detailData, $data);
    }

    public function deleteDetail($key)
    {
        unset($this->detailData[$key]);
    }

    public function updated()
    {
        
    }

    public function updateDataType($key, $value)
    {
        if($this->detailData[$key]['id_model'] != '') {
            $dataType = Cache::remember('data-type-with-id-model-'.$value, 30, function () use($value) {
                return Http::get($this->wrsApi.'/type-model/get/fk_model/'.$value)->json();
            });
            $this->detailData[$key]['data_type'] = ($dataType['count'] > 0) ? $dataType['data'] : [];
        }
        
    }

    public function render()
    {
        $dealerName = Cache::remember('dealer-name'.session()->get('user')['id_dealer'], 60, function () {
            return Http::get($this->wrsApi.'/dealer/get/'.session()->get('user')['id_dealer'])->json();
        });

        $dataModel = Cache::remember('data-model', 30, function () {
            return Http::get($this->wrsApi.'/model')->json();
        });

        return view('livewire.page.additional-order.additional-order-add', [
            'dealerName' => ($dealerName['count'] > 0) ? $dealerName['data']['nm_dealer'] : 'Admin',
            'dataModel' => ($dataModel['count'] > 0) ? $dataModel['data'] : [],
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }
}
