@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="utf-8" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">--}}
{{--    <link rel="icon" type="image/png" href="../assets/img/favicon.png">--}}
{{--    <title>--}}
{{--        Soft UI Dashboard by Creative Tim--}}
{{--    </title>--}}
{{--    <!--     Fonts and icons     -->--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />--}}
{{--    <!-- Nucleo Icons -->--}}
{{--    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />--}}
{{--    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />--}}
{{--    <!-- Font Awesome Icons -->--}}
{{--    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>--}}
{{--    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />--}}
{{--    <!-- CSS Files -->--}}
{{--    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />--}}
{{--</head>--}}

{{--<body class="">--}}

{{--@include('layouts.authNav')--}}

{{--<main class="main-content  mt-0">--}}
{{--    <section class="min-vh-100 mb-8">--}}
{{--        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">--}}
{{--            <span class="mask bg-gradient-dark opacity-6"></span>--}}
{{--            <div class="container">--}}
{{--                <div class="row justify-content-center">--}}
{{--                    <div class="col-lg-5 text-center mx-auto">--}}
{{--                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>--}}
{{--                        <p class="text-lead text-white">Create Your Admin Account Now</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container">--}}
{{--            <div class="row mt-lg-n10 mt-md-n11 mt-n10">--}}
{{--                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">--}}
{{--                    <div class="card z-index-0">--}}
{{--                        <div class="card-header text-center pt-4">--}}
{{--                            <h5>Register with</h5>--}}
{{--                        </div>--}}

{{--                        <div class="card-body">--}}
{{--                            <form method="POST" action="{{ route('register') }}">--}}
{{--                                @csrf--}}
{{--                                <div class="mb-3">--}}
{{--                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon"--}}
{{--                                    id="name" name="name">--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon"--}}
{{--                                           id="email" name="email">--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon"--}}
{{--                                           id="password"  name="password">--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon"--}}
{{--                                           id="password-confirm"  name="password-confirm">--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-check-info text-left">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        I agree the <a href="#" class="text-dark font-weight-bolder">Terms and Conditions</a>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="text-center">--}}
{{--                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>--}}
{{--                                </div>--}}
{{--                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{route('login')}}" class="text-dark font-weight-bolder">Sign in</a></p>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->--}}
{{--    <footer class="footer py-5">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-8 mb-4 mx-auto text-center">--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">--}}
{{--                        Company--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">--}}
{{--                        About Us--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">--}}
{{--                        Team--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">--}}
{{--                        Products--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">--}}
{{--                        Blog--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">--}}
{{--                        Pricing--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">--}}
{{--                        <span class="text-lg fab fa-dribbble"></span>--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">--}}
{{--                        <span class="text-lg fab fa-twitter"></span>--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">--}}
{{--                        <span class="text-lg fab fa-instagram"></span>--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">--}}
{{--                        <span class="text-lg fab fa-pinterest"></span>--}}
{{--                    </a>--}}
{{--                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">--}}
{{--                        <span class="text-lg fab fa-github"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-8 mx-auto text-center mt-1">--}}
{{--                    <p class="mb-0 text-secondary">--}}
{{--                        Copyright © <script>--}}
{{--                            document.write(new Date().getFullYear())--}}
{{--                        </script> Soft by Creative Tim.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->--}}
{{--</main>--}}
{{--<!--   Core JS Files   -->--}}
{{--<script src="../assets/js/core/popper.min.js"></script>--}}
{{--<script src="../assets/js/core/bootstrap.min.js"></script>--}}
{{--<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>--}}
{{--<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>--}}
{{--<script>--}}
{{--    var win = navigator.platform.indexOf('Win') > -1;--}}
{{--    if (win && document.querySelector('#sidenav-scrollbar')) {--}}
{{--        var options = {--}}
{{--            damping: '0.5'--}}
{{--        }--}}
{{--        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);--}}
{{--    }--}}
{{--</script>--}}
{{--<!-- Github buttons -->--}}
{{--<script async defer src="https://buttons.github.io/buttons.js"></script>--}}
{{--<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->--}}
{{--<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>--}}
{{--</body>--}}

{{--</html>--}}



