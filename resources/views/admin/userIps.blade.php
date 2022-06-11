@extends('admin.main')
@section('content')

<div class="content-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form method="get" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                    action="{{ url('/admin/getIps') }}" role="search">
                    @csrf
                    <h3 class="card-title">Aktív felhasználók</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm float-center" style="width: 350px; ">
                            <input type="text" name="title" class="form-control float-right" placeholder="Keresés">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="input-group-append">
                                <button onclick="location='/admin/getIps'" type="button"
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
                            <th>Név (ID)</th>
                            <th>IP cím</th>
                            <th>Email</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    @if (isset($signedUsers))
                        <tbody>
                            @if(Auth::user()->id == $signedUsers->id)
                                <tr id="tr-{{ $signedUsers->id }}">
                                    <td style="color: rgb(187, 190, 9)"><a href="/admin/user/{{ $signedsignedUsersUser->id }}/edit">{{ $signedUsers->name }}
                                            ({{ $signedUsers->id }})</td>
                                    <td style="color: rgb(187, 190, 9)">{{ $signedUsersIp }}</td>
                                    <td style="color: rgb(187, 190, 9)">{{ $signedUsers->email }}</td>
                                    <td style="color: rgb(187, 190, 9)">{{ $signedUsers ? ($signedUsers->Admin == 1 ? 'Igen' : '') : '' }}{{ $signedUsers ? ($signedUsers->Admin == 0 ? 'Nem' : '') : '' }}</td>
                                </tr>
                                @else
                                <tr id="tr-{{ $signedUser->id }}">
                                    <td ><a href="/admin/user/{{ $signedUser->id }}/edit">{{ $signedUser->name }}
                                            ({{ $signedUser->id }})</td>
                                    <td>{{ $signedUsersIps }}</td>
                                    <td>{{ $signedUser->email }}</td>
                                    <td>{{ $signedUser ? ($signedUser->Admin == 1 ? 'Igen' : '') : '' }}{{ $signedUser ? ($signedUser->Admin == 0 ? 'Nem' : '') : '' }}</td>
                                </tr>
                            @endif
                        </tbody>
                    @endif
                    @empty($signedUsers)
                        <tbody>
                            <td class="text-center">Jelenleg nincs egy bejelentkezett sem beregisztrálva.

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
