@extends('website.main')
@section('content')
@include('website.messages')
    <section class="page-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advance Search -->
                    <form method="get" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                        action="{{ url('/website/hirdetesek') }}" role="search">
                        @csrf
                        <div class="advance-search">
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <input type="text" name="title" class="form-control my-2 my-lg-0" id="inputtext4"
                                        placeholder="Írd ide a hirdetés nevét. Pl.: elveszett kutya" value="{{$title}}">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary">Keresés</button>
                                </div>
                                @if (isset($_GET['title']))
                                <div class="col-md-1">
                                    <button onclick="location='/website/hirdetesek'" type="button"
                                        class="btn btn-primary">Visszaállítás</button>
                                </div>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-result bg-gray">
                    @if (isset($_GET['title']))
                        <h2>Találatok a(z) "{{$title}}" keresésedre</h2>
                        @else
                        <h2>Keresett állatok hirdetései</h2>
                        @if ($allads < 1)
                            <p>Jelenleg nincs aktív hirdetés.</p>
                        @else
                            <p>{{ $allads }} db aktív hirdetés</p>
                        @endif
                    @endif
                    </div>
                    <div class="col-md-1">
                        <button type="submit" onclick="location.href='/website/talaltHirdetesek'"
                            class="btn btn-primary">Talált állatok</button>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="category-sidebar">
                        <div class="widget category-list">
                            <h4 class="widget-header">Gyakran keresett állatok</h4>
                            <ul class="category-list">
                                @if ($allads < 1)
                                    <p>Jelenleg nincs keresett állat.</p>
                                @endif
                                <li>
                                    @foreach ($animals as $animal)
                                        <form method="GET" class="form-horizontal form-bordered form-bordered"
                                            enctype="multipart/form-data" action="{{ url('/website/hirdetesek') }}"
                                            role="search">
                                            @csrf
                                            <label><input type="submit" name="animal_type" class="animallistbtn"
                                                    value="{{ isset($animal) ? ($animal == 'dog' ? 'Kutya' : '') : '' }}{{ isset($animal) ? ($animal == 'cat' ? 'Macska' : '') : '' }}{{ isset($animal) ? ($animal == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($animal) ? ($animal == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($animal) ? ($animal == 'parrot' ? 'Papagáj' : '') : '' }}"></label>
                                        </form>
                                    @endforeach
                                    @if (isset($_GET['animal_type']))
                                        <br>
                                        <button onclick="location='/website/hirdetesek'" type="button"
                                            class="btn animalfilterbtn">Visszaállítás</button>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="widget category-list">
                            <h4 class="widget-header">Közeledben</h4>
                            <ul class="category-list">
                                @if ($allads < 1)
                                    <p>Jelenleg nincs a közeledben hirdetés.</p>
                                @endif
                                <li>
                                    @foreach ($zips as $zip)
                                        <form method="GET" class="form-horizontal form-bordered form-bordered"
                                            enctype="multipart/form-data" action="{{ url('/website/hirdetesek') }}"
                                            role="search">
                                            @csrf
                                            <label><input type="submit" name="zip_number" class="animallistbtn"
                                                    value="{{ $zip }}"></label>
                                        </form>
                                    @endforeach
                                    @if (isset($_GET['zip_number']))
                                        <br>
                                        <button onclick="location='/website/hirdetesek'" type="button"
                                            class="btn animalfilterbtn">Visszaállítás</button>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    @if (isset($ads))
                        @foreach ($advertisements as $advertisement)
                            <!-- ad listing list  -->
                            <div class="ad-listing-list mt-20">
                                <div class="row p-lg-3 p-sm-5 p-4">
                                    <div class="col-lg-4 align-self-center">
                                        <a href="/website/hirdetesReszletei/{{ $advertisement->id }}">
                                            <img class="card-img-hirdetesek img-fluid"
                                                src="/assets/images/advertisement/{{ $advertisement->image_attach }}"
                                                alt="Hirdetés">
                                        </a>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-10">
                                                <div class="ad-listing-content">
                                                    <div>
                                                        <a href="/website/hirdetesReszletei/{{ $advertisement->id }}"
                                                            data-filter=".filter-{{ $advertisement->id }}">{{ $advertisement->title }}</a>
                                                    </div>
                                                    <ul class="list-inline mt-2 mb-3">
                                                        <li class="list-inline-item">
                                                            <i class="fa fa-calendar"></i>
                                                            {{ $advertisement->disappeared }}
                                                        </li>
                                                        <li class="list-inline-item"><i
                                                                class="fa"></i>{{ isset($advertisement) ? ($advertisement->sex == 'Male' ? 'Hím' : '') : '' }}{{ isset($advertisement) ? ($advertisement->sex == 'Female' ? 'Nőstény' : '') : '' }}
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a><i
                                                                    class="fa"></i>{{ isset($advertisement) ? ($advertisement->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($advertisement) ? ($advertisement->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($advertisement) ? ($advertisement->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($advertisement) ? ($advertisement->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($advertisement) ? ($advertisement->animal_type == 'parrot' ? 'papagáj' : '') : '' }}</a>
                                                        </li>
                                                        <li class="list-inline-item">Állat neve: <i
                                                                class="fa"></i>{{ $advertisement->name }}
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa fa-phone"></i>
                                                            {{ $advertisement->pre_phone_number }}
                                                            {{ $advertisement->phone_number }}
                                                        </li>
                                                    </ul>
                                                    <ul class="list-inline product-meta">
                                                        <li class="list-inline-item">Jellemzői:
                                                            {{ $advertisement->characteristics }}
                                                        </li>
                                                    </ul>
                                                    <ul class="list-inline product-meta">
                                                        <li class="list-inline-item">Egyéb:
                                                            {{ $advertisement->comment }}
                                                        </li>
                                                    </ul>
                                                    <p class="pr-5">Feladó: {{ $advertisement->user->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @empty($advertisement)
                            <div class="col-lg-4 align-self-center">
                                <h5>Nincs találat!</h5>
                            </div>
                        @endempty
                    @endif
                    <br>
                    <div class="pagination justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $advertisements->links() }}
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection('content')
