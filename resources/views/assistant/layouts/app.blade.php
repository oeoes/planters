<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Assistant - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <style>
      #myTable_wrapper {
        padding: 10px
      }
    </style>
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- @include('sweetalert::alert') --}}
        @include('layouts.navbar')

        @include('layouts.sidebar')

        @yield('modal')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> @yield('content-title') </h1>
                        </div>
                        <div class="col-sm-6"> @yield('breadcumb') </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid" style="min-height: 1000px">

                    @include('layouts.messages')

                    @yield('content')
                </div>
            </div>
        </div>
        @include('layouts.footer')

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

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

    </script>
    @yield('js')
</body>

</html>
