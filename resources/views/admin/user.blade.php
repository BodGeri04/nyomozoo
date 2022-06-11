@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Felhasználó adatai</h4>
                </div>
                @if (!isset($user))
                    <form method="POST" id="user" class="form-horizontal form-bordered form-bordered"
                        action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                    @else
                        <form method="POST" id="user" class="form-horizontal form-bordered form-bordered"
                            action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Név</label>
                                <input required type="text" class="form-control" id="basicInput" name="name"
                                    value="{{ isset($user) ? $user->name : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Admin</label>
                                <select required name="Admin" data-plugin-selectOne class="form-control populate">
                                    <option value='1' {{ isset($user) ? ($user->Admin == '1' ? 'selected' : '') : '' }}>
                                        Igen
                                    </option>
                                    <option value='0' {{ isset($user) ? ($user->Admin == '0' ? 'selected' : '') : '' }}>
                                        Nem
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">E-mail cím</label>
                                <input required type="email" class="form-control" id="basicInput" name="email"
                                    value="{{ isset($user) ? $user->email : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Jelszó</label>
                                <input type="text" class="form-control" id="test" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="exampleInputFile">Kép</label>
                        <div class="input-group">
                            <div class="custom-file col-sm-6">
                                <input name="image_attach" type="file" class="custom-file-input " id="exampleInputFile"
                                    value="{{ isset($user) ? $user->image_attach : '' }}">>
                                <label class="custom-file-label" for="exampleInputFile">Fájl kiválasztása</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" onclick="" class="btn btn-primary me-1 mb-1">Mentés</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Törlés</button>
                        <button onclick="location='/admin/user'" type="reset"
                            class="btn btn-light-secondary me-1 mb-1">Vissza</button>
                    </div>
                </div>
                        </form>
                    </form>
        </section>
    </div>
</div>

@endsection('content')
