<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <?php
                $date_start = date('Y-m-d',strtotime(date('Y-m-d') . "+1 days"));
                $checkAddButtonCurrentMonth = eval("return ((string) date('Y-m-d') $dataLockDate->operator_start '$dataLockDate->date_input_lock_start')
                    && ((string) date('Y-m-d') $dataLockDate->operator_end '$dataLockDate->date_input_lock_end');");

                ?>

                <h6>Fix Order ( {{date('d M Y')}} )</h6>

                <div class="widget-content widget-content-area animated-underline-content">

                    <input type="hidden" class="form-control" id="id_month" value="{{date('m')}}">
                 
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                    
                        @foreach($dataMasterMonth as $key => $masterMonth)

                        @if(in_array($masterMonth->id_month, $rangeMonth))
                        <li class="nav-item" 
                            style="background-color: var(--green); color: #fff"
                            onclick="changeMonth({{$key+1}})">
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

                        @if($checkAddButtonCurrentMonth)
                        <button class="btn btn-primary mr-2" id="addButton"
                            wire:click.prevent="goTo('{{route('fix-order.add')}}')">Add</button>
                        @else
                        <button class="btn btn-primary mr-2" id="addButton" disabled>Add</button>
                        @endif

                        <button class="btn btn-success mr-2" id="editButton"
                            wire:click.prevent="goTo('{{route('fix-order.add')}}')">Amend</button>

                        <button class="btn btn-primary mr-2" id="sendApprovalButton"
                            wire:click.prevent="goTo('{{route('fix-order.add')}}')">Send Approval</button>

                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-bordered table-hover" id="master-fixorder-table">


                            </table>
                        </div>

                </div>


            </div>
        </div>
    </div>

</div>
