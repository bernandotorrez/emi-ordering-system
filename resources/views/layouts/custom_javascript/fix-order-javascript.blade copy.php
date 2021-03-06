
<script id="details-template" type="text/x-handlebars-template" data-turbolinks-track="reload">
    <h5 class="mt-2 text-center">Detail @{{no_order_dealer}} Order</h5>
    <table class="table table-hover details-table" id="detail-@{{id_master_fix_order_unit}}">

    </table>
</script>

<script id="sub-details-template" type="text/x-handlebars-template" data-turbolinks-track="reload">
    <h5 class="mt-2 text-center">List @{{model_name}} Colour</h5>
    <table class="table table-hover details-table" id="sub-detail-@{{id_detail_fix_order_unit}}">
        <thead>
           
        </thead>
    </table>
</script>

<script data-turbolinks-track="reload">
document.addEventListener('livewire:load', function () {
    var url = window.location.href
    if (url.includes('fix-order')) {
        showTable()
    }
})

function showHideAddButton(month) {
    var currentDate = "{{date('d-m-Y')}}"
    var addButtonEl = document.getElementById('addButton')
    var currentMonth = currentDate.split('-')[1]

    if (month == currentMonth - 1) {
        addButtonEl.style.display = 'inline-flex'
    } else {
        addButtonEl.style.display = 'none'
    }
}

function changeMonth(month) {
    var inputMonthEl = document.getElementById('id_month')
    inputMonthEl.value = month
    showTable(month)
}


function showTable(month) {
    //showHideButton()
    var template = Handlebars.compile($("#details-template").html());
    var table = $('#master-fixorder-table').DataTable({
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
        ajax: month ? "{{url('datatable/fixOrderJson?month=')}}"+month : "{{url('datatable/fixOrderJson')}}",
        columnDefs : [{
                "visible": false,
                "targets": 1
        }],
        columns: [{
                className: 'details-control',
                data: null,
                searchable: false,
                orderable: false,
                defaultContent: ''
            },
            {
                data: 'id_master_fix_order_unit',
                data: 'id_master_fix_order_unit',
                title: 'ID',
            },
            {
                data: 'no_order_dealer',
                name: 'no_order_dealer',
                title: 'No Order Dealer'
            },
            {
                data: 'no_order_atpm',
                name: 'no_order_atpm',
                title: 'No Order ATPm'
            },
            {
                data: 'date_save_order',
                name: 'date_save_order',
                title: 'Date Save Order'
            },
            {
                data: 'user_order',
                name: 'user_order',
                title: 'User Order'
            },
            {
                data: 'grand_total_qty',
                name: 'grand_total_qty',
                title: 'Grand Total Qty'
            },
            {
                data: 'remark_revise',
                name: 'remark_revise',
                title: 'Remark Revise',
            },
            {
                data: 'date_revise',
                name: 'date_revise',
                title: 'Date Revise',
            },
        ]
    });

    // Add event listener for opening and closing details
    $('#master-fixorder-table tbody').off('click', 'td.details-control');
    $('#master-fixorder-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'detail-'+row.data().id_master_fix_order_unit;

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
    var template = Handlebars.compile($("#sub-details-template").html());
    var table = $('#' + tableId).DataTable({
        paging: false,
        "stripeClasses": [],
        processing: true,
        serverSide: true,
        searching: false,
        "ordering": true,
        "info": false,
        destroy: true,
        ajax: data.details_url,
        columnDefs : [{
                "visible": false,
                "targets": 1
        }],
        columns: [
                {
                    className: 'sub-details-control',
                    data: null,
                    searchable: false,
                    orderable: false,
                    defaultContent: ''
                },
                {
                data: 'id_detail_fix_order_unit',
                data: 'id_detail_fix_order_unit',
                title: 'ID',
            },
            {
                data: 'model_name',
                name: 'model_name',
                title: 'Model Name'
            },
            {
                data: 'type_name',
                name: 'type_name',
                title: 'Type Name'
            },
            {
                data: 'year_production',
                name: 'year_production',
                title: 'Year Production'
            },
            {
                data: 'total_qty',
                name: 'total_qty',
                title: 'Total Qty'
            },
        ]
    })

    // Add event listener for opening and closing details
    $('#detail tbody').off('click', 'td.sub-details-control');
    $('#detail tbody').on('click', 'td.sub-details-control', function () {
        console.log('tes')
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'sub-detail-'+row.data().id_detail_fix_order_unit;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initSubTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });
}

function initSubTable(tableId, data) {
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
                data: 'colour_name',
                name: 'colour_name',
                title: 'Colour Name'
            },
            {
                data: 'qty',
                name: 'qty',
                title: 'Qty'
            },
        ]
    })
}
</script>