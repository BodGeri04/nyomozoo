@extends('layouts.app')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <img src="/admin_assets/images/logo_export_new_white.png" alt="kep">
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">{{ __('Új jelszó') }}</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
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
                        <!-- /.col -->
                        <div class="col-7 mb-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Új jelszó beállítása') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="/login" class="text-center">Vissza a belépéshez</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
