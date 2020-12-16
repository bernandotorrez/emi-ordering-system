<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <h6>Fix Order</h6>

                <div class="widget-content widget-content-area animated-underline-content">

                    <input type="hidden" class="form-control" id="id_month" value="{{date('m')}}">

                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">

                        @foreach($dataMasterMonth as $key => $masterMonth)

                        @if(in_array($masterMonth->id_month, $rangeMonth))
                        <li class="nav-item" 
                            style="background-color: var(--green); color: #fff"
                            onclick="showHideAddButton({{$key}});changeMonth({{$key+1}})">
                            <a class="nav-link {{(date('m')-1 == $key) ? 'active' : ''}}"
                                id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home"
                                role="tab" aria-controls="animated-underline-home"
                                aria-selected="{{(date('m')-1 == $key) ? 'true' : 'false'}}">
                                <i class="far fa-calendar-alt"></i>
                                {{$masterMonth->month}}
                            </a>
                        </li>
                        @else
                        <li class="nav-item" style="background-color: var(--red); color: #fff">
                            <a class="nav-link disabled"
                                id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home"
                                role="tab" aria-controls="animated-underline-home"
                                aria-disabled="true">
                                <i class="far fa-calendar-alt"></i>
                                {{$masterMonth->month}}
                            </a>
                        </li>
                        @endif
                        
                        @endforeach
                    </ul>

                    @if((date('Y-m-d') >= $dataLockDate->date_input_lock_start)
                    && (date('Y-m-d') <= $dataLockDate->date_input_lock_end))
                        <button class="btn btn-primary mr-2" id="addButton"
                            wire:click.prevent="goTo('{{route('fix-order.add')}}')">Add</button>
                        @else
                        <button class="btn btn-primary mr-2" id="addButton" disabled>Add</button>
                        @endif

                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-bordered table-hover" id="master-fixorder-table">


                            </table>
                        </div>

                        <!-- <div class="widget-content widget-content-area animated-underline-content">
                            <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                <li class="nav-item" onclick="showTableTab('draft')">
                                    <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab"
                                        href="#animated-underline-home" role="tab" aria-controls="animated-underline-home"
                                        aria-selected="true">
                                        <i class="far fa-edit"></i> Draft</a>
                                </li>
                                <li class="nav-item" onclick="showTableTab('waiting_approval_dealer_principle')">
                                    <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab"
                                        href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile"
                                        aria-selected="false">
                                        <i class="fas fa-user-clock"></i> Waiting Approval</a>
                                </li>
                                <li class="nav-item" onclick="showTableTab('approval_dealer_principle')">
                                    <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                        href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                        aria-selected="false">
                                        <i class="fas fa-user-check"></i> Approved</a>
                                </li>
                                <li class="nav-item" onclick="showTableTab('submitted_atpm')">
                                    <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                        href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                        aria-selected="false">
                                        <i class="fas fa-file-import"></i> Submitted</a>
                                </li>
                                <li class="nav-item" onclick="showTableTab('atpm_allocation')">
                                    <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                        href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                        aria-selected="false">
                                        <i class="fas fa-shipping-fast"></i> Allocated</a>
                                </li>
                                <li class="nav-item" onclick="showTableTab('canceled')">
                                    <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                        href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                        aria-selected="false">
                                        <i class="fas fa-user-times"></i> Canceled</a>
                                </li>
                            </ul>

                            
                        </div> -->

                </div>


            </div>
        </div>
    </div>

</div>
