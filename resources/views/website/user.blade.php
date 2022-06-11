@extends('website.main')
@section('content')
    @include('website.messages')
    <!--==================================
                    =            User Profile            =
                    ===================================-->
    <section class="user-profile section">
        @if (!isset($user))
            <form method="POST" id="user" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                action="{{ route('user.store') }}">
                @csrf
            @else
                <form method="POST" id="user" class="form-horizontal form-bordered form-bordered"
                    enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="Admin" value="{{ $user->Admin = $user->Admin }}">
                    @csrf
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
                    <div class="sidebar">
                        <!-- User Widget -->
                        <div class="widget user">
                            <!-- User Image -->
                            <div class="image d-flex justify-content-center">
                                <img src="/assets/images/users/{{ $user->image_attach }}" alt="kep" class="rounded-circle">
                            </div>
                            <!-- User Name -->
                            <h5 class="
                                    text-center">{{ $user->name }}
                            </h5>

                        </div>
                    </div>
                </div>

                <div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
                    <!-- Edit Profile Welcome Text -->
                    <div class="widget welcome-message">
                        <h2>Felhasználói adatok módosítása</h2>
                        <p>Ezen a felületen tudod megváltoztatni a bejelentkezési adatait.</p>
                    </div>
                    <!-- Edit Personal Info -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="widget personal-info">
                                <h3 class="widget-header user">Felhasználónév módosítás</h3>
                                <form action="#">
                                    @csrf
                                    <!-- First Name -->
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ isset($user) ? $user->name : '' }}" >
                                            @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                    </div>
                                    <!-- Submit button -->
                                    <button class="btn btn-transparent">Felhasználónév mentése</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- Change Password -->
                            <div class="widget change-password">
                                <h3 class="widget-header user">Jelszó módosítás</h3>
                                <!-- New Password -->
                                <div class="form-group row">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        placeholder="Jelenlegi jelszavad" autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                        placeholder="Új jelszó" autocomplete="current-password">
                                        @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password"
                                       placeholder="Új jelszó megerősítés" autocomplete="current-password">
                                       @error('new_confirm_password')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                   @enderror
                                </div>
                                <p style="font-size: 12px">*Hagyd üresen, ha nem szeretnéd változtani a jelszavad*</p>
                                <!-- Submit Button -->
                                <button class="btn btn-transparent">Jelszó mentése</button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- Change Password -->
                            <div class="widget change-password">
                                <h3 class="widget-header user">Profilkép módosítás</h3>
                                <div class="image-upload-wrap">
                                    <input id="image_attach" class="file-upload-input" type='file' name="image_attach"
                                        onchange="readURL(this);" accept="image/jpeg, image/png"
                                        value="{{ isset($advertisement) ? $advertisement->image_attach : '' }}" />{{ isset($advertisement) ? $advertisement->image_attach : '' }}
                                    <div class="drag-text">
                                        <h3>Kattints a feltöltéshez</h3>
                                    </div>

                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Törlés
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-transparent">Profilkép mentése</button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- Change Email Address -->
                            <div class="widget change-email mb-0">
                                <h3 class="widget-header email">E-mail cím módosítás</h3>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ isset($user) ? $user->email : '' }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <button class="btn btn-transparent">E-mail mentése</button>
                            </div>
                        </div>

                    </div><br>
                    <button class="btn btn-transparent">Mind mentése</button>
                    @if (Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1)
                        <button onclick="location.href='/admin/user'" type="button" class="btn btn-transparent">Admin
                            felület</button>
                    @endif
                </div>

            </div>
        </div>
        </form>
    </section>
@endsection('content')
