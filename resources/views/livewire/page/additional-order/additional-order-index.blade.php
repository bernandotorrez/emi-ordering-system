<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

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
                        <li class="nav-item" onclick="showTableTab('cancel_approval')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-user-times"></i> Cancel Approval</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('submitted_atpm')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-file-import"></i> Submitted</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('cancel_submit')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-user-times"></i> Cancel Submit</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('atpm_allocation')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-shipping-fast"></i> Allocated</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('cancel_allocation')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-user-times"></i> Cancel Allocation</a>
                        </li>
                    </ul>

                    <a class="btn btn-primary mr-2" id="addButton" href="{{route('additional-order.add')}}">Add</a>

                    <button type="button" class="btn btn-success mr-2" id="editButton"
                        wire:click.prevent="goTo($event.target.value)" value="" disabled>Amend</button>

                    <button type="button" class="btn btn-primary mr-2" id="sendApprovalButton"
                        onclick="sendApproval()"
                        disabled>Send to Approval</button>

                    <!-- <button type="button" class="btn btn-danger mr-2" id="deleteButton" onclick="deleteProcess()"
                        disabled>Delete</button> -->

                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered table-hover" id="master-additional-table">
                            <thead>
                                <tr>
                                    <th class="checkbox-column"></th>
                                    <th><input type="checkbox" class="new-control-input"></th>
                                    <th>No Order Dealer</th>
                                    <th>No Order ATPM</th>
                                    <th>Date Save</th>
                                    <th>User Order</th>
                                    <th>Total Qty</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css')}}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('assets/js/handlebars.js') }}"></script>

<script id="details-template" type="text/x-handlebars-template">
        <h5 class="mt-2 text-center">Detail Order</h5>
        <table class="table table-hover details-table" id="detail">
            <thead>
            <tr>
                <th>Model Name</th>
                <th>Type Name</th>
                <th>Colour Name</th>
                <th>Year Production</th>
                <th>Qty</th>
            </tr>
            </thead>
        </table>
    </script>
<script>
    
    function updateCheck(id) {
        var count = document.querySelectorAll('.checkId:checked').length
        var editButtonEl = document.getElementById('editButton')

        if(count == 0 || count > 1) {
            editButtonEl.setAttribute('disabled', true)
        } else {
            editButtonEl.removeAttribute('disabled')
            editButtonEl.value = "{!! route('additional-order.edit') !!}/"+id
        }

        // var deleteButtonEl = document.getElementById('deleteButton')

        // if(count == 0) {
        //     deleteButtonEl.setAttribute('disabled', true) 
        // } else {
        //     deleteButtonEl.removeAttribute('disabled')
        // }

        var sendButtonEl = document.getElementById('sendApprovalButton')
        if(count == 0) {
            sendButtonEl.setAttribute('disabled', true) 
        } else {
            sendButtonEl.removeAttribute('disabled')
        }
    }

    function allChecked(status) {
        var arrayChecked = document.querySelectorAll('.checkId');
        arrayChecked.forEach(function(check) {
            check.checked = status
        })
        
        updateCheck('')
    }

    function sendApproval() {
        var arrayChecked = document.querySelectorAll('.checkId:checked');
        var arrayId = [];

        arrayChecked.forEach(function(check) {
            arrayId.push(check.value)
        })

        var url = "{{url('sweetalert/additionalOrder/sendToApproval')}}"
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: arrayId
        }

        Swal.fire({
            title: "Send Approval?",
            text: "Please ensure and then confirm!",
            type: "info",
            icon: 'question',
            showCancelButton: true,
            reverseButtons: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: 'JSON',
                    cache: false,
                    success: function(response) {
                        if(response.status == 'success') {
                            Swal.fire("Success!", "", "success")
                            showTable('draft')
                        } else {
                            Swal.fire("Failed", "", "error")
                        }
                    },
                    statusCode: {
                        500: function() {
                            Swal.fire("Oops, Something went Wrong", "", "error")
                        }
                    },
                    failure: function (response) {
                        Swal.fire("Oops, Something went Wrong", "", "error")
                    },
                    error: function (response) {
                        Swal.fire("Oops, Something went Wrong", "", "error")
                    },
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            
        })
    }

    function deleteProcess() {
        var check = document.querySelectorAll('.checkId:checked')
        var arrayId = [];
        for(var i = 0;i==count;i++) {
            arrayId.push(check[i-1].value)
        }
    }

    document.addEventListener('livewire:load', function() {
        showTable('draft')
    });

    function getUrlAjax(status) {
        if(status == 'draft') {
            return "{{ url('datatable/additionalOrderJsonDraft') }}"
        } else if(status == 'waiting_approval_dealer_principle') {
            return "{{ url('datatable/additionalOrderJsonWaitingApprovalDealerPrinciple') }}"
        } else if(status == 'approval_dealer_principle') {
            return "{{ url('datatable/additionalOrderJsonApprovalDealerPrinciple') }}"
        } else if(status == 'submitted_atpm') {
            return "{{ url('datatable/additionalOrderJsonSubmittedATPM') }}"
        } else if(status == 'atpm_allocation') {
            return "{{ url('datatable/additionalOrderJsonATPMAllocation') }}"
        }
    }

    function getDataStatusProgress(status) {
        if(status == 'draft') { // di Dealer
            var dataStatusProgress = {
                data: 'date_save_order', 
                name: 'date_save_order', 
                title: 'Date Draft'
            }
        } else if(status == 'waiting_approval_dealer_principle') { // di BM
            var dataStatusProgress = {
                data: 'date_send_approval', 
                name: 'date_send_approval', 
                title: 'Date Send Approval'
            }
        } else if(status == 'approval_dealer_principle') {
            var dataStatusProgress = {
                data: 'date_approval', 
                name: 'date_approval', 
                title: 'Date Approval'
            }
        } else if(status == 'submitted_atpm') { // di ATPM
            var dataStatusProgress = {
                data: 'date_submit_atpm_order', 
                name: 'date_submit_atpm_order', 
                title: 'Date Submit ATPM'
            }
        } else if(status == 'atpm_allocation') {
            var dataStatusProgress = {
                data: 'date_alocation_atpm', 
                name: 'date_alocation_atpm', 
                title: 'Date Allocatation'
            }
        }

        return dataStatusProgress
    }

    function getAction(status) {
        if(status == 'draft') {
            var dataAction = {
                data: 'action',
                name: 'action',
                title: '<input type="checkbox" class="new-control-input" onclick="allChecked(this.checked)">',
                searchable: false,
                orderable: false
            }
        } else {
            var dataAction = {
                data: null,
                name: null,
                title: '',
                searchable: false,
                orderable: false,
                defaultContent: ''
            }
        }
        return dataAction
    }

    function showTable(status) {
        var template = Handlebars.compile($("#details-template").html());
        var table = $('#master-additional-table').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: getUrlAjax(status),
            columns: [
                { className: 'details-control', data: null, searchable: false, orderable: false, defaultContent: '' },
                getAction(status),
                { data: 'no_order_dealer', name: 'no_order_dealer', title: 'No Order Dealer' },
                { data: 'no_order_atpm', name: 'no_order_atpm', title: 'Order Sequence' },
                getDataStatusProgress(status),
                { data: 'user_order', name: 'user_order', title: 'User Order' },
                { data: 'total_qty', name: 'total_qty', title: 'Total Qty' }
            ]
        });

        // Add event listener for opening and closing details
        $('#master-additional-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'detail';

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template(row.data())).show();
                initTable(tableId, row.data());
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray');
            }
        });

    }

    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            paging: false,
            "stripeClasses": [],
            processing: true,
            serverSide: true,
            searching: false,
            "ordering": true,
            "info": false,
            destroy: true,
            ajax: data.details_url,
            columns: [{
                    data: 'model_name',
                    name: 'model_name'
                },
                {
                    data: 'type_name',
                    name: 'type_name'
                },
                {
                    data: 'colour_name',
                    name: 'colour_name'
                },
                {
                    data: 'year_production',
                    name: 'year_production'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
            ]
        })
    }

    function showTableTab(status) {
        showHideButton(status)
        $('#master-additional-table').DataTable().destroy(); 
        $('#master-additional-table').html('');

        var template = Handlebars.compile($("#details-template").html());
        var table = $('#master-additional-table').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: getUrlAjax(status),
            columns: [
                { className: 'details-control', data: null, searchable: false, orderable: false, defaultContent: '' },
                getAction(status),
                { data: 'no_order_dealer', name: 'no_order_dealer', title: 'No Order Dealer' },
                { data: 'no_order_atpm', name: 'no_order_atpm', title: 'Order Sequence' },
                getDataStatusProgress(status),
                { data: 'user_order', name: 'user_order', title: 'User Order' },
                { data: 'total_qty', name: 'total_qty', title: 'Total Qty' }
            ]
        });

        // Add event listener for opening and closing details
        $('#master-additional-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'detail';

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template(row.data())).show();
                initTable(tableId, row.data());
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray');
            }
        });
    }

    function showHideButton(status) {
        var sendButtonApprovalEl = document.getElementById('sendApprovalButton')
        if(status == 'draft') {
            sendButtonApprovalEl.style.display = 'inline-flex'
        } else {
            sendButtonApprovalEl.style.display = 'none'
        }

        var editButtonEl = document.getElementById('editButton')
        if(status == 'draft') {
            editButtonEl.style.display = 'inline-flex'
        } else {
            editButtonEl.style.display = 'none'
        }

        var addButtonEl = document.getElementById('addButton')
        if(status == 'draft') {
            addButtonEl.style.display = 'inline-flex'
        } else {
            addButtonEl.style.display = 'none'
        }
    }
</script>
@endpush
