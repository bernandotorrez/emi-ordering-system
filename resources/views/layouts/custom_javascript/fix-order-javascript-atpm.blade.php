
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
    var month = document.getElementById('id_month').value
    var url = window.location.href
    if (url.includes('fix-order-atpm')) {
        showTable(month)

        updateCheck('')
    }
})

Livewire.on('triggerGoTo', function(url) {
    var month = document.getElementById('id_month').value
    window.location.href = url+'/'+month
})

function changeMonthIdTo(monthIdTo) {
    var monthIdToTab = document.getElementById('month_id_to_tab')
    monthIdToTab.value = monthIdTo
}

function changeMonth(month) {
    var inputMonthEl = document.getElementById('id_month')
    inputMonthEl.value = month
    showTableTab(month)
}

function allChecked(status) {
    var arrayChecked = document.querySelectorAll('.checkId');
    arrayChecked.forEach(function (check) {
        check.checked = status
    })

    updateCheck('')
}

function disableButton() {
    var allocateButtonEl = document.getElementById('allocateButtonAjaxLoad')

    allocateButtonEl.setAttribute('disabled', true)
}

function updateCheck(id, approved) {
    var count = document.querySelectorAll('.checkId:checked').length

    var allocateButtonAjaxLoadEl = document.getElementById('allocateButtonAjaxLoad')
    if (allocateButtonAjaxLoadEl != null) {
        var allocateButtonEditable = allocateButtonAjaxLoadEl.getAttribute('data-editableByJS')
        if (allocateButtonEditable == 'true') {
            if (count == 0 || approved == '0') {
                allocateButtonAjaxLoadEl.setAttribute('disabled', true)
            } else {
                allocateButtonAjaxLoadEl.removeAttribute('disabled')
            }
        }
    }
}


function showHideButtonFirstLoad() {
    //var divButtonFirstLoadEl = document.getElementById('button_first_load')
    var divButtonSecondLoadEl = document.getElementById('button_ajax_load')
    var month = document.getElementById('id_month').value
    var monthIdTo = document.getElementById('month_id_to').value
    var currentMonth = "{{date('m')}}"

    var allocateButtonAjaxLoadEl = document.getElementById('allocateButtonAjaxLoad')

    divButtonSecondLoadEl.style.display = 'inline-flex'

    var dataAjax = getRangeMonthFixOrder(currentMonth, month)
    dataAjax.then(function(dataRange) {
        var data = dataRange.data
        var checkBeforeOrAfter = dataRange.checkBeforeOrAfter
        var countOrder = dataRange.countOrder

        if(checkBeforeOrAfter) {

            if(data.flag_button_submit_before == '1') {
                allocateButtonAjaxLoadEl.setAttribute('data-editableByJS', 'true') 
                allocateButtonAjaxLoadEl.disabled = true
            } else {
                allocateButtonAjaxLoadEl.setAttribute('data-editableByJS', 'false') 
                allocateButtonAjaxLoadEl.disabled = true
            }
        } else {
            if(data.flag_button_submit_after == '1') {
                allocateButtonAjaxLoadEl.setAttribute('data-editableByJS', 'true') 
                allocateButtonAjaxLoadEl.disabled = true
            } else {
                allocateButtonAjaxLoadEl.setAttribute('data-editableByJS', 'false') 
                allocateButtonAjaxLoadEl.disabled = true
            }
        }
        
    })

    // if(monthIdTo == month) {
    //     divButtonFirstLoadEl.style.display = 'inline-flex' 
    //     divButtonSecondLoadEl.style.display = 'none'
    // } else {
    //     divButtonFirstLoadEl.style.display = 'none' 
    //     divButtonSecondLoadEl.style.display = 'inline-flex'
    // }
}

function hideAllButton() {
    //var divButtonFirstLoadEl = document.getElementById('button_first_load')
    var divButtonSecondLoadEl = document.getElementById('button_ajax_load')

    //divButtonFirstLoadEl.style.display = 'none' 
    divButtonSecondLoadEl.style.display = 'none'
}

function sendAllocatedAtpm() {
    var month = document.getElementById('id_month').value

    var arrayChecked = document.querySelectorAll('.checkId:checked');
    var arrayId = [];

    arrayChecked.forEach(function (check) {
        arrayId.push(check.value)
    })

    var url = "{{url('sweetalert/fixOrder/allocatedAtpm')}}"
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: arrayId,
        id_month: month
    }

    Swal.fire({
        title: 'Allocated?',
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
                success: function (response) {
                    if (response.status == 'success') {
                        Swal.fire("Success!", "", "success")
                        showTableTab(month)
                    } else {
                        Swal.fire("Failed", "", "error")
                    }
                },
                statusCode: {
                    500: function () {
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

function getRangeMonthFixOrder(idMonth, monthIdTo) {
    var url = "{{url('ajax/fixOrder/rangeMonthFixOrder')}}"

    return $.ajax({
        type: 'GET',
        url: url,
        dataType: 'JSON',
        data: {
            idMonth: idMonth,
            monthIdTo: monthIdTo
        },
        success: function (response) {
            return response
        },
        statusCode: {
            500: function () {
                Swal.fire("Oops, Something went Wrong", "", "error")
            }
        },
        failure: function (response) {
            Swal.fire("Oops, Something went Wrong", "", "error")
        },
        error: function (response) {
            Swal.fire("Oops, Something went Wrong", "", "error")
        },
    })
}

function showTable(month) {
    //showHideButton()
    //showHideButtonFirstLoad()
    disableButton()
    var template = Handlebars.compile($("#details-template").html());
    var table = $('#master-fixorder-atpm-table').DataTable({
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
        ajax: "{{url('datatable/FixOrderJsonAllocationAtpm')}}",
        columnDefs: [{
            "visible": false,
            "targets": 2
        }],
        columns: [{
                className: 'details-control',
                data: null,
                searchable: false,
                orderable: false,
                defaultContent: ''
            },
            {
                data: 'action',
                name: 'action',
                title: '',
                searchable: false,
                orderable: false
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
                title: 'Order Sequence'
            },
            {
                data: 'date_submit_atpm_order',
                name: 'date_submit_atpm_order',
                title: 'Date Submit to ATPM'
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
                data: 'status_progress',
                name: 'status_progress',
                title: 'Status Progress'
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
    $('#master-fixorder-atpm-table tbody').off('click', 'td.details-control');
    $('#master-fixorder-atpm-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'detail-' + row.data().id_master_fix_order_unit;

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

function showTableTab(month) {
    //showHideButton()
    //showHideButtonFirstLoad()
    disableButton()
    $('#master-fixorder-atpm-table').DataTable().destroy();
    $('#master-fixorder-atpm-table').html('');

    var template = Handlebars.compile($("#details-template").html());
    var table = $('#master-fixorder-atpm-table').DataTable({
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
        ajax: month ? "{{url('datatable/FixOrderJsonAllocationAtpm?month=')}}" + month : "{{url('datatable/FixOrderJsonAllocationAtpm')}}",
        columnDefs: [{
            "visible": false,
            "targets": 2
        }],
        columns: [{
                className: 'details-control',
                data: null,
                searchable: false,
                orderable: false,
                defaultContent: ''
            },
            {
                data: 'action',
                name: 'action',
                title: '',
                searchable: false,
                orderable: false
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
                title: 'Order Sequence'
            },
            {
                data: 'date_submit_atpm_order',
                name: 'date_submit_atpm_order',
                title: 'Date Submit to ATPM'
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
                data: 'status_progress',
                name: 'status_progress',
                title: 'Status Progress'
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
    $('#master-fixorder-atpm-table tbody').off('click', 'td.details-control');
    $('#master-fixorder-atpm-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'detail-' + row.data().id_master_fix_order_unit;

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

function showTableReadOnly(month) {
    //showHideButton()
    hideAllButton()
    disableButton()
    $('#master-fixorder-atpm-table').DataTable().destroy();
    $('#master-fixorder-atpm-table').html('');

    var template = Handlebars.compile($("#details-template").html());
    var table = $('#master-fixorder-atpm-table').DataTable({
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
        ajax:  "{{url('datatable/FixOrderJsonAllocationAtpm?month=')}}" + month,
        columnDefs: [{
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
                title: 'Order Sequence'
            },
            {
                data: 'date_submit_atpm_order',
                name: 'date_submit_atpm_order',
                title: 'Date Submit to ATPM'
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
                data: 'status_progress',
                name: 'status_progress',
                title: 'Status Progress'
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
    $('#master-fixorder-atpm-table tbody').off('click', 'td.details-control');
    $('#master-fixorder-atpm-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'detail-' + row.data().id_master_fix_order_unit;

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
        columns: [{
                className: 'sub-details-control',
                data: null,
                searchable: false,
                orderable: false,
                defaultContent: ''
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
                data: 'total_qty',
                name: 'total_qty',
                title: 'Total Qty'
            },
        ]
    })

    // Add event listener for opening and closing details
    $('#detail-' + data.id_master_fix_order_unit + ' tbody').off('click', 'td.sub-details-control');
    $('#detail-' + data.id_master_fix_order_unit + ' tbody').on('click', 'td.sub-details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'sub-detail-' + row.data().id_detail_fix_order_unit;

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