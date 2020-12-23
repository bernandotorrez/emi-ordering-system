<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <h6>Fix Order ATPM ( {{date('d M Y')}} )</h6>

                <div class="widget-content widget-content-area animated-underline-content">

                    <input type="hidden" class="form-control" id="id_month" value="{{$rangeMonth[0]}}">
                    <input type="hidden" class="form-control" id="month_id_to"
                        value="{{$dataRangeMonth[0]->month_id_to}}">
                    <input type="hidden" class="form-control" id="checkBeforeOrAfter" value="{{$checkBeforeOrAfter}}">

                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">

                        @foreach($dataMasterMonth as $key => $masterMonth)

                        @if(in_array($masterMonth->id_month, $rangeMonth))
                        <li class="nav-item" style="background-color: var(--green); color: #fff"
                            onclick="changeMonth({{$masterMonth->id_month}});">
                            <a class="nav-link {{($rangeMonth[0] == $key+1) ? 'active' : ''}}"
                                id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home"
                                role="tab" aria-controls="animated-underline-home"
                                aria-selected="{{($rangeMonth[0] == $key+1) ? 'true' : 'false'}}">
                                <i class="far fa-calendar-alt"></i>
                                {{Str::substr($masterMonth->month, 0, 3)}}
                            </a>
                        </li>
                        @else
                        <li class="nav-item" style="background-color: var(--red); color: #fff"
                            onclick="showTableReadOnly({{$masterMonth->id_month}});">
                            <a class="nav-link" id="animated-underline-home-tab" data-toggle="tab"
                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home">
                                <i class="far fa-calendar-alt"></i>
                                {{Str::substr($masterMonth->month, 0, 3)}}
                            </a>
                        </li>
                        @endif

                        @endforeach
                    </ul>

                    <div id="button_ajax_load">
                        <!-- <button class="btn btn-warning mr-2" data-editableByJS="false" onclick="planningToAtpm()"
                            id="planningButtonAjaxLoad" disabled>Planning</button>
                        
                        <button class="btn btn-danger mr-2" data-editableByJS="false" onclick="sendRevision()"
                            id="reviseButtonAjaxLoad" disabled>Revise</button>

                        <button class="btn btn-success mr-2" data-editableByJS="false" onclick="sendApproval()"
                            id="approveButtonAjaxLoad" disabled>Approve</button> -->
                        
                        <button class="btn btn-primary mr-2" data-editableByJS="true" onclick="sendAllocatedAtpm()"
                            id="allocateButtonAjaxLoad" disabled>Allocate</button>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered table-hover" id="master-fixorder-atpm-table">


                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
