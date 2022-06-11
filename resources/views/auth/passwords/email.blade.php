@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="/admin_assets/images/logo_export_new_white.png" alt="kep">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="login-box-msg">Elfelejtetted jelszavad? Könnyedén kérhetsz egy újat.</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required placeholder="Email" autocomplete="email" autofocus>
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
                    <div class="row">
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ __('Helyreállító link küldése') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="/login">Bejelentkezés</a>
                </p>
                <p class="mb-0">
                    <a href="/register" class="text-center">Új felhasználó létrehozás</a>
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
