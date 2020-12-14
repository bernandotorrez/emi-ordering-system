<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif
                
                <h6>Additional Order</h6>

                <div class="widget-content widget-content-area animated-underline-content">

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

                    <button class="btn btn-primary mr-2" id="addButton" 
                    wire:click.prevent="goTo('{{route('additional-order.add')}}')" >Add</button>

                    <button type="button" class="btn btn-success mr-2" id="editButton"
                        wire:click.prevent="goTo($event.target.value)" value="" disabled>Amend</button>

                    <button type="button" class="btn btn-primary mr-2" id="sendApprovalButton"
                        onclick="sendApproval()"
                        disabled>Send to Approval</button>

                    <!-- <button type="button" class="btn btn-danger mr-2" id="deleteButton" onclick="deleteProcess()"
                        disabled>Delete</button> -->

                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered table-hover" id="master-additional-table">

                            <div class="form-group col-md-3 mb-4" id="dropdown_cancel_status">
                                <label for="parent_position">Cancel Status</label>
                                <select name="cancel_status" id="cancel_status" class="form-control"
                                    onchange="showTableCancel('canceled', this.value)">
                                        <option value="">- Choose Cancel Status -</option>
                                    @foreach($dataCancelStatus as $key => $cancelStatus)
                                        <option value="{{$cancelStatus->id_cancel_status}}">
                                            {{$cancelStatus->nama_cancel_status}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
