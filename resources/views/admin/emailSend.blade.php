@extends('admin.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('admin.messages')
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Email írása</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="/admin/emailSend" class="row" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label style="color: rgb(43, 196, 119)">Email küldése adminoknak</label><br>
                                        <label style="color: yellow">Email küldése adminok kivételével
                                            mindenkinek</label><br>
                                        <label style="color: red">Admin(ok)</label>
                                        <select required name="userprivatemail" data-plugin-selectOne
                                            class="form-control populate">
                                            <option value="admins" style="color: rgb(43, 196, 119)">Adminoknak</option>
                                            <hr>
                                            <option value="users" style="color: yellow">Felhasználóknak</option>
                                            <hr>
                                            @foreach ($adminusers as $adminuser)
                                                <option selected style="color: red" value="{{ $adminuser->email }}">
                                                    {{ $adminuser->name }} ({{ $adminuser->email }})
                                                </option>
                                                <hr>
                                            @endforeach
                                            @foreach ($users as $user)
                                                <option value="{{ $user->email }}">{{ $user->name }}
                                                    ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id='result'></div>
                                    </div>
                                    <div class="form-group">
                                        <input required class="form-control" name="subject" id="subject"
                                            placeholder="Tárgy:">
                                    </div>
                                    <div class="form-group">
                                        <textarea id="message" name="message" class="form-control" style="height: 300px">
                                    <br>    
                                    <hr>
                                    <footer style="font-size: 14px; color:#1d4b47; font-weight:bold">Üdvözlettel,
                                        @if (Auth::user()->email == 'bodge04@gmail.com' &&
                                        Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1)
                                        <br>{{Auth::user()->name}}<br>Vezérigazgató<br>
                                        @else
                                        <br>{{Auth::user()->name}}<br>Adminisztrátor<br>
                                        @endif
                                        <img src="https://nyomozoo.hu/admin_assets/images/logo_export_jav_white.jpg" width="16%" height="15%" alt="Nyomozoo.hu logó"></footer>
                                    <hr>
                                    </textarea>
                                    </div>
                                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i>
                                        Elvetés</button>

                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i>
                                            Küldés</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.card-body -->
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection('content')
