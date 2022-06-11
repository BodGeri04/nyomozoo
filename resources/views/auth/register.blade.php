@extends('layouts.app')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <img src="/admin_assets/images/logo_export_new_white.png" alt="kep">
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">{{ __('Új felhasználó regisztrálása') }}</p>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Név"
                            class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                            required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" placeholder="Jelszó" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required placeholder="Jelszó újra" autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="registering" class="px-12 ">Regisztrációddal elfogadod az oldal <a
                                    class="text-primary font-weight-bold" target="_blank"
                                    href="/website/hasznalatiFeltetelek">használati feltételeit</a>, valamint az <a
                                    class="text-primary font-weight-bold" target="_blank"
                                    href="/website/adatkezeles">adatkezelési szabályzatot.</a></label>
                        </div>

                        <!-- /.col -->
                        <div class="col-12">
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Regisztráció') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="social-auth-links text-center mb-3">
                        <p>- VAGY -</p>
                        <a href="{{ route('google.login') }}" class="btn btn-block btn-primary">
                            <i class="fab fa-google mr-2"></i> Regisztrálás Google-al
                        </a>
                      </div>
                </form><br>
                <a href="/login" class="text-center">Van már fiókom</a>
                <br>
                <p class="mb-1 float-right">
                    <a href="/">Vissza a főoldalra</a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
