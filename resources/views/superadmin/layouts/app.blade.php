<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Super Admin - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/planters.css') }}">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.5/dist/sweetalert2.all.min.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="{{ asset('js/Chart.js') }}"></script>
    <script src="https://unpkg.com/scrollreveal"></script>

    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
@yield('preload')

    <div class="wrapper">
        @include('superadmin.layouts.navbar')

        @include('superadmin.layouts.sidebar')

        @yield('modal')


        <div class="content-wrapper" style="background-color: #f9f9fa;">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1 class="m-0 text-dark"> @yield('content-title') </h1>
                            @yield('breadcrumb')
                        </div>
                        <div class="col-sm-4"> @yield('add-owner') </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid" style="min-height: 100vh">

                    @include('superadmin.layouts.messages')

                    @yield('content')
                </div>
            </div>
        </div>
        @include('superadmin.layouts.footer')

    </div>
    @yield('modal')
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="{{ asset('js/knob.min.js') }}"></script>
    <script src="{{ asset('js/numscroller.js') }}"></script>
    <!-- dashboard js -->
    @yield('dashboard-js')

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function setResponsiveness(x) {
            if (x.matches) { // If media query matches
                $('#myTable').addClass('table-responsive')
            } else {
                $('#myTable').removeClass('table-responsive')
            }
        }

        var x = window.matchMedia("(max-width: 767px)")
        setResponsiveness(x) // Call listener function at run time
        x.addListener(setResponsiveness)
    </script>
    @yield('js')
</body>

</html>