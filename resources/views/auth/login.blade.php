<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Test Laravel</title>
    <!-- plugins -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"
        disabled />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="bg-gradient-light">
    @if (session()->has('errorDepart'))
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-danger text-center p-2 w-100">
                    {{ session('errorDepart') }}
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('accountNoActive'))
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-danger text-center p-2 w-100">
                    {{ session('accountNoActive') }}
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('loginError'))
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-danger text-center p-2 w-100">
                    {{ session('loginError') }}
                </div>
            </div>
        </div>
    @endif
    <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card o-hidden border-0 shadow-lg w-75">
        <div class="row no-gutters">
            <!-- Login Form -->
            <div class="col-md-6 d-flex align-items-center">
                <div class="card-body p-4">
                    <p class="display-6 fw-bold text-center text-dark">Masuk atau Buat Akun</p>
                    <p class="display-6 fw-bold text-center text-dark">Untuk Memulai</p>
                    <form class="user" method="POST" action="{{ route('loginauth') }}">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icon-dual" data-feather="user"></i>
                                </span>
                                <input type="username" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter your username">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icon-dual" data-feather="lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button class="btn btn-primary px-4" type="submit">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Container for Image -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/Frame_98699.png') }}" alt="Login Image" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
