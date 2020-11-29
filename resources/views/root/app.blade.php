<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('web-title')</title>
        <meta name="description" content="Responsive, Bootstrap, BS4" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="{{  asset('basik/assets/css/bootstrap.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{  asset('basik/assets/css/theme.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{  asset('basik/assets/css/style.css') }}" type="text/css" />
    </head>
    <body class="layout-row">
        <div id="aside" class="page-sidenav no-shrink bg-light nav-dropdown fade" aria-hidden="true">
            <div class="sidenav h-100 bg-light modal-dialog">
                <div class="navbar">
                    <a href="index.html" class="navbar-brand ">
                        <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g class="loading-spin" style="transform-origin: 256px 256px">
                                <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"></path>
                            </g>
                        </svg>
                        <span class="hidden-folded d-inline l-s-n-1x ">Basik</span>
                    </a>
                </div>
                <div class="flex scrollable hover">
                    @include('root.navs')
                </div>
                <div class="no-shrink ">
                    <div class="p-3 d-flex align-items-center">
                        <div class="text-sm hidden-folded text-muted">
                            Trial: 35%
                        </div>
                        <div class="progress mx-2 flex" style="height:4px;">
                            <div class="progress-bar gd-success" style="width: 35%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="main" class="layout-column flex">
            <div id="header" class="page-header ">
                <div class="navbar navbar-expand-lg">
                    <a href="index.html" class="navbar-brand d-lg-none">
                        <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g class="loading-spin" style="transform-origin: 256px 256px">
                                <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"></path>
                            </g>
                        </svg>
                        <span class="hidden-folded d-inline l-s-n-1x d-lg-none">Basik</span>
                    </a>
                    <div>
                        <a href="https://themeforest.net/item/basik-responsive-bootstrap-web-admin-template/23365964" class="btn btn-md text-muted">
                            <span class="d-none d-sm-inline mx-1">Buy this Item</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <ul class="nav navbar-menu order-1 order-lg-2">
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link d-flex align-items-center px-2 text-color">
                                <span>Jacqueline Reid</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right w mt-3 animate fadeIn">
                                <a class="dropdown-item" href="signin.html">Sign out</a>
                            </div>
                        </li>
                        {{-- <li class="nav-item d-lg-none">
                            <a href="#" class="nav-link px-2" data-toggle="collapse" data-toggle-class data-target="#navbarToggler">
                                <i data-feather="search"></i>
                            </a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link px-1" data-toggle="modal" data-target="#aside">
                                <i data-feather="menu"></i>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div id="content" class="flex ">
                <div>
                    <div class="page-hero page-container " id="page-hero">
                        <div class="padding d-flex">
                            <div class="page-title">
                                <h2 class="text-md text-highlight">@yield('content-title')</h2>
                                {{-- <small class="text-muted">Custom components for creating a wide variety of forms</small> --}}
                            </div>
                            <div class="flex"></div>
                            {{-- <div>
                                <a href="https://themeforest.net/item/basik-responsive-bootstrap-web-admin-template/23365964" class="btn btn-md text-muted">
                                    <span class="d-none d-sm-inline mx-1">Buy this Item</span>
                                    <i data-feather="arrow-right"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div class="padding">
                            <div class="row">
                                @include('root.msg')
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer" class="page-footer hide">
                <div class="d-flex p-3">
                    <span class="text-sm text-muted flex">&copy; Copyright. flatfull.com</span>
                    <div class="text-sm text-muted">Version 1.0.3</div>
                </div>
            </div>
        </div>

        <script src="{{ asset('basik/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('basik/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('basik/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('basik/libs/pjax/pjax.min.js') }}"></script>
        <script src="{{ asset('basik/assets/js/ajax.js') }}"></script>
        <script src="{{ asset('basik/assets/js/lazyload.config.js') }}"></script>
        <script src="{{ asset('basik/assets/js/lazyload.js') }}"></script>
        <script src="{{ asset('basik/assets/js/plugin.js') }}"></script>
        <script src="{{ asset('basik/libs/scrollreveal/dist/scrollreveal.min.js') }}"></script>
        <script src="{{ asset('basik/libs/feather-icons/dist/feather.min.js') }}"></script>
        <script src="{{ asset('basik/assets/js/plugins/feathericon.js') }}"></script>
        <script src="{{ asset('basik/assets/js/theme.js') }}"></script>
        <script src="{{ asset('basik/assets/js/utils.js') }}"></script>

    </body>
</html>