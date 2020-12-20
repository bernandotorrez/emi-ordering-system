<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <h6>Fix Order ( {{date('d M Y')}} )</h6>

                <div class="widget-content widget-content-area animated-underline-content">

                    <input type="hidden" class="form-control" id="id_month" value="{{$rangeMonth[0]}}">
                    <input type="hidden" class="form-control" id="month_id_to" value="{{$dataRangeMonth[0]->month_id_to}}">
                    <input type="hidden" class="form-control" id="checkBeforeOrAfter" value="{{$checkBeforeOrAfter}}">
                 
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                    
                        @foreach($dataMasterMonth as $key => $masterMonth)

                        @if(in_array($masterMonth->id_month, $rangeMonth))
                        <li class="nav-item" 
                            style="background-color: var(--green); color: #fff"
                            onclick="changeMonth({{$masterMonth->id_month}});">
                            <a class="nav-link {{($rangeMonth[0] == $key+1) ? 'active' : ''}}"
                                id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home"
                                role="tab" aria-controls="animated-underline-home"
                                aria-selected="{{($rangeMonth[0] == $key+1) ? 'true' : 'false'}}">
                                <i class="far fa-calendar-alt"></i>
                                {{$masterMonth->month}}
                            </a>
                        </li>
                        @else
                        <li class="nav-item" style="background-color: var(--red); color: #fff"
                            onclick="showTableReadOnly({{$masterMonth->id_month}});">
                            <a class="nav-link"
                                id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home"
                                role="tab" aria-controls="animated-underline-home">
                                <i class="far fa-calendar-alt"></i>
                                {{$masterMonth->month}}
                            </a>
                        </li>
                        @endif
                        
                        @endforeach
                    </ul>

                    <div id="button_first_load">
                    <!-- Tanggal hari ini masih di antara date_lock_input_start dan date_lock_input_end (Before) -->
                    @if($checkBeforeOrAfter)

                        <!-- Add Button -->
                        @if($countOrder == 0)
                            @if($dataRangeMonth[0]->flag_button_add_before == '1')
                            <button class="btn btn-primary mr-2" id="addButton"
                                data-editableByJS="true"
                                wire:click.prevent="$emit('triggerGoTo', '{{route('fix-order.add')}}')">Add</button>
                            @else
                            <button class="btn btn-primary mr-2" data-editableByJS="false" id="addButton" disabled>Add</button>
                            @endif
                        @else
                            <button class="btn btn-primary mr-2" data-editableByJS="false" id="addButton" disabled>Add</button>
                        @endif
                       

                        <!-- Amend Button -->
                        @if($dataRangeMonth[0]->flag_button_amend_before == '1')
                        <button class="btn btn-success mr-2" id="editButton"
                            data-editableByJS="true"
                            wire:click.prevent="goTo('{{route('fix-order.add')}}')" disabled>Amend</button>
                        @else
                        <button class="btn btn-primary mr-2" data-editableByJS="false" id="editButton" disabled>Amend</button>
                        @endif

                        <!-- Send Approval Button -->
                        @if($dataRangeMonth[0]->flag_button_send_approval_before == '1')
                        <button class="btn btn-primary mr-2" id="sendApprovalButton"
                            data-editableByJS="true" onclick="sendApproval()" disabled>Send Approval</button>
                        @else
                        <button class="btn btn-primary mr-2" data-editableByJS="false" 
                            id="sendApprovalButton" disabled>Send Approval</button>
                        @endif
                    
                    <!-- Tanggal hari ini diluar antara date_lock_input_start dan date_lock_input_end (After) -->
                    @else

                    <!-- Add Button -->
                    @if($dataRangeMonth[0]->flag_button_add_after == '1')
                        <button class="btn btn-primary mr-2" id="addButton"
                            data-editableByJS="true"
                            wire:click.prevent="$emit('triggerGoTo', '{{route('fix-order.add')}}')">Add</button>
                        @else
                        <button class="btn btn-primary mr-2" data-editableByJS="false" id="addButton" disabled>Add</button>
                        @endif

                        <!-- Amend Button -->
                        @if($dataRangeMonth[0]->flag_button_amend_after == '1')
                        <button class="btn btn-success mr-2" id="editButton"
                            data-editableByJS="true"
                            wire:click.prevent="goTo('{{route('fix-order.add')}}')" disabled>Amend</button>
                        @else
                        <button class="btn btn-success mr-2" data-editableByJS="false" id="editButton" disabled>Amend</button>
                        @endif

                        <!-- Send Approval Button -->
                        @if($dataRangeMonth[0]->flag_button_send_approval_after == '1')
                        <button class="btn btn-primary mr-2" id="sendApprovalButton"
                            data-editableByJS="true" onclick="sendApproval()" disabled>Send Approval</button>
                        @else
                        <button class="btn btn-primary mr-2" data-editableByJS="false" id="sendApprovalButton" disabled>Send Approval</button>
                        @endif

                    @endif
                    </div>

                    <div id="button_ajax_load" style="display: none;">
                        <button class="btn btn-primary mr-2" id="addButtonAjaxLoad"
                                data-editableByJS="false"
                                wire:click.prevent="$emit('triggerGoTo', '{{route('fix-order.add')}}')">Add</button>

                        <button class="btn btn-success mr-2" id="editButtonAjaxLoad"
                                data-editableByJS="false"
                                wire:click.prevent="goTo('{{route('fix-order.add')}}')" disabled>Amend</button>

                        <button class="btn btn-primary mr-2" id="sendApprovalButtonAjaxLoad"
                                data-editableByJS="false" onclick="sendApproval()" disabled>Send Approval</button>
                    </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-bordered table-hover" id="master-fixorder-table">


                            </table>
                        </div>

                </div>


            </div>
        </div>
    </div>

</div>
