<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PLANTERS - Login to System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <style>
        .error {
            border-color: #dc3545;
        }

        body {
            background-image: url("{{ asset('images/palm-oil.jpg') }}") !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
            background-size: cover !important;
        }

        .login-page {
            position: relative;
        }

        .wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            background: rgba(154, 154, 154, 0.8);
        }
        .animate_delay-1s {
            animation-delay: 500ms;
        }

    </style>
</head>

<body class="hold-transition">
    <div class="wrapper login-page">
        <div class="login-box animate__animated animate__flipInX animate_delay-1s">
            <!-- /.login-logo -->
            <div class="card border-radius">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <a href="#"><b>PLANTERS</b> | <small style="font-size: 17px"> Vokasi IPB</small></a>
                    </div>
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form id="login-form" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email"
                                value="super_admin@planters-svipb.com">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control" placeholder="Password"
                                name="password" value="plantersvokasiipb">
                            <div class="input-group-append">
                                <div class="input-group-text" style="cursor: pointer">
                                    <span class="fas fa-lock" id="lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
                            </div>
                            <div class="col-4">
                                <button id="btn-login" type="submit"
                                    class="btn btn-sm btn-outline-primary btn-block">Sign
                                    In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        $(document).ready(function () {
            // $(document).on('submit', '#login-form', function (e) {
            //     e.preventDefault()
            // })
            let state = true
            $(document).on('click', '#lock', function () {
                $('#lock').toggleClass('fa-lock fa-unlock')
                if (state){
                    $('#password').attr('type', 'text')
                    state = false
                } else {
                    $('#password').attr('type', 'password')
                    state = true
                }
            })

            $(document).on('click', '#btn-login', function (e) {
                e.preventDefault();
                $('#btn-login').text('Cheking..')
                axios.post('/login', {
                        email: $('#email').val(),
                        password: $('#password').val(),
                    }).then(function (response) {
                        switch (response.data.role) {
                            case 'assistant':
                                location.href = '{{ route("assistant.afdelling.blocks") }}'
                                break;

                            case 'farmmanager':
                                location.href = '{{ route("manager.farm.afdellings") }}'
                                break;

                            case 'superadmin':
                                location.href = '{{ route("superadmin.dashboard") }}'
                                break;
                        }
                    })
                    .catch(function (error) {
                        $('#email').addClass('error animate__animated animate__headShake')
                        $('#password').addClass('error animate__animated animate__headShake')
                        $('.input-group-text').addClass(
                            'error animate__animated animate__headShake')
                    }).finally(function () {
                        setTimeout(() => {
                            $('#email').removeClass(
                                'error animate__animated animate__headShake')
                            $('#password').removeClass(
                                'error animate__animated animate__headShake')
                            $('.input-group-text').removeClass(
                                'error animate__animated animate__headShake')
                        }, 4500);
                        $('#btn-login').text('Sign In')
                    })
            })
        })

    </script>

</body>

</html>
