<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <a class="btn btn-primary mr-4" id="addButton" href="{{route('additional-order.add')}}">Add</a>

                <button type="button" class="btn btn-success mr-4" id="editButton"
                wire:click.prevent="goTo($event.target.value)" value="" disabled>Edit</button>

                <button type="button" class="btn btn-danger mr-4" id="deleteButton"disabled>Delete</button>

                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered" id="master-additional-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Action</th>
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


@push('scripts')
<script id="details-template" type="text/x-handlebars-template">
        <h5 class="mt-2 text-center">Detail order</h5>
        <table class="table details-table" id="detail">
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
    
    function updateEditId(id) {
        var count = document.querySelectorAll('.checkId:checked').length
        var editButtonEl = document.getElementById('editButton')

        if(count == 0 || count > 1) {
            editButtonEl.setAttribute('disabled', true)
        } else {
            editButtonEl.removeAttribute('disabled')
            editButtonEl.value = '{!! route('additional-order.edit') !!}/'+id
        }
    }

    function updateDeleteId(id) {
        var count = document.querySelectorAll('.checkId:checked').length
        var deleteButtonEl = document.getElementById('deleteButton')

        if(count == 0) {
            deleteButtonEl.setAttribute('disabled', true) 
        } else {
            deleteButtonEl.removeAttribute('disabled')
        }
    }

    document.addEventListener('livewire:load', function() {
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
        ajax: '{!! url('datatable/additionalOrderJson') !!}',
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
            "ordering": false,
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
});
</script>
@endpush
