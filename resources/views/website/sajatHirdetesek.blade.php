@extends('website.main')
@section('content')
    @include('website.messages')
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                    <div class="sidebar">
                        <!-- User Widget -->
                        <div class="widget user-dashboard-profile">
                            <?php
                            $created_date_user=explode(' ',Auth::user()->created_at)
                            ?>
                            <!-- User Image -->
                            <div class="profile-thumb">
                                <img src="/assets/images/users/{{ Auth::user()->image_attach }}" alt="kep"
                                    class="rounded-circle">
                            </div>
                            <!-- User Name -->
                            <h5 class="text-center">{{ Auth::user()->name }}</h5>
                            <p>Létrehozva<br>{{ $created_date_user[0] }}</p>
                            <a href="/website/felhasznModosit" class="btn btn-main-sm">Profil módosítás</a>
                        </div>
                        <!-- Dashboard Links -->
                        <div class="widget user-dashboard-menu">
                            <ul>
                                <li class="active">
                                    <a><i class="fa fa-user"></i>Saját hirdetéseim</a>
                                </li>
                                <li>
                                    <a href="{{route ("logout")}}"><i class="fa fa-power-off"></i>Kijelentkezés</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                    <div class="widget dashboard-container my-adslist">
                        <h3 class="widget-header">Hirdetéseim</h3>
                        <table class="table table-responsive product-dashboard-table">
                            <thead>
                                <tr>
                                    <th class="text-center">Kép</th>
                                    <th class="text-center">Hirdetés adatai</th>
                                    <th class="text-center">Állat</th>
                                    <th class="text-center">Tevékenység</th>
                                </tr>
                            </thead>
                            @foreach ($ownads as $ownad)
                            <?php
                            $created_date_ad=explode(' ',$ownad->created_at)
                            ?>
                                <tbody>
                                    <tr>
                                        <td class="product-thumb">
                                            <img width="80px" height="auto"
                                                src="/assets/images/advertisement/{{ $ownad->image_attach }}" alt="Kép">
                                        </td>
                                        <td class="product-details col-lg-8">
                                            <h3 class="title">{{ $ownad->title }}</h3>
                                            <strong><span class="add-id">Azonosító:
                                                    {{ $ownad->id }}</span></strong>
                                            <strong><span>Feltöltve: {{ $created_date_ad[0] }}</span></strong>
                                             <strong><span class="location">Ir.
                                            szám: {{ $ownad->zip_number }}</span></strong>
                                            @if($ownad->status=='active')
                                            <strong><span class="status active">{{ isset($ownad) ? ($ownad->status == 'active' ? 'Aktív' : '') : '' }}</span></strong>
                                            @else
                                                <strong><span class="status inactive">{{ isset($ownad) ? ($ownad->status == 'inactive' ? 'Inaktív' : '') : '' }}</span></strong>
                                            @endif
                                        </td>
                                        <td class="product-category col-lg-8"><span
                                                class="categories">{{ isset($ownad) ? ($ownad->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}</span>
                                        </td>
                                        <td class="action" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                @if($ownad->approve==1)
                                                    @if($ownad->status=="active")
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="Megtekintés"
                                                            class="view"
                                                            href="/website/hirdetesReszletei/{{ $ownad->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="Módosítás"
                                                            class="edit"
                                                            href="{{ route('advertisement.edit', $ownad->id) }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </li>
                                                    @if ($ownad->search_find == 'search' && $ownad->status=="active")
                                                        <li class="list-inline-item">
                                                            <a data-toggle="tooltip" data-placement="top" title="Letöltés"
                                                                class="download"
                                                               target="blank_" href="/hirdetesPDF/{{ $ownad->id }}">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if($ownad->status!="inactive")
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="Inaktiválás"
                                                            class="delete"
                                                            onclick="window.deleteConfirm('Biztosan inaktiválni szeretnéd a(z) {{$ownad->title}} hirdetést?', '{!! route('advertisement.destroy', $ownad->id) !!}', 'tr-{{ $ownad->id }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                  @else
                                                  <li class="list-inline-item">
                                                    <label style="font-weight: bold">A hirdetésed felülvizsgálat alatt van
                                                    </label>
                                                </li>
                                                @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        @empty($ownad)
                            <div class="col-lg-7 align-self-center">
                                <h5>Nincs aktív hirdetésed.</h5> <a href="/website/advertisement/create">Tölts fel egyet.</a>
                            </div>
                        @endempty
                    </div>
                    <div class="pagination justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $ownads->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
@endsection('content')
