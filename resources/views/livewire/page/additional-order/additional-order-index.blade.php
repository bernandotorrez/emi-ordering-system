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
                                <i class="fas fa-user-clock"></i> Waiting Approval Dealer Principle</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('approval_dealer_principle')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-user-check"></i> Approval Dealer Principle</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('submitted_atpm')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-file-import"></i> Submited ATPM</a>
                        </li>
                        <li class="nav-item" onclick="showTableTab('atpm_allocation')">
                            <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab"
                                href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact"
                                aria-selected="false">
                                <i class="fas fa-shipping-fast"></i> ATPM Allocation</a>
                        </li>
                    </ul>



                    <a class="btn btn-primary mr-2" id="addButton" href="{{route('additional-order.add')}}">Add</a>

                    <button type="button" class="btn btn-success mr-2" id="editButton"
                        wire:click.prevent="goTo($event.target.value)" value="" disabled>Amend</button>

                    <button type="button" class="btn btn-danger mr-2" id="deleteButton" onclick="deleteProcess()"
                        disabled>Delete</button>

                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered table-hover" id="master-additional-table">
                            <thead>
                                <tr>
                                    <th></th>
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


@push('scripts')
<script id="details-template" type="text/x-handlebars-template">
        <h5 class="mt-2 text-center">Detail Order</h5>
        <table class="table table-hover table-dark details-table" id="detail">
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
            editButtonEl.value = '{!! route('additional-order.edit') !!}/'+id
        }

        var deleteButtonEl = document.getElementById('deleteButton')

        if(count == 0) {
            deleteButtonEl.setAttribute('disabled', true) 
        } else {
            deleteButtonEl.removeAttribute('disabled')
        }
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
            return '{!! url('datatable/additionalOrderJsonDraft') !!}'
        } else if(status == 'waiting_approval_dealer_principle') {
            return '{!! url('datatable/additionalOrderJsonWaitingApprovalDealerPrinciple') !!}'
        } else if(status == 'approval_dealer_principle') {
            return '{!! url('datatable/additionalOrderJsonApprovalDealerPrinciple') !!}'
        } else if(status == 'submitted_atpm') {
            return '{!! url('datatable/additionalOrderJsonSubmittedATPM') !!}'
        } else if(status == 'atpm_allocation') {
            return '{!! url('datatable/additionalOrderJsonATPMAllocation') !!}'
        }
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
            ajax: getUrlAjax(status),
            columns: [
                { className: 'details-control', data: null, searchable: false, orderable: false, defaultContent: '' },
                { data: 'action', name: 'action', searchable: false, orderable: false },
                { data: 'no_order_dealer', name: 'no_order_dealer' },
                { data: 'no_order_atpm', name: 'no_order_atpm' },
                { data: 'date_save_order', name: 'date_save_order' },
                { data: 'user_order', name: 'user_order' },
                { data: 'total_qty', name: 'total_qty' }
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

        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                paging: false,
                "stripeClasses": [],
                processing: true,
                serverSide: true,
                searching: false,
                "ordering": true,
                "info":     false,
                ajax: data.details_url,
                columns: [
                    { data: 'model_name', name: 'model_name' },
                    { data: 'type_name', name: 'type_name' },
                    { data: 'colour_name', name: 'colour_name' },
                    { data: 'year_production', name: 'year_production' },
                    { data: 'qty', name: 'qty' },
                ]
            })
        }
    }

    function showTableTab(status) {
        $('#master-additional-table').DataTable().clear().destroy();
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
            ajax: getUrlAjax(status),
            columns: [
                { className: 'details-control', data: null, searchable: false, orderable: false, defaultContent: '' },
                { data: 'action', name: 'action', searchable: false, orderable: false },
                { data: 'no_order_dealer', name: 'no_order_dealer' },
                { data: 'no_order_atpm', name: 'no_order_atpm' },
                { data: 'date_save_order', name: 'date_save_order' },
                { data: 'user_order', name: 'user_order' },
                { data: 'total_qty', name: 'total_qty' }
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

        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                paging: false,
                "stripeClasses": [],
                processing: true,
                serverSide: true,
                searching: false,
                "ordering": true,
                "info":     false,
                ajax: data.details_url,
                columns: [
                    { data: 'model_name', name: 'model_name' },
                    { data: 'type_name', name: 'type_name' },
                    { data: 'colour_name', name: 'colour_name' },
                    { data: 'year_production', name: 'year_production' },
                    { data: 'qty', name: 'qty' },
                ]
            })
        }
    }
</script>
@endpush
