@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Felhasználók</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="name" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            
            @include('admin.messages')
            <!-- /.card-header -->
            <input name="btn_send" type="url" class="btn btn-primary" value="Új létrehozás"
                onclick="location.href='/admin/user/create'" />
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-dark">
                    <thead>
                        <tr>
                            <th class="text-left"></th>
                            <th class="text-left"></th>
                            <th class="text-left"></th>
                            <th>Felhasználónév</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Képek</th>
                            <th>Google_id</th>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                            <tr id="tr-{{ $user->id }}">
                                @if($user->email == (Auth::user()->email=="bodge04@gmail.com"))
                                <td class="text-left"><a href="{{ route('user.edit', $user->id) }}"><button
                                    type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Szerkesztés</button>
                                </td>
                                @elseif($user->email!="bodge04@gmail.com")
                                <td class="text-left"><a href="{{ route('user.edit', $user->id) }}"><button
                                    type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Szerkesztés</button>
                                </td>
                                @else
                                <td class="text-left">Szuperadminisztrátor
                                </td>
                                @endif
                        @if ($user->Admin == 0)
                        @if ($user->status == 1)
                            <td class="text-center"><a
                                    href="{{ route('user.status.update', ['user_id' => $user->id, 'status_code' => 0]) }}"><button
                                        type="button" class="mb-1 mt-1 mr-1 btn btn-success">Kitiltás</button>
                            </td>
                        @else
                            <td class="text-center"><a
                                    href="{{ route('user.status.update', ['user_id' => $user->id, 'status_code' => 1]) }}"><button
                                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Kitiltva</button>
                            </td>
                        @endif
                    @else
                        <td class="text-left">
                            <label>Adminisztrátori jog</label>
                        </td>
                    @endif
                    @if($user->email == (Auth::user()->email=="bodge04@gmail.com"))
                    <td class="text-left"><button
                        onclick="window.deleteConfirm('Biztos törölni szeretnéd a(z) {{ $user->name }} felhasználót?', '{!! route('user.destroy', $user->id) !!}', 'tr-{{ $user->id }}'); this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();"
                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger" >Törlés</button></td>
                    @elseif($user->email!="bodge04@gmail.com")
                    <td class="text-left"><button
                        onclick="window.deleteConfirm('Biztos törölni szeretnéd a(z) {{ $user->name }} felhasználót?', '{!! route('user.destroy', $user->id) !!}', 'tr-{{ $user->id }}'); this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();"
                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger" >Törlés</button></td>
                        @else
                                <td class="text-left">Szuperadminisztrátor
                                </td>
                    @endif
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user ? ($user->Admin == 1 ? 'Igen' : '') : '' }}{{ $user ? ($user->Admin == 0 ? 'Nem' : '') : '' }}
                                </td>
                                <td><a href="/assets/images/users/{{ $user->image_attach }}" target="_blank"><img
                                            class="card-img-top img-fluid"
                                            src="/assets/images/users/{{ $user->image_attach }}" alt="Profilkép" style="max-height: 50px; max-weight: 140px"/></a></td>
                                <td>{{ $user ? ($user->google_id == null ? 'Nincs' : '') : '' }}{{ $user ? ($user->google_id == true ? '' . $user->google_id : '') : '' }}</td>
                                @if($user->email == (Auth::user()->email=="bodge04@gmail.com"))
                                <td class="text-left"><a href="{{ route('user.edit', $user->id) }}"><button
                                    type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Szerkesztés</button>
                                </td>
                                @elseif($user->email!="bodge04@gmail.com")
                                <td class="text-left"><a href="{{ route('user.edit', $user->id) }}"><button
                                    type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Szerkesztés</button>
                                </td>
                                @else
                                <td class="text-left">Szuperadminisztrátor
                                </td>
                                @endif
                                @if ($user->Admin == 0)
                                    @if ($user->status == 1)
                                        <td class="text-center"><a
                                                href="{{ route('user.status.update', ['user_id' => $user->id, 'status_code' => 0]) }}"><button
                                                    type="button" class="mb-1 mt-1 mr-1 btn btn-success">Kitiltás</button>
                                        </td>
                                    @else
                                        <td class="text-center"><a
                                                href="{{ route('user.status.update', ['user_id' => $user->id, 'status_code' => 1]) }}"><button
                                                    type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Kitiltva</button>
                                        </td>
                                    @endif
                                @else
                                    <td class="text-right">
                                        <label>Adminisztrátori jog</label>
                                    </td>
                                @endif
                                @if($user->email == (Auth::user()->email=="bodge04@gmail.com"))
                    <td class="text-right"><button
                        onclick="window.deleteConfirm('Biztos törölni szeretnéd a(z) {{ $user->name }} felhasználót?', '{!! route('user.destroy', $user->id) !!}', 'tr-{{ $user->id }}'); this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();"
                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger" >Törlés</button></td>
                    @elseif($user->email!="bodge04@gmail.com")
                    <td class="text-right"><button
                        onclick="window.deleteConfirm('Biztos törölni szeretnéd a(z) {{ $user->name }} felhasználót?', '{!! route('user.destroy', $user->id) !!}', 'tr-{{ $user->id }}'); this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();"
                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger" >Törlés</button></td>
                        @else
                                <td class="text-left">Szuperadminisztrátor
                                </td>
                    @endif
                            </tr>
                        @endforeach
                    </tbody>
                    @empty($user)
                        <tbody>
                            <td class="text-center">Jelenleg nincs egy felhasználó sem beregisztrálva.
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
