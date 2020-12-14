<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif
                
                <!-- Modal -->
                <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg animated slideInUp custo-slideInUp" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $pageTitle }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">
                          
                                <h6 class="mb-4">Model Name : <strong>{{$modelName}}</strong></h6>

                                <div class="table-responsive" id="sub_detail">
                                    <table class="table table-striped table-bordered">
                                    
                                        <thead>
                                            <tr align="center">
                                                <th>No</th>
                                                <th>
                                                    <font class="text-danger">Colour Name *</font>
                                                </th>
                                                <th>
                                                    <font class="text-danger">Qty *</font>
                                                </th>
                                                <th>
                                                    <button type="submit" class="btn btn-success"
                                                    wire:click.prevent="addSubDetail">+</button>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($detailData[$id]['selected_colour'] as $keySub => $dataSub)
                                            <tr align="center" wire:key="detail-{{ $keySub }}">
                                                <td>{{ $loop->iteration }} </td>
                                                <td>
                                                    <select class="form-control"
                                                        wire:model.lazy="detailData.{{$id}}.selected_colour.{{$keySub}}.id_colour">
                                                        <option value="" selected>- Choose Colour -</option>

                                                        @foreach($detailData[$id]['data_colour'] as $model)
                                                        <option value="{{$model['fk_color']}}">{{$model['color']['nm_color_global']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('detailData.{{$id}}.selected_colour.{{$keySub}}.id_colour') 
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" 
                                                    wire:model.lazy="detailData.{{$id}}.selected_colour.{{$keySub}}.qty">
                                                    @error('detailData.{{$id}}.selected_colour.{{$keySub}}.qty') 
                                                    <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <a href="#sub_detail">
                                                        <i class="fas fa-trash-alt fa-2x text-danger"
                                                            onclick="return confirm('Are you sure you want to Delete this?') || event.stopImmediatePropagation()"
                                                            wire:click.prevent="deleteSubDetail({{$id}}, {{$keySub}})">
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" align="right">Total Qty : </td>
                                                <td colspan="1">
                                                    <input type="text" class="form-control text-center"
                                                        id="total_qty" wire:model.lazy="detailData.{{$id}}.total_qty" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

                <form id="form-add" class="section" wire:submit.prevent="addProcess">
                    <div class="info">
                        <h5 class="mb-4">{{ $pageTitle }}</h5>
                        <div class="row">
                            <div class="col-md-11 mx-auto">
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_dealer">Dealer ID</label>
                                            <input type="text" class="form-control mb-4" id="id_dealer"
                                                placeholder="Dealer" value="{{session()->get('user')['id_dealer']}}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_no_dealer">
                                                <font class="text-danger">Order Number Dealer *</font>
                                            </label>
                                            <input type="text" class="form-control mb-4" id="order_number_dealer"
                                                placeholder="PO Number Dealer"
                                                wire:model.lazy="bind.order_number_dealer" autofocus>
                                                @error('bind.order_number_dealer') <span class="error">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dealer_name">Dealer Name</label>
                                            <input type="text" class="form-control mb-4" id="dealer_name"
                                                placeholder="Dealer Name" value="{{$dealerName}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="year_order">Year Order</label>
                                            <input type="text" class="form-control mb-4" id="year_order" placeholder=""
                                                value="{{ date('Y') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_user">User Dealer</label>
                                            <input type="text" class="form-control mb-4" id="id_user" placeholder=""
                                                value="{{ session()->get('user')['nama_user'] }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive" id="detail">
                        <table class="table table-striped table-bordered">
        
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th><font class="text-danger">Model Name *</font></th>
                                    <th><font class="text-danger">Type Name *</font></th>
                                    <th><font class="text-danger">Total Qty *</font></th>   
                                    <th>
                                        <button type="submit" class="btn btn-success"
                                            wire:click.prevent="addDetail">+</button>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($detailData as $key => $data)
                                <tr align="center" wire:key="master-{{ $key }}">
                                    <td>{{ $loop->iteration }} </td>
                                    <td>
                                        <select class="form-control" wire:model.lazy="detailData.{{$key}}.id_model"
                                            wire:change.prevent="updateDataType({{$key}}, $event.target.value)">
                                            <option value="" selected>- Choose Model -</option>

                                            @foreach($dataModel as $model)
                                            <option value="{{$model['kd_model']}}">{{$model['nm_model']}}</option>
                                            @endforeach
                                        </select>
                                        @error('detailData.'.$key.'.id_model') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <select class="form-control" wire:model.lazy="detailData.{{$key}}.id_type">
                                            <option value="" selected>- Choose Type -</option>

                                            @foreach($detailData[$key]['data_type'] as $type)
                                            <option value="{{$type['kd_type']}}">{{$type['nm_type']}}</option>
                                            @endforeach
                                        </select>
                                        @error('detailData.'.$key.'.id_type') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    

                                    <td>
                                        <input type="text" class="form-control text-center"
                                            wire:model.lazy="detailData.{{$key}}.total_qty" readonly>
                                       
                                    </td>

                                    <td>
                                            <i class="fas fa-paint-brush fa-2x text-info mr-2" 
                                                wire:click.prevent="addForm({{$key}})"></i>
                            
                                            <i class="fas fa-trash-alt fa-2x text-danger"
                                                onclick="return confirm('Are you sure you want to Delete this?') || event.stopImmediatePropagation()"
                                                wire:click.prevent="deleteDetail({{$key}})"
                                                @if(count($detailData)==1) disabled @endif>
                                            </i>
                                        
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" align="right">Grand Total Order Qty : </td>
                                    <td colspan="1">
                                        <input type="text" class="form-control text-center" id="grand_total_qty"
                                            wire:model.lazy="grandTotalQty" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-11 text-left">
                        <button type="submit" class="btn btn-primary mt-3 mr-2">Save to Draft</button>
                        <button class="btn btn-warning mt-3" 
                            wire:click.prevent="goTo('{{route('fix-order.index')}}')">Back</a>
                        
                    </div>
                    
                </form>

            </div>
        </div>
    </div>

</div>
