<?php

namespace App\Http\Livewire\Page\FixOrder;

use App\Repository\Api\ApiModelColorRepository;
use App\Repository\Api\ApiTypeModelRepository;
use App\Repository\Eloquent\DetailColourFixOrderRepository;
use App\Repository\Eloquent\DetailFixOrderRepository;
use App\Repository\Eloquent\MasterFixOrderRepository;
use App\Traits\WithDeleteCache;
use App\Traits\WithGoTo;
use App\Traits\WithWrsApi;
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

        $detailFixOrder = $detailFixOrderRepository->getByIdMaster($id);

        foreach($detailFixOrder as $detail) {
            $dataType = Cache::remember('data-type-with-id-model-'.$detail->id_model, 10, 
            function () use($detail, $apiTypeModelRepository) {
                return $apiTypeModelRepository->getByIdModel($detail->id_model);
            });

            $dataColor = Cache::remember('data-color-with-id-model-'.$detail->id_model, 10, 
            function () use($detail, $apiModelColorRepository) {
                return $apiModelColorRepository->getByIdModel($detail->id_model);
            });
            
            $dataColourFixOrder = $detailColourFixOrderRepository->getByIdDetail($detail->id_detail_fix_order_unit);

            $detailData = array(
                'id_model' => $detail->id_model,
                'model_name' => $detail->model_name,
                'id_type' => $detail->id_type,
                'type_name' => $detail->type_name,
                'qty' => $detail->total_qty,
                'year_production' => $detail->year_production,
                'data_type' => $dataType['data'],
                'data_colour' => $dataColor['data'],
                'total_qty' => $detail->total_qty,
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

        dd($this->detailData);

    }
    
    public function render()
    {
        return view('livewire.page.fix-order.fix-order-edit');
    }
}
