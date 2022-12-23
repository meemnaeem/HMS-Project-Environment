<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('doccure/admin/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('doccure/admin/assets/css/bootstrap.min.css') }}"> --}}

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('doccure/admin/assets/css/font-awesome.min.css') }}">
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('doccure/admin/assets/css/line-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('doccure/admin/assets/css/feathericon.min.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="{{ asset('doccure/admin/assets/plugins/datatables/datatables.min.css') }}">

    <!-- Main CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('doccure/admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <x-flatpickr::style />
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    {{-- @livewire('livewire-ui-modal') --}}
    @flashStyle
    @livewireStyles
    @livewireScripts

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('layouts.navigation')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')
                {{-- {{ $slot }} --}}
            </div>

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
    <!-- Custom JS -->
    <!-- jQuery -->
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}
    {{-- <script src="{{ asset('doccure/admin/assets/js/jquery-3.2.1.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('doccure/admin/assets/js/jquery-3.5.1.min.js') }}"></script> --}}
    <!-- Bootstrap Core JS -->
    {{-- <script src="{{ asset('doccure/admin/assets/js/bootstrap.min.js') }}"></script> --}}

    <script src="{{ mix('js/app.js') }}"></script>
    {{-- <script src="{{ asset('doccure/admin/assets/js/popper.min.js') }}"></script> --}}
    <!-- Slimscroll JS -->
    <script src="{{ asset('doccure/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- Datatables JS -->
    <script src="{{ asset('doccure/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('doccure/admin/assets/plugins/datatables/datatables.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> --}}
    {{-- <script src="{{ asset('doccure/admin/assets/js/chart.js') }}"></script> --}}

    <!-- Custom JS -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    @flashScript

    <x-flatpickr::script />

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('urlChange', (url) => {
                history.pushState(null, null, url);
                $('.page-title').text(url.toUpperCase().replace('-', ' '));
                $('.breadcrumb-item.active').text(url.substring(0, 1).toUpperCase().replace('-', ' ') + url
                    .substring(1).replace('-', ' '))
            });
        });

        $(document).ready(function() {
            $(document).ready(function() {
                @if (Session::has('message'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ session('message') }}");
                @endif

                @if (Session::has('error'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ session('error') }}");
                @endif

                @if (Session::has('info'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.info("{{ session('info') }}");
                @endif

                @if (Session::has('warning'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("{{ session('warning') }}");
                @endif
            });

            toastr.options = {
                "positionClass": "toast-top-right",
                "progressBar": true,
                "showDuration": "3000",
            }

            window.addEventListener('hide-modal', function(e) {
                $("#myModal").modal('hide');
                toastr.success(event.detail.message, 'Success!');
            });

            window.addEventListener('hide-assign-modal', function(e) {
                $("#assignModal").modal('hide');
                toastr.success(event.detail.message, 'Success!');
            });

            window.addEventListener('hide-patient1-modal', function(e) {
                $("#myModal").modal('hide')
                $("#patientModal").modal('show');
            });

            window.addEventListener('hide-patient2-modal', function(e) {
                $("#patientModal").modal('hide');
                toastr.success(event.detail.message, 'Success!');
            });

            window.addEventListener('updated', function(e) {
                toastr.success(event.detail.message, 'Success!');
            });

            window.addEventListener('hide-delete-modal', function(e) {
                $("#deleteModal").modal('hide');
                toastr.success(event.detail.message, 'Success!');
            });

            window.addEventListener('hide-multi-delete-modal', function(e) {
                $("#multiDeleteModal").modal('hide');
                toastr.success(event.detail.message, 'Success!');
            });

        });

        window.addEventListener('openModal', function(e) {
            $("#deleteModal").modal('show');
        });

        window.addEventListener('show-modal', function(e) {
            $("#myModal").modal('show');
        });

        window.addEventListener('show-patient-modal', function(e) {
            $("#myModal").modal('show');
        });

        window.addEventListener('show-user-modal', function(e) {
            $("#myModal").modal('show');
        });

        window.addEventListener('open-assign-modal', function(e) {
            $("#assignModal").modal('show');
        });

        window.addEventListener('show-delete-modal', function(e) {
            $("#deleteModal").modal('show');
        });

        window.addEventListener('show-multi-delete-modal', function(e) {
            $("#multiDeleteModal").modal('show');
        });
        // window.addEventListener('preview-form', function(e) {
        //     let name = document.getElementById("name").value;
        //     document.getElementById("patientname").innerHTML = name;
        // });
    </script>

    <script src="{{ asset('doccure/admin/assets/js/script.js') }}"></script>

    @yield('javascripts')
</body>

</html>
