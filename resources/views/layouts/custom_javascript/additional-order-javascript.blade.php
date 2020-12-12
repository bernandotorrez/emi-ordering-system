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
    function getUrlAjax(status) {
        if (status == 'draft') {
            return "{{ url('datatable/additionalOrderJsonDraft') }}"
        } else if (status == 'waiting_approval_dealer_principle') {
            return "{{ url('datatable/additionalOrderJsonWaitingApprovalDealerPrinciple') }}"
        } else if (status == 'approval_dealer_principle') {
            return "{{ url('datatable/additionalOrderJsonApprovalDealerPrinciple') }}"
        } else if (status == 'submitted_atpm') {
            return "{{ url('datatable/additionalOrderJsonSubmittedATPM') }}"
        } else if (status == 'atpm_allocation') {
            return "{{ url('datatable/additionalOrderJsonATPMAllocation') }}"
        } else if (status == 'canceled') {
            return "{{ url('datatable/additionalOrderJsonCanceled') }}"
        }
    }

    function getDataStatusProgress(status) {
        if (status == 'draft') { // di Dealer
            var dataStatusProgress = {
                data: 'date_save_order',
                name: 'date_save_order',
                title: 'Date Draft'
            }
        } else if (status == 'waiting_approval_dealer_principle') { // di BM
            var dataStatusProgress = {
                data: 'date_send_approval',
                name: 'date_send_approval',
                title: 'Date Send Approval'
            }
        } else if (status == 'approval_dealer_principle') {
            var dataStatusProgress = {
                data: 'date_approval',
                name: 'date_approval',
                title: 'Date Approval'
            }
        } else if (status == 'submitted_atpm') { // di ATPM
            var dataStatusProgress = {
                data: 'date_submit_atpm_order',
                name: 'date_submit_atpm_order',
                title: 'Date Submit ATPM'
            }
        } else if (status == 'atpm_allocation') {
            var dataStatusProgress = {
                data: 'date_allocation_atpm',
                name: 'date_allocation_atpm',
                title: 'Date Allocatation'
            }
        } else if (status == 'canceled') {
            var dataStatusProgress = {
                data: 'date_cancel',
                name: 'date_cancel',
                title: 'Date Cancel'
            }
        }

        return dataStatusProgress
    }

    function getDataRemark(status) {
        if (status == 'canceled') {
            var dataRemark = {
                data: 'remark_cancel',
                name: 'remark_cancel',
                title: 'Remark Cancel',
            }
        } else {
            var dataRemark = {
                data: 'remark_revise',
                name: 'remark_revise',
                title: 'Remark Revise',
            }
        }

        return dataRemark
    }

    function getDataDateRemark(status) {
        if (status == 'canceled') {
            var dataDateRemark = {
                data: 'date_cancel',
                name: 'date_cancel',
                title: 'Date Cancel',
            }
        } else {
            var dataDateRemark = {
                data: 'date_revise',
                name: 'date_revise',
                title: 'Date Revise',
            }
        }

        return dataDateRemark

    }

    // TODO: yang perlu diubah
    function getInitData() {
        var url = window.location.href

        if (url.includes('additional-order')) {
            var initData = {
                'table': 'draft',
                'approvalUrl': "{{url('sweetalert/additionalOrder/sendToApproval')}}",
                'approvalTitle': 'Send Approval this Order?',
                'revisionUrl': '',
                'cancelUrl': ''
            }
        } else if (url.includes('approval-bm')) {
            var initData = {
                'table': 'waiting_approval_dealer_principle',
                'approvalUrl': "{{url('sweetalert/additionalOrder/approvedBM')}}",
                'approvalTitle': 'Approve this Order?',
                'revisionUrl': "{{url('sweetalert/additionalOrder/reviseBMDealer')}}",
                'cancelUrl': ''
            }
        } else if (url.includes('approved-bm')) {
            var initData = {
                'table': 'approval_dealer_principle',
                'approvalUrl': "{{url('sweetalert/additionalOrder/submitToAtpm')}}",
                'approvalTitle': 'Submit this Order?',
                'revisionUrl': "{{url('sweetalert/additionalOrder/reviseBMDealer')}}",
                'cancelUrl': "{{url('sweetalert/additionalOrder/cancelBMDealer')}}"
            }
        } else if (url.includes('submit-atpm')) {
            var initData = {
                'table': 'submitted_atpm',
                'approvalUrl': "{{url('sweetalert/additionalOrder/submittedAtpm')}}",
                'approvalTitle': 'Allocate?',
                'revisionUrl': "",
                'cancelUrl': "{{url('sweetalert/additionalOrder/cancelSubmitATPM')}}"
            }
        } else if (url.includes('allocated-atpm')) {
            var initData = {
                'table': 'atpm_allocation',
                'approvalUrl': "",
                'approvalTitle': '',
                'revisionUrl': "",
                'cancelUrl': "{{url('sweetalert/additionalOrder/cancelAllocatedATPM')}}"
            }
        }

        return initData
    }

    document.addEventListener('livewire:load', function () {
        showTable(getInitData().table)
    });

    // TODO: yang perlu di ubah
    function updateCheck(id) {
        var count = document.querySelectorAll('.checkId:checked').length

        if (getInitData().table == 'draft') {
            var editButtonEl = document.getElementById('editButton')
            if (editButtonEl != null) {
                if (count == 0 || count > 1) {
                    editButtonEl.setAttribute('disabled', true)
                } else {
                    editButtonEl.removeAttribute('disabled')
                    editButtonEl.value = "{!! route('additional-order.edit') !!}/" + id
                }
            }

            var sendButtonEl = document.getElementById('sendApprovalButton')
            if (sendButtonEl != null) {
                if (count == 0) {
                    sendButtonEl.setAttribute('disabled', true)
                } else {
                    sendButtonEl.removeAttribute('disabled')
                }
            }
        } else if (getInitData().table == 'waiting_approval_dealer_principle') {
            var sendButtonEl = document.getElementById('sendApprovalButton')
            if (sendButtonEl != null) {
                if (count == 0) {
                    sendButtonEl.setAttribute('disabled', true)
                } else {
                    sendButtonEl.removeAttribute('disabled')
                }
            }

            var sendReviseButtonEl = document.getElementById('sendReviseButton')
            if (sendReviseButtonEl != null) {
                if (count == 0 || count > 1) {
                    sendReviseButtonEl.setAttribute('disabled', true)
                } else {
                    sendReviseButtonEl.removeAttribute('disabled')
                }
            }
        } else if (getInitData().table == 'approval_dealer_principle') {
            var sendButtonEl = document.getElementById('sendApprovalButton')
            if (sendButtonEl != null) {
                if (count == 0) {
                    sendButtonEl.setAttribute('disabled', true)
                } else {
                    sendButtonEl.removeAttribute('disabled')
                }
            }

            var sendReviseButtonEl = document.getElementById('sendReviseButton')
            if (sendReviseButtonEl != null) {
                if (count == 0 || count > 1) {
                    sendReviseButtonEl.setAttribute('disabled', true)
                } else {
                    sendReviseButtonEl.removeAttribute('disabled')
                }
            }

            var sendCancelButtonEl = document.getElementById('sendCancelButton')
            if (sendCancelButtonEl != null) {
                if (count == 0 || count > 1) {
                    sendCancelButtonEl.setAttribute('disabled', true)
                } else {
                    sendCancelButtonEl.removeAttribute('disabled')
                }
            }
        } else if (getInitData().table == 'submitted_atpm') {
            var sendButtonEl = document.getElementById('sendApprovalButton')
            if (sendButtonEl != null) {
                if (count == 0) {
                    sendButtonEl.setAttribute('disabled', true)
                } else {
                    sendButtonEl.removeAttribute('disabled')
                }
            }

            var sendCancelButtonEl = document.getElementById('sendCancelButton')
            if (sendCancelButtonEl != null) {
                if (count == 0 || count > 1) {
                    sendCancelButtonEl.setAttribute('disabled', true)
                } else {
                    sendCancelButtonEl.removeAttribute('disabled')
                }
            }
        } else if (getInitData().table == 'atpm_allocation') {
            var sendCancelButtonEl = document.getElementById('sendCancelButton')
            if (sendCancelButtonEl != null) {
                if (count == 0 || count > 1) {
                    sendCancelButtonEl.setAttribute('disabled', true)
                } else {
                    sendCancelButtonEl.removeAttribute('disabled')
                }
            }
        }

    }

    // TODO: yang perlu diubah
    function showHideButton(status) {
        console.log(status)
        if (getInitData().table == 'draft') {
            var sendButtonApprovalEl = document.getElementById('sendApprovalButton')
            if (sendButtonApprovalEl != null) {
                if (status == 'draft') {
                    sendButtonApprovalEl.style.display = 'inline-flex'
                } else {
                    sendButtonApprovalEl.style.display = 'none'
                }
            }

            var editButtonEl = document.getElementById('editButton')
            if (editButtonEl != null) {
                if (status == 'draft') {
                    editButtonEl.style.display = 'inline-flex'
                } else {
                    editButtonEl.style.display = 'none'
                }
            }

            var addButtonEl = document.getElementById('addButton')
            if (addButtonEl != null) {
                if (status == 'draft') {
                    addButtonEl.style.display = 'inline-flex'
                } else {
                    addButtonEl.style.display = 'none'
                }
            }
        } else if (getInitData().table == 'waiting_approval_dealer_principle') {
            var sendButtonApprovalEl = document.getElementById('sendApprovalButton')
            if (sendButtonApprovalEl != null) {
                if (status == 'waiting_approval_dealer_principle') { // TODO: harus di rubah
                    sendButtonApprovalEl.style.display = 'inline-flex'
                } else {
                    sendButtonApprovalEl.style.display = 'none'
                }
            }

            var sendReviseButtonEl = document.getElementById('sendReviseButton')
            if (sendReviseButtonEl != null) {
                if (status == 'waiting_approval_dealer_principle') { // TODO: harus di rubah
                    sendReviseButtonEl.style.display = 'inline-flex'
                } else {
                    sendReviseButtonEl.style.display = 'none'
                }
            }
        } else if (getInitData().table == 'approval_dealer_principle') {
            var sendButtonApprovalEl = document.getElementById('sendApprovalButton')
            if (sendButtonApprovalEl != null) {
                if (status == 'approval_dealer_principle') { // TODO: harus di rubah
                    sendButtonApprovalEl.style.display = 'inline-flex'
                } else {
                    sendButtonApprovalEl.style.display = 'none'
                }
            }

            var sendReviseButtonEl = document.getElementById('sendReviseButton')
            if (sendReviseButtonEl != null) {
                if (status == 'approval_dealer_principle') { // TODO: harus di rubah
                    sendReviseButtonEl.style.display = 'inline-flex'
                } else {
                    sendReviseButtonEl.style.display = 'none'
                }
            }

            var sendCancelButtonEl = document.getElementById('sendCancelButton')
            if (sendCancelButtonEl != null) {
                if (status == 'approval_dealer_principle') { // TODO: harus di rubah
                    sendCancelButtonEl.style.display = 'inline-flex'
                } else {
                    sendCancelButtonEl.style.display = 'none'
                }
            }

        } else if (getInitData().table == 'submitted_atpm') {
            var sendButtonApprovalEl = document.getElementById('sendApprovalButton')
            if (sendButtonApprovalEl != null) {
                if (status == 'submitted_atpm') { // TODO: harus di rubah
                    sendButtonApprovalEl.style.display = 'inline-flex'
                } else {
                    sendButtonApprovalEl.style.display = 'none'
                }
            }

            var sendCancelButtonEl = document.getElementById('sendCancelButton')
            if (sendCancelButtonEl != null) {
                if (status == 'submitted_atpm') { // TODO: harus di rubah
                    sendCancelButtonEl.style.display = 'inline-flex'
                } else {
                    sendCancelButtonEl.style.display = 'none'
                }
            }
        } else if (getInitData().table == 'atpm_allocation') {
            var sendCancelButtonEl = document.getElementById('sendCancelButton')
            if (sendCancelButtonEl != null) {
                if (status == 'atpm_allocation') { // TODO: harus di rubah
                    sendCancelButtonEl.style.display = 'inline-flex'
                } else {
                    sendCancelButtonEl.style.display = 'none'
                }
            }
        }

        var cancelStatus = document.getElementById('dropdown_cancel_status')
        if (cancelStatus != null) {
            if (status == 'canceled') {
                cancelStatus.style.display = 'block'
            } else {
                cancelStatus.style.display = 'none'
            }
        }

    }

    // TODO: yang perlu diubah
    function getAction(status) {
        var url = window.location.href
        if (status == 'draft' && url.includes('additional-order')) {
            var dataAction = {
                data: 'action',
                name: 'action',
                title: '<input type="checkbox" class="new-control-input" onclick="allChecked(this.checked)">',
                searchable: false,
                orderable: false
            }
        } else if (status == 'waiting_approval_dealer_principle' && url.includes('approval-bm')) {
            var dataAction = {
                data: 'action',
                name: 'action',
                title: '<input type="checkbox" class="new-control-input" onclick="allChecked(this.checked)">',
                searchable: false,
                orderable: false
            }
        } else if (status == 'approval_dealer_principle' && url.includes('approved-bm')) {
            var dataAction = {
                data: 'action',
                name: 'action',
                title: '<input type="checkbox" class="new-control-input" onclick="allChecked(this.checked)">',
                searchable: false,
                orderable: false
            }
        } else if (status == 'submitted_atpm' && url.includes('submit-atpm')) {
            var dataAction = {
                data: 'action',
                name: 'action',
                title: '<input type="checkbox" class="new-control-input" onclick="allChecked(this.checked)">',
                searchable: false,
                orderable: false
            }
        } else if (status == 'atpm_allocation' && url.includes('allocated-atpm')) {
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

    function allChecked(status) {
        var arrayChecked = document.querySelectorAll('.checkId');
        arrayChecked.forEach(function (check) {
            check.checked = status
        })

        updateCheck('')
    }

    function sendApproval() {
        var arrayChecked = document.querySelectorAll('.checkId:checked');
        var arrayId = [];

        arrayChecked.forEach(function (check) {
            arrayId.push(check.value)
        })

        var url = getInitData().approvalUrl
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: arrayId
        }

        Swal.fire({
            title: getInitData().approvalTitle,
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
                            showTable(getInitData().table)
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

    function sendRevision() {
        var arrayChecked = document.querySelectorAll('.checkId:checked');
        var arrayId = [];

        arrayChecked.forEach(function (check) {
            arrayId.push(check.value)
        })

        var url = getInitData().revisionUrl // TODO: Harus di rubah, sesuai Route SweetAlert

        Swal.fire({
            title: "Revise this Order?",
            text: "Please ensure and then confirm!",
            type: "info",
            icon: 'question',
            input: 'text',
            inputPlaceholder: 'Enter your Revise Reason',
            showCancelButton: true,
            reverseButtons: false,
            showLoaderOnConfirm: true,
            preConfirm: (remark_revise) => {
                return $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: arrayId,
                        remark_revise: remark_revise
                    },
                    dataType: 'JSON',
                    cache: false,
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire("Success!", "", "success")
                            showTable(getInitData().table)
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

    function sendCancel() {
        var arrayChecked = document.querySelectorAll('.checkId:checked');
        var arrayId = [];

        arrayChecked.forEach(function (check) {
            arrayId.push(check.value)
        })

        var url = getInitData().cancelUrl // TODO: Harus di rubah, sesuai Route SweetAlert

        Swal.fire({
            title: "Cancel this Order?",
            text: "Please ensure and then confirm!",
            type: "info",
            icon: 'question',
            input: 'text',
            inputPlaceholder: 'Enter your Cancel Reason',
            showCancelButton: true,
            reverseButtons: false,
            showLoaderOnConfirm: true,
            preConfirm: (remark_cancel) => {
                return $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: arrayId,
                        remark_cancel: remark_cancel
                    },
                    dataType: 'JSON',
                    cache: false,
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire("Success!", "", "success")
                            showTable(getInitData().table)
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

    function deleteProcess() {
        var check = document.querySelectorAll('.checkId:checked')
        var arrayId = [];
        for (var i = 0; i == count; i++) {
            arrayId.push(check[i - 1].value)
        }
    }

    function showTable(status) {
        showHideButton(status)
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
            columns: [{
                    className: 'details-control',
                    data: null,
                    searchable: false,
                    orderable: false,
                    defaultContent: ''
                },
                getAction(status),
                {
                    data: 'no_order_dealer',
                    name: 'no_order_dealer',
                    title: 'No Order Dealer'
                },
                getDataRemark(status),
                getDataDateRemark(status),
                {
                    data: 'no_order_atpm',
                    name: 'no_order_atpm',
                    title: 'Order Sequence'
                },
                getDataStatusProgress(status),
                {
                    data: 'user_order',
                    name: 'user_order',
                    title: 'User Order'
                },
                {
                    data: 'total_qty',
                    name: 'total_qty',
                    title: 'Total Qty'
                }
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
            columns: [{
                    className: 'details-control',
                    data: null,
                    searchable: false,
                    orderable: false,
                    defaultContent: ''
                },
                getAction(status),
                {
                    data: 'no_order_dealer',
                    name: 'no_order_dealer',
                    title: 'No Order Dealer'
                },
                getDataRemark(status),
                getDataDateRemark(status),
                {
                    data: 'no_order_atpm',
                    name: 'no_order_atpm',
                    title: 'Order Sequence'
                },
                getDataStatusProgress(status),
                {
                    data: 'user_order',
                    name: 'user_order',
                    title: 'User Order'
                },
                {
                    data: 'total_qty',
                    name: 'total_qty',
                    title: 'Total Qty'
                }
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

    function showTableCancel(status, id) {
        showHideButton(status)
        $('#master-additional-table').DataTable().destroy();
        $('#master-additional-table').html('');
        var ajaxUrl = getUrlAjax(status) + '/' + id

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
            ajax: ajaxUrl,
            columns: [{
                    className: 'details-control',
                    data: null,
                    searchable: false,
                    orderable: false,
                    defaultContent: ''
                },
                getAction(status),
                {
                    data: 'no_order_dealer',
                    name: 'no_order_dealer',
                    title: 'No Order Dealer'
                },
                getDataRemark(status),
                getDataDateRemark(status),
                {
                    data: 'no_order_atpm',
                    name: 'no_order_atpm',
                    title: 'Order Sequence'
                },
                getDataStatusProgress(status),
                {
                    data: 'user_order',
                    name: 'user_order',
                    title: 'User Order'
                },
                {
                    data: 'total_qty',
                    name: 'total_qty',
                    title: 'Total Qty'
                }
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

</script>