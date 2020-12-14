<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Models\MasterFixOrderUnit;
use App\Repository\Api\ApiColorRepository;
use App\Repository\Api\ApiModelColorRepository;
use App\Repository\Api\ApiModelRepository;
use App\Repository\Api\ApiTypeModelRepository;
use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithGoTo;
use App\Traits\WithWrsApi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixOrderAdd extends Component
{
    use WithWrsApi;
    use WithGoTo;
    use WithDeleteCache;

    public $pageTitle = 'Fix Order - Add';
    public array $detailData = [];
    public $grandTotalQty = 0;
    public $id = 0;
    public $modelName = '';
    
    public array $bind = [
        'order_number_dealer' => ''
    ];

    protected $rules = [
        'bind.order_number_dealer' => 'required|min:1|max:100',
        'detailData.*.id_model' => 'required',
        'detailData.*.id_type' => 'required',
        'detailData.*.id_colour' => 'required',
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
        'detailData.*.id_colour.required' => 'Please Choose Colour!',
        'detailData.*.total_qty.required' => 'Quantity cant be Empty!',
        'detailData.*.year_production.required' => 'Please Choose Year Production!',
        'detailData.*.selected_colour.*.id_colour.required' => 'Please Choose Colour!',
        'detailData.*.selected_colour.*.qty.required' => 'Please Fill Quantity!',
    ];
    
    public function mount()
    {
        $detailData = array(
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
                    'id_colour' => '',
                    'colour_name' => '',
                    'qty' => 0,
                )
            )
        );

        array_push($this->detailData, $detailData);
    }

    public function addDetail()
    {
        $detailData = array(
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
            'id_colour' => '',
            'colour_name' => '',
            'qty' => 0,
        );

        array_push($this->detailData[$this->id]['selected_colour'], $subDetailData);
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
        foreach($this->detailData[$this->id]['selected_colour'] as $keySelected => $selectedColour)
        {
                $totalQty += $this->detailData[$this->id]['selected_colour'][$keySelected]['qty'] 
                ? $this->detailData[$this->id]['selected_colour'][$keySelected]['qty'] : 0;
        }
   
        $this->detailData[$this->id]['total_qty'] = $totalQty;
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

    public function addForm($key, ApiModelColorRepository $apiModelColorRepository)
    {
        //$this->resetForm();
        $this->id = $key;
        $this->emit('openModal');
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

    public function render(ApiModelRepository $apiModelRepository)
    {
        $dealerName = session()->get('dealer')['nm_dealer'] ? session()->get('dealer')['nm_dealer'] : 'Admin';
        
        $dataModel = Cache::remember('data-model', 30, function () use($apiModelRepository) {
            return $apiModelRepository->all();
        });

        return view('livewire.page.fix-order.fix-order-add', [
            'dealerName' => $dealerName,
            'dataModel' => ($dataModel['count'] > 0) ? $dataModel['data'] : [],
        ])
        ->layout('layouts.app', ['title' => $this->pageTitle]);
    }

    public function addProcess(
        MasterFixOrderRepository $masterFixOrderRepository,
        ApiModelRepository $apiModelRepository,
        ApiTypeModelRepository $apiTypeModelRepository,
        ApiColorRepository $apiColorRepository
    ) {
        $this->validate();

        $dataMaster = array(
            'no_order_atpm' => '',
            'no_order_dealer' => $this->bind['order_number_dealer'],
            'date_save_order' => Carbon::now(),
            'id_dealer' => session()->get('user')['id_dealer'],
            'id_user' => session()->get('user')['id_user'],
            'user_order' => session()->get('user')['nama_user'],
            'id_month' => '12',
            'year_order' => Carbon::now()->year,
            'grand_total_qty' => $this->grandTotalQty,
            'status' => '1'
        );

        $this->updateModelTypeColour($apiModelRepository, $apiTypeModelRepository, $apiColorRepository);

        $where = array('no_order_dealer' => $this->bind['order_number_dealer']);

        $count = $masterFixOrderRepository->findDuplicate($where);

        if($count > 0) {
            session()->flash('action_message', 
            '<div class="alert alert-warning" role="alert">No Order Dealer : <strong>'.$this->bind['order_number_dealer'].'</strong> is Exists!</div>');
        } else {
            $insert = $masterFixOrderRepository->createDealerOrder($dataMaster, $this->detailData);

            if($insert) {
                $this->deleteCache();
                session()->flash('action_message', '<div class="alert alert-primary" role="alert">Insert Data Success!</div>');
                return redirect()->to(route('fix-order.index'));
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


            foreach($this->detailData[$key]['selected_colour'] as $keySelectedColor => $dataSelectedColor) {
                // Model Colour
                $cacheModelColor = 'data-model-color-getById-'.$this->detailData[$key]['selected_colour'][$keySelectedColor]['id_colour'];
                $dataModel = Cache::remember($cacheModelColor, 10, function () use($apiColorRepository, $key, $keySelectedColor) {
                    return $apiColorRepository->getById($this->detailData[$key]['selected_colour'][$keySelectedColor]['id_colour']);
                });
  
                $this->detailData[$key]['selected_colour'][$keySelectedColor]['colour_name'] = $dataModel['data']['nm_color_global'];
            } 
            
        }
    }
}
