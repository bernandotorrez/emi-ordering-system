<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Repository\Api\ApiModelColorRepository;
use App\Repository\Api\ApiModelRepository;
use App\Repository\Api\ApiTypeModelRepository;
use App\Repository\Eloquent\DetailColourFixOrderRepository;
use App\Repository\Eloquent\DetailFixOrderRepository;
use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithGoTo;
use App\Traits\WithWrsApi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixOrderEdit extends Component
{
    use WithWrsApi;
    use WithDeleteCache;
    use WithGoTo;

    public $pageTitle = 'Fix Order - Edit';
    public array $detailData = [];
    public $grandTotalQty = 0;
    public $idKey = 0;
    public $modelName = '';
    public $idFixOrder = '';

    public array $bind = [
        'order_number_dealer' => ''
    ];

    protected $rules = [
        'bind.order_number_dealer' => 'required|min:1|max:100',
        'detailData.*.id_model' => 'required',
        'detailData.*.id_type' => 'required',
        'detailData.*.year_production' => 'required',
        'detailData.*.total_qty' => 'required|min:1|max:99999',
        'detailData.*.selected_colour.*.id_colour' => 'required',
        'detailData.*.selected_colour.*.qty' => 'required',
    ];

    protected $messages = [
        'bind.order_number_dealer.required' => 'Please fill Order Number Dealer',
        'bind.order_number_dealer.min' => 'Please fill Order Number Minimal :min Character',
        'bind.order_number_dealer.max' => 'Please fill Order Number Maximal :max Characters',
        'detailData.*.id_model.required' => 'Please Choose Model Name!',
        'detailData.*.id_type.required' => 'Please Choose Type Name!',
        'detailData.*.total_qty.required' => 'Quantity cant be Empty!',
        'detailData.*.year_production.required' => 'Please Choose Year Production!',
        'detailData.*.selected_colour.*.id_colour.required' => 'Please Choose Colour!',
        'detailData.*.selected_colour.*.qty.required' => 'Please Fill Quantity!',
    ];

    public function mount(
        $id,
        MasterFixOrderRepository $masterFixOrderRepository,
        DetailFixOrderRepository $detailFixOrderRepository,
        DetailColourFixOrderRepository $detailColourFixOrderRepository,
        ApiTypeModelRepository $apiTypeModelRepository,
        ApiModelColorRepository $apiModelColorRepository
    ) {
        $this->idFixOrder = $id;

        $masterFixOrder = $masterFixOrderRepository->getById($id);
        $this->bind['order_number_dealer'] = $masterFixOrder->no_order_dealer;
        $this->grandTotalQty = $masterFixOrder->grand_total_qty;

        $detailFixOrder = $detailFixOrderRepository->getByIdMaster($id);

        $arrayIdDetail = array();

        foreach($detailFixOrder as $detail) {
            $dataType = Cache::remember('data-type-with-id-model-'.$detail->id_model, 10, 
            function () use($detail, $apiTypeModelRepository) {
                return $apiTypeModelRepository->getByIdModel($detail->id_model);
            });

            $dataColor = Cache::remember('data-color-with-id-model-'.$detail->id_model, 10, 
            function () use($detail, $apiModelColorRepository) {
                return $apiModelColorRepository->getByIdModel($detail->id_model);
            });
            
            $detailData = array(
                'id_detail_fix_order_unit' => $detail->id_detail_fix_order_unit,
                'id_model' => $detail->id_model,
                'model_name' => $detail->model_name,
                'id_type' => $detail->id_type,
                'type_name' => $detail->type_name,
                'qty' => $detail->total_qty,
                'year_production' => $detail->year_production,
                'data_type' => $dataType['data'],
                'data_colour' => $dataColor['data'],
                'total_qty' => $detail->total_qty,
                'selected_colour' => array()
            );
    
            array_push($this->detailData, $detailData);
            array_push($arrayIdDetail, $detail->id_detail_fix_order_unit);
        }
        
        // update selected_colour
        foreach($arrayIdDetail as $key => $idDetail) {
            $dataColourFixOrder = $detailColourFixOrderRepository->getByIdDetail($idDetail);

            foreach($dataColourFixOrder as $detailColour) {
                $dataColour = array(
                    'id_detail_colour_fix_order_unit' => $detailColour->id_detail_colour_fix_order_unit,
                    'id_colour' => $detailColour->id_colour,
                    'colour_name' => $detailColour->colour_name,
                    'qty' => $detailColour->qty,
                );
                array_push($this->detailData[$key]['selected_colour'], $dataColour);
            }
        }
        
    }

    public function addDetail()
    {
        $detailData = array(
            'id_detail_fix_order_unit' => '',
            'id_model' => '',
            'model_name' => '',
            'id_type' => '',
            'type_name' => '',
            'qty' => 0,
            'year_production' => Carbon::now()->year,
            'data_type' => [],
            'data_colour' =>  [],
            'total_qty' => 0,
            'selected_colour' => array(
                0 => array(
                    'id_detail_colour_fix_order_unit' => '',
                    'id_colour' => '',
                    'colour_name' => '',
                    'qty' => 0,
                )
            )
        );

        array_push($this->detailData, $detailData);
    }

    public function addSubDetail()
    {
        $subDetailData = array(
            'id_detail_colour_fix_order_unit' => '',
            'id_colour' => '',
            'colour_name' => '',
            'qty' => 0,
        );

        array_push($this->detailData[$this->idKey]['selected_colour'], $subDetailData);
    }

    public function deleteDetail($key)
    {
        unset($this->detailData[$key]);
    }

    public function deleteSubDetail($key, $keySub)
    {
        unset($this->detailData[$key]['selected_colour'][$keySub]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->sumTotalQty();
        $this->sumGrandTotalQty();
    }

    private function sumTotalQty()
    {
        $totalQty = 0;
        foreach($this->detailData[$this->idKey]['selected_colour'] as $keySelected => $selectedColour)
        {
                $totalQty += $this->detailData[$this->idKey]['selected_colour'][$keySelected]['qty'] 
                ? $this->detailData[$this->idKey]['selected_colour'][$keySelected]['qty'] : 0;
        }
   
        $this->detailData[$this->idKey]['total_qty'] = $totalQty;
    }

    private function sumGrandTotalQty()
    {
        $grandTotalQty = 0;
        foreach($this->detailData as $key => $detailData)
        {
            $grandTotalQty += $this->detailData[$key]['total_qty'] ? $this->detailData[$key]['total_qty'] : 0;
        }

        $this->grandTotalQty = $grandTotalQty;
    }

    public function updateDataType($key, $value, 
        ApiTypeModelRepository $apiTypeModelRepository,
        ApiModelColorRepository $apiModelColorRepository
    ) {
        if($this->detailData[$key]['id_model'] != '') {
            $dataType = Cache::remember('data-type-with-id-model-'.$value, 30, function () use($value, $apiTypeModelRepository) {
                return $apiTypeModelRepository->getByIdModel($value);
            });
            $this->detailData[$key]['data_type'] = ($dataType['count'] > 0) ? $dataType['data'] : [];
            $this->modelName = ($dataType['count'] > 0) ? $dataType['data'][0]['model']['nm_model'] : '';
        }
        
        $this->updateDataColour($key, $value, $apiModelColorRepository);
    }

    public function updateDataColour($key, $value, $apiModelColorRepository)
    {
        if($this->detailData[$key]['id_model'] != '') {
            $dataColor = Cache::remember('data-color-with-id-model-'.$value, 30, function () use($value, $apiModelColorRepository) {
                return $apiModelColorRepository->getByIdModel($value);
            });
            // $this->detailData[$key]['data_colour'] = ($dataColor['count'] > 0) ? $dataColor['data'] : [];
            $this->detailData[$key]['data_colour'] = ($dataColor['count'] > 0) ? $dataColor['data'] : [];
        } else {
            $this->detailData[$key]['data_colour'] = [];
        }
        
    }

    public function addForm($key, ApiModelColorRepository $apiModelColorRepository)
    {
        //$this->resetForm();
        $this->idKey = $key;
        $this->emit('openModal');
    }

    public function render(
        ApiModelRepository $apiModelRepository
    ) {
        $dealerName = session()->get('dealer')['nm_dealer'] ? session()->get('dealer')['nm_dealer'] : 'Admin';
        
        $dataModel = Cache::remember('data-model', 30, function () use($apiModelRepository) {
            return $apiModelRepository->all();
        });

        return view('livewire.page.fix-order.fix-order-edit', [
            'dealerName' => $dealerName,
            'dataModel' => ($dataModel['count'] > 0) ? $dataModel['data'] : [],
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }
}
