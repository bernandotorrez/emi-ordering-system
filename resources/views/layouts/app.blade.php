
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Eurokars DMS @isset($title) - {{ $title }} @endisset</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon/favicon-32x32.png') }}"> 
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon/favicon-16x16.png') }}"> 
    <link rel="manifest" href="{{ asset('icon/site.webmanifest') }}"> 
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}"/>
    <link href="{{ asset('assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />

    @if(Request::is('login') || Request::is('logout') || Request::is('register'))
    <link href="{{ asset('assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        .layout-px-spacing {
            min-height: calc(100vh - 184px)!important;
        }

        .error {
            color: #e7515a;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .icon-active {
            color: #25d5e4;
        }
    </style>

    @livewireStyles

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- @if(Request::is('login') || Request::is('logout') || Request::is('register'))
    <script src="{{ asset('assets/js/authentication/form-2.js') }}" defer></script>
    @endif -->

    <!-- <script src="{{ asset('assets/js/custom.js') }}"></script> -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @livewireScripts
    <script src="{{ asset('assets/js/turbolink/livewire-turbolinks.js') }}" data-turbolinks-eval="false"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.min.js') }}"></script>

    @stack('scripts')
    <script>
        Livewire.on('closeModal', function () {
            $('#exampleModal').modal('hide')
        })

        Livewire.on('openModal', function () {
            $('#exampleModal').modal('show')
        })

        Livewire.on('deleted', function (deleteStatus) {

            if (deleteStatus == 'success') {
                Swal.fire(
                    'Success!',
                    'Delete Data Success!',
                    'success'
                )
            } else {
                Swal.fire(
                    'Failed!',
                    'Delete Data Failed!',
                    'error'
                )
            }
        })

        
    function formatRupiah(angka, prefix, id) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        var callback = prefix == '' ? rupiah : (rupiah ? rupiah : '')

        var element = document.getElementById('estimation-price.'+id)
        element.value = callback;

        return callback;
    }

    function isNumberKey(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
		if (charCode != 44 && charCode != 45 && charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		} else {
			return true;
		}
    }

    function isQtyKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</head>
<body class="sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    @if(!Request::is('login') && !Request::is('logout') && !Request::is('register'))
    @include('layouts.components.head_menu')
    @endif
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        @if(!Request::is('login') && !Request::is('logout') && !Request::is('register'))
        @include('layouts.components.menu')
        @endif
        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">


                <!-- CONTENT AREA -->
                    {{ $slot }}
                <!-- CONTENT AREA -->

            </div>

            <!-- BEGIN FOOTER -->
            @include('layouts.components.footer')
            <!-- END FOOTER -->


        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

</body>
</html>
