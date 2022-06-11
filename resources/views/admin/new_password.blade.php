@extends('admin.main')
@section('content')
    <!doctype html>
    <html>

    <head>
        <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

    <body>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @include('admin.messages')
                    <div class="row">
                        <h1>Jelszó módosítása</h1>
                        <div class="col-md-12">
                            <form method="POST" action="/admin/new_password">
                                @csrf
                                <div class="form-group">
                                    <label>Régi jelszó:</label> <input type="password" name="old_password" class="form-control">
                                    <label>Új jelszó:</label> <input type="password" name="new_password" class="form-control">
                                    <label>Új jelszó mégegyszer:</label> <input type="password" name="new_password2"
                                        class="form-control">
                                </div>
                                <input type="submit" value="Mentés" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </body>

    </html>
@endsection('content')
