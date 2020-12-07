<?php

namespace App\Http\Livewire\Page\AdditionalOrder;

use App\Repository\Api\ApiColorRepository;
use App\Repository\Api\ApiModelColorRepository;
use App\Repository\Api\ApiModelRepository;
use App\Repository\Api\ApiTypeModelRepository;
use App\Repository\Eloquent\MasterAdditionalOrderRepository;
use App\Traits\WithWrsApi;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AdditionalOrderAdd extends Component
{
    use WithWrsApi;

    public $pageTitle = 'Additional Order - Add';
    public array $detailData = [];
    public $totalQty = 0;
    
    public array $bind = [
        'order_number_dealer' => ''
    ];

    protected $rules = [
        'bind.order_number_dealer' => 'required|min:1|max:100',
        'detailData.*.id_model' => 'required',
        'detailData.*.id_type' => 'required',
        'detailData.*.id_colour' => 'required',
        'detailData.*.qty' => 'required|numeric|min:1|max:99999',
        'detailData.*.year_production' => 'required',
    ];

    protected $messages = [
        'bind.order_number_dealer.required' => 'Please fill Order Number Dealer',
        'bind.order_number_dealer.min' => 'Please fill Order Number Minimal :min Character',
        'bind.order_number_dealer.max' => 'Please fill Order Number Maximal :max Characters',
        'detailData.*.id_model.required' => 'Please Choose Model Name!',
        'detailData.*.id_type.required' => 'Please Choose Type Name!',
        'detailData.*.id_colour.required' => 'Please Choose Colour!',
        'detailData.*.qty.required' => 'Quantity cant be Empty!',
        'detailData.*.qty.min' => 'Please input Quantity at Least :min',
        'detailData.*.qty.max' => 'Please input Quantity at Max :max',
        'detailData.*.year_production.required' => 'Please Choose Year Production!',
    ];
    
    public function mount()
    {
        $data = array(
            'id_model' => '',
            'model_name' => '',
            'id_type' => '',
            'type_name' => '',
            'id_colour' => '',
            'colour_name' => '',
            'qty' => 0,
            'year_production' => '',
            'data_type' => [],
            'data_colour' => []
        );

        array_push($this->detailData, $data);
    }

    public function addDetail()
    {
        $end = end($this->detailData);

        $data = array(
            'id_model' => '',
            'model_name' => '',
            'id_type' => '',
            'type_name' => '',
            'id_colour' => '',
            'colour_name' => '',
            'qty' => 0,
            'year_production' => '',
            'data_type' => [],
            'data_colour' => []
        );

        array_push($this->detailData, $data);
    }

    public function deleteDetail($key)
    {
        unset($this->detailData[$key]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->sumTotalQty();
    }

    private function sumTotalQty()
    {
        $totalQty = 0;
        foreach($this->detailData as $key => $detailData)
        {
            $totalQty += $this->detailData[$key]['qty'] ? $this->detailData[$key]['qty'] : 0;
        }

        $this->totalQty = $totalQty;
    }

    public function updateDataType($key, $value, 
        ApiTypeModelRepository $apiTypeModelRepository,
        ApiModelColorRepository $apiModelColorRepository
    )
    {
        if($this->detailData[$key]['id_model'] != '') {
            $dataType = Cache::remember('data-type-with-id-model-'.$value, 30, function () use($value, $apiTypeModelRepository) {
                return $apiTypeModelRepository->getByIdModel($value);
            });
            $this->detailData[$key]['data_type'] = ($dataType['count'] > 0) ? $dataType['data'] : [];
        }

        $this->updateDataColour($key, $value, $apiModelColorRepository);
        
    }

    public function updateDataColour($key, $value, $apiModelColorRepository)
    {
        if($this->detailData[$key]['id_model'] != '') {
            $dataColor = Cache::remember('data-color-with-id-model-'.$value, 30, function () use($value, $apiModelColorRepository) {
                return $apiModelColorRepository->getByIdModel($value);
            });
            $this->detailData[$key]['data_colour'] = ($dataColor['count'] > 0) ? $dataColor['data'] : [];
        }
        
    }

    public function render(ApiModelRepository $apiModelRepository)
    {

        $dealerName = session()->get('dealer')['nm_dealer'] ? session()->get('dealer')['nm_dealer'] : 'Admin';
        
        $dataModel = Cache::remember('data-model', 30, function () use($apiModelRepository) {
            return $apiModelRepository->all();
        });

        return view('livewire.page.additional-order.additional-order-add', [
            'dealerName' => $dealerName,
            'dataModel' => ($dataModel['count'] > 0) ? $dataModel['data'] : [],
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function addProcess(
        MasterAdditionalOrderRepository $masterAdditionalOrderRepository,
        ApiModelRepository $apiModelRepository,
        ApiTypeModelRepository $apiTypeModelRepository,
        ApiColorRepository $apiColorRepository
    )
    {
        $this->validate();

        $dataMaster = array(
            'no_order_atpm' => '',
            'no_order_dealer' => $this->bind['order_number_dealer'],
            'date_save_order' => date('Y-m-d H:i:s'),
            'id_dealer' => session()->get('user')['id_dealer'],
            'id_user' => session()->get('user')['id_user'],
            'user_order' => session()->get('user')['nama_user'],
            'month_order' => date('m'),
            'year_order' => date('Y'),
            'total_qty' => $this->totalQty,
            'status' => '1'
        );

        $this->updateModelTypeColour($apiModelRepository, $apiTypeModelRepository, $apiColorRepository);

        $where = array('no_order_dealer' => $this->bind['order_number_dealer']);

        $count = $masterAdditionalOrderRepository->findDuplicate($where);

        if($count > 0) {
            session()->flash('action_message', 
            '<div class="alert alert-warning" role="alert">No Order Dealer : <strong>'.$this->bind['order_number_dealer'].'</strong> is Exists!</div>');
        } else {
            $insert = $masterAdditionalOrderRepository->createDealerOrder($dataMaster, $this->detailData);

            if($insert) {
                session()->flash('action_message', '<div class="alert alert-primary" role="alert">Insert Data Success!</div>');
                return redirect()->to(route('additional-order.index'));
            } else {
                session()->flash('action_message', '<div class="alert alert-danger" role="alert">Insert Data Failed!</div>');
            }
        }

    }

    private function updateModelTypeColour($apiModelRepository, $apiTypeModelRepository, $apiColorRepository)
    {
        foreach($this->detailData as $key => $detailData) {
            // Model Name
            $cacheModel = 'data-model-getById-'.$this->detailData[$key]['id_model'];
            $dataModel = Cache::remember($cacheModel, 10, function () use($apiModelRepository, $key) {
                return $apiModelRepository->getById($this->detailData[$key]['id_model']);
            });

            $this->detailData[$key]['model_name'] = $dataModel['data']['nm_model'];

            // Type Model Name
            $cacheType = 'data-type-model-getById-'.$this->detailData[$key]['id_type'];
            $dataModel = Cache::remember($cacheType, 10, function () use($apiTypeModelRepository, $key) {
                return $apiTypeModelRepository->getById($this->detailData[$key]['id_type']);
            });

            $this->detailData[$key]['type_name'] = $dataModel['data']['nm_type'];

            // Model Colour
            $cacheModelColor = 'data-model-color-getById-'.$this->detailData[$key]['id_colour'];
            $dataModel = Cache::remember($cacheModelColor, 10, function () use($apiColorRepository, $key) {
                return $apiColorRepository->getById($this->detailData[$key]['id_colour']);
            });

            $this->detailData[$key]['colour_name'] = $dataModel['data']['nm_color_global'];
            
        }
    }
}
