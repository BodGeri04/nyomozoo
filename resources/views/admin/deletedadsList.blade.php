@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form method="get" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                    action="{{ url('/admin/deletedAds') }}" role="search">
                    @csrf
                    @include('admin.messages')
                    <h3 class="card-title">Törölt hirdetések </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 350px; position: relative;">
                            <input type="text" name="title" class="form-control float-right" placeholder="Keresés">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="input-group-append">
                                <button onclick="location='/admin/deletedAds'" type="button"
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
                        </tr>
                    </thead>
                    @if (isset($deletedads))
                        <tbody>
                            @foreach ($deletedAdSearch as $deletedAd)
                                <tr id="tr-{{ $deletedAd->id }}">
                                    <td class="text-left"><a
                                        href="{{ route('ads.restore', $deletedAd->id) }}"><button
                                            type="button" class="mb-1 mt-1 mr-1 btn btn-danger" onclick="this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();">Visszaállítás</button>
                                </td>
                                    <td><a href="/admin/user/{{ $deletedAd->user_id }}/edit">
                                            ({{ $deletedAd->user_id }})</td>
                                    <td>{{ $deletedAd->title }}</td>
                                    <td>{{ $deletedAd->name }}</td>
                                    <td>{{ $deletedAd->disappeared }}</td>
                                    <td>{{ $deletedAd->zip_number }}</td>
                                    <td><a href="/assets/images/advertisement/{{ $deletedAd->image_attach }}"
                                            target="_blank"><img class="card-img-top img-fluid"
                                                src="/assets/images/advertisement/{{ $deletedAd->image_attach }}"
                                                alt="Hirdetés" /></a></td>
                                    <td>{{ $deletedAd ? ($deletedAd->animal_type == 'dog' ? 'Kutya' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->animal_type == 'cat' ? 'Macska' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}
                                    </td>
                                    <td>{{ $deletedAd->comment }}</td>
                                    <td>{{ $deletedAd->characteristics }}</td>
                                    <td>{{ $deletedAd->pre_phone_number }}</td>
                                    <td>{{ $deletedAd->phone_number }}</td>
                                    <td>{{ $deletedAd ? ($deletedAd->chip == '1' ? 'Igen' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->chip == '0' ? 'Nem' : '') : '' }}
                                    </td>
                                    <td>{{ $deletedAd ? ($deletedAd->sex == 'Male' ? 'Hím' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->sex == 'Female' ? 'Nőstény' : '') : '' }}
                                    </td>
                                    <td>{{ $deletedAd ? ($deletedAd->approve == '1' ? 'Igen' : '') : '' }}
                                        {{ isset($deletedAd) ? ($deletedAd->approve == '0' ? 'Nem' : '') : '' }}
                                    </td>
                                    <td class="text-right"><a
                                        href="{{ route('ads.restore', $deletedAd->id) }}"><button
                                            type="button" class="mb-1 mt-1 mr-1 btn btn-danger" onclick="this.disabled=true;this.value='Feldolgozás, kérjük várj...';this.form.submit();">Visszaállítás</button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                    @empty($deletedAd)
                        <tbody>
                            <td class="text-center">Jelenleg nincs egy törölt hirdetés sem.

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
