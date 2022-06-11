@extends('admin.main')
@section('content')

<div class="content-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form method="get" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                    action="{{ url('/website/advertisement') }}" role="search">
                    @csrf
                    <h3 class="card-title">Hirdetések </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 350px; position: relative;">
                            <input type="text" name="title" class="form-control float-right" placeholder="Keresés">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="input-group-append">
                                <button onclick="location='/website/advertisement'" type="button"
                                    class="btn btn-default">Visszaállítás</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- /.card-header -->
            <input name="btn_send" type="button" class="btn btn-primary" value="Új hirdetés hozzáadása"
                onclick="location.href='/website/advertisement/create'">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-dark">
                    <thead>
                        <tr>
                            <th class="text-left"></th>
                            <th class="text-left"></th>
                            <th>Felhasználó</th>
                            <th>Cím</th>
                            <th>Állat neve</th>
                            <th>Eltűnés dátuma</th>
                            <th>Irányítószám</th>
                            <th>Képek</th>
                            <th>Állat típusa</th>
                            <th>Komment</th>
                            <th>Karaktere</th>
                            <th>Telefonszám azo.</th>
                            <th>Telefonszám</th>
                            <th>Csip</th>
                            <th>Neme</th>
                            <th>Publikus</th>
                            <th class="text-left"></th>
                            <th class="text-left"></th>
                        </tr>
                    </thead>
                    @if (isset($advertisement))
                        <tbody>
                            @foreach ($advertisementsearch as $advertisements)
                                <tr id="tr-{{ $advertisements->id }}">
                                    <td class="text-left"><a
                                        href="{{ route('advertisement.edit', $advertisements->id) }}"><button
                                            type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Szerkesztés</button>
                                </td>
                                <td class="text-left"><button
                                        onclick="window.deleteConfirm('Biztos törölni szeretnéd {{ $advertisements->title }} hirdetést?', '{!! route('advertisement.destroy', $advertisements->id) !!}', 'tr-{{ $advertisements->id }}')"
                                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Törlés</button></td>
                                    <td><a href="/admin/user/{{ $advertisements->user_id }}/edit">{{ $advertisements->user->name }}
                                            ({{ $advertisements->user_id }})</td>
                                    <td>{{ $advertisements->title }}</td>
                                    <td>{{ $advertisements->name }}</td>
                                    <td>{{ $advertisements->disappeared }}</td>
                                    <td>{{ $advertisements->zip_number }}</td>
                                    <td><a href="/assets/images/advertisement/{{ $advertisements->image_attach }}"
                                            target="_blank"><img class="card-img-top img-fluid"
                                                src="/assets/images/advertisement/{{ $advertisements->image_attach }}"
                                                alt="Hirdetés" /></a></td>
                                    <td>{{ $advertisements ? ($advertisements->animal_type == 'dog' ? 'Kutya' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->animal_type == 'cat' ? 'Macska' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}
                                    </td>
                                    <td>{{ $advertisements->comment }}</td>
                                    <td>{{ $advertisements->characteristics }}</td>
                                    <td>{{ $advertisements->pre_phone_number }}</td>
                                    <td>{{ $advertisements->phone_number }}</td>
                                    <td>{{ $advertisements ? ($advertisements->chip == '1' ? 'Igen' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->chip == '0' ? 'Nem' : '') : '' }}
                                    </td>
                                    <td>{{ $advertisements ? ($advertisements->sex == 'Male' ? 'Hím' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->sex == 'Female' ? 'Nőstény' : '') : '' }}
                                    </td>
                                    <td>{{ $advertisements ? ($advertisements->approve == '1' ? 'Igen' : '') : '' }}
                                        {{ isset($advertisements) ? ($advertisements->approve == '0' ? 'Nem' : '') : '' }}
                                    </td>
                                    <td class="text-right"><a
                                        href="{{ route('advertisement.edit', $advertisements->id) }}"><button
                                            type="button" class="mb-1 mt-1 mr-1 btn btn-primary">Szerkesztés</button>
                                </td>
                                <td class="text-right"><button
                                        onclick="window.deleteConfirm('Biztos törölni szeretnéd {{ $advertisements->title }} hirdetést?', '{!! route('advertisement.destroy', $advertisements->id) !!}', 'tr-{{ $advertisements->id }}')"
                                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Törlés</button></td>
                                </tr>

                            @endforeach
                        </tbody>
                    @endif
                    @empty($advertisements)
                        <tbody>
                            <td class="text-center">Jelenleg nincs egy hirdetés sem beregisztrálva.

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
