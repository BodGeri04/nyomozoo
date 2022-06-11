@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="/admin_assets/images/logo_export_new_white.png" alt="kep">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">A folytatáshoz jelentkezz be!</p>
                @if (session('error'))
                    <span class="text-danger"> {{ session('error') }} </span>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required placeholder="Email" autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Jelszó">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>

                            </div>

                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary mb-3">
                                <input type="checkbox" id="show" onclick="myFunction()">
                                <label for="show">
                                    {{ __('Jelszó mutatása') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Emlékezzen rám') }}
                                </label>

                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Bejelentkezés') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                        <div class="social-auth-links text-center mb-3">
                        <p>- VAGY -</p>
                        <a href="{{ route('google.login') }}" class="btn btn-block btn-primary">
                            <i class="fab fa-google mr-2"></i> Bejelentkezés Google-al
                        </a>
                    </div>
                <!-- /.social-auth-links -->
                <br>
                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Elfelejtetted jelszavad?') }}
                        </a>
                    @endif
                </p>
                <p class="mb-1">
                    Nincsen még fiókod? <a href="/register">Készíts!</a>
                </p>
                <br>
                <p class="mb-1 float-right">
                    <a href="/">Vissza a főoldalra</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    
    <!-- /.login-box -->
@endsection