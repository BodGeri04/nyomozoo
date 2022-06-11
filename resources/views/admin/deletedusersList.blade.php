@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form method="get" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                    action="{{ url('/admin/deletedUsers') }}" role="search">
                    @csrf
                    @include('admin.messages')
                    <h3 class="card-title">Törölt felhasználók </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 350px; position: relative;">
                            <input type="text" name="title" class="form-control float-right" placeholder="Keresés">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="input-group-append">
                                <button onclick="location='/admin/deletedUsers'" type="button"
                                    class="btn btn-default">Visszaállítás</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-dark">
                    <thead>
                        <tr>
                            <th class="text-left"></th>
                            <th>ID</th>
                            <th>Név</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Kép</th>
                            <th>Google_id</th>
                            <th>Törölve</th>
                            <th class="text-left"></th>
                        </tr>
                    </thead>
                    @if (isset($deletedusers))
                        <tbody>
                            @foreach ($deletedUserSearch as $deletedUser)
                                <tr id="tr-{{ $deletedUser->id }}">
                                    <td class="text-left"><a
                                        href="{{ route('user.restore', $deletedUser->id) }}"><button
                                            type="button" class="mb-1 mt-1 mr-1 btn btn-danger" onclick="window.deleteConfirm('Biztos aktiválod a(z) {{ $deletedUser->name }} felhasználót?', '{!! route('user.restore', $deletedUser->id) !!}', 'tr-{{ $deletedUser->id }}'); this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();">Visszaállítás</button>
                                </td>
                                    <td>{{ $deletedUser->id }}</td>
                                    <td>{{ $deletedUser->name }}</td>
                                    <td>{{ $deletedUser->email }}</td>
                                    <td>{{ $deletedUser ? ($deletedUser->Admin == 1 ? 'Igen' : '') : '' }}{{ $deletedUser ? ($deletedUser->Admin == 0 ? 'Nem' : '') : '' }}
                                    <td><a href="/assets/images/users/{{ $deletedUser->image_attach }}" target="_blank"><img
                                            class="card-img-top img-fluid"
                                            src="/assets/images/users/{{ $deletedUser->image_attach }}" alt="Profilkép" style="max-height: 50px; max-weight: 140px" /></a></td>
                                    <td>{{ $deletedUser ? ($deletedUser->google_id == null ? 'Nincs' : '') : '' }}{{ $deletedUser ? ($deletedUser->google_id == true ? '' . $deletedUser->google_id : '') : '' }}</td>
                                    <td>{{ $deletedUser->deleted_at }}</td>
                                    <td class="text-left"><a
                                        href="{{ route('user.restore', $deletedUser->id) }}"><button
                                            type="button" class="mb-1 mt-1 mr-1 btn btn-danger" onclick="window.deleteConfirm('Biztos aktiválod a(z) {{ $deletedUser->name }} felhasználót?', '{!! route('user.restore', $deletedUser->id) !!}', 'tr-{{ $deletedUser->id }}'); this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();">Visszaállítás</button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                    @empty($deletedusers)
                        <tbody>
                            <td class="text-center">Jelenleg nincs egy törölt felhasználó sem.

                            </td>
                        </tbody>
                    @endempty
                </table>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection('content')
