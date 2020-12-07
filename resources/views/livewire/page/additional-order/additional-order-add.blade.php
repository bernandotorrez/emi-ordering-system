<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif
                
                <form id="contact" class="section contact">
                    <div class="info">
                        <h5 class="mb-4" >{{ $pageTitle }}</h5>
                        <div class="row">
                            <div class="col-md-11 mx-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_number">Order Number</label>
                                            <input type="text" class="form-control mb-4" id="order_number"
                                                placeholder="AA0001" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_dealer">Dealer ID</label>
                                            <input type="text" class="form-control mb-4" id="id_dealer"
                                                placeholder="Dealer" value="{{session()->get('user')['id_dealer']}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_no_dealer"><font class="text-danger">PO Number Dealer *</font></label>
                                            <input type="text" class="form-control mb-4" id="order_no_dealer"
                                                placeholder="PO Number Dealer" wire:model.lazy="bind.order_number_dealer" autofocus>
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
                                            <input type="text" class="form-control mb-4" id="year_order"
                                                placeholder="" value="{{ date('Y') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_user">User Dealer</label>
                                            <input type="text" class="form-control mb-4" id="id_user"
                                                placeholder="" value="{{ session()->get('user')['nama_user'] }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Model Name</th>
                                <th>Type Name</th>
                                <!-- <th>Total Qty</th>
                                <th>Prod Year</th> -->
                                <th><button class="btn btn-success" wire:click.prevent="addDetail">+</button></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($detailData as $key => $data)
                            <tr align="center" wire:key="{{ $key }}">
                                <td>{{ $loop->iteration }} </td>
                                <td>
                                    <select type="text" class="form-control" wire:model.lazy="detailData.{{$key}}.id_model"
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
                                    <select type="text" class="form-control" ">
                                        <option value="" selected>- Choose Type -</option>

                                        @foreach($detailData[$key]['data_type'] as $type)
                                        <option value="{{$type['kd_type']}}">{{$type['nm_type']}}</option>
                                        @endforeach
                                    </select>
                                    @error('detailData.'.$key.'.id_type') <span class="error">{{ $message }}</span>
                                        @enderror
                                </td>
                                
                                <td><button class="btn btn-danger" wire:click.prevent="deleteDetail({{$key}})"
                                @if(count($detailData) == 1) disabled @endif
                                >-</button></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" align="right">Total Qty : </td>
                                <td colspan="2">
                                    <input type="text" id="total_qty" 
                                    class="form-control" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    Livewire.on('triggerDelete', function () {

        Swal.fire({
            icon: 'question',
            title: 'Are You Sure?',
            text: 'this Record will be deleted!',
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                // call function deleteProcess() in Livewire Controller
                @this.deleteProcess()
            }
        });
    });
</script>
@endpush
