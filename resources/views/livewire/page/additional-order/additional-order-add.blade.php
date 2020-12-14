<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <form id="form-add" class="section" wire:submit.prevent="addProcess">
                    <div class="info">
                        <h5 class="mb-4">{{ $pageTitle }}</h5>
                        <div class="row">
                            <div class="col-md-11 mx-auto">
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_number">Order Number</label>
                                            <input type="text" class="form-control mb-4" id="order_number"
                                                placeholder="AA0001" readonly>
                                        </div>
                                    </div> -->
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
                                    <th><font class="text-danger">Year *</font></th>
                                    <th><font class="text-danger">Type Name *</font></th>
                                    <th><font class="text-danger">Colour *</font></th>
                                    <th><font class="text-danger">Qty *</font></th>
                                    <th>
                                        <a href="#detail">
                                            <i class="fas fa-plus-circle fa-2x text-success"
                                                wire:click.prevent="addDetail">
                                            </i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($detailData as $key => $data)
                                <tr align="center" wire:key="master-{{ $key }}">
                                    <td>{{ $loop->iteration }} </td>
                                    <td>
                                        <select class="form-control" wire:model.lazy="detailData.{{$key}}.id_model"
                                            wire:change="updateDataType({{$key}}, $event.target.value)">
                                            <option value="" selected>- Choose Model -</option>

                                            @foreach($dataModel as $model)
                                            <option value="{{$model['kd_model']}}">{{$model['nm_model']}}</option>
                                            @endforeach
                                        </select>
                                        @error('detailData.'.$key.'.id_model') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <select class="form-control" wire:model.lazy="detailData.{{$key}}.year_production">
                                            <option value="" selected>- Choose Year -</option>

                                            @for($i = 0;$i <= 2;$i++)
                                            <option value="{{(date('Y')-$i)}}">{{(date('Y')-$i)}}</option>
                                            @endfor
                                        </select>
                                        @error('detailData.'.$key.'.year_production') <span class="error">{{ $message }}</span>
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
                                        <select class="form-control" wire:model.lazy="detailData.{{$key}}.id_colour">
                                            <option value="" selected>- Choose Colour -</option>

                                            @foreach($detailData[$key]['data_colour'] as $colour)
                                            <option value="{{$colour['color']['kd_color']}}">
                                                {{$colour['color']['nm_color_global']}}</option>
                                            @endforeach
                                        </select>
                                        @error('detailData.'.$key.'.id_colour') <span
                                            class="error">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number" class="form-control text-center"
                                            wire:model.lazy="detailData.{{$key}}.qty" placeholder="Qty"
                                            onkeypress="return isQtyKey(event)">
                                        @error('detailData.'.$key.'.qty') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <a href="#detail">
                                            <i class="fas fa-trash-alt fa-2x text-danger"
                                                onclick="return confirm('Are you sure you want to Delete this?') || event.stopImmediatePropagation()"
                                                wire:click.prevent="deleteDetail({{$key}})"
                                                @if(count($detailData)==1) disabled @endif>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" align="right">Total Order Qty : </td>
                                    <td colspan="1">
                                        <input type="text" class="form-control text-center" id="total_qty"
                                            wire:model.lazy="totalQty" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-11 text-left">
                        <button type="submit" class="btn btn-primary mt-3 mr-2">Save to Draft</button>
                        <button class="btn btn-warning mt-3" 
                            wire:click.prevent="goTo('{{route('additional-order.index')}}')">Back</a>
                        
                    </div>
                    
                </form>

            </div>
        </div>
    </div>

</div>
