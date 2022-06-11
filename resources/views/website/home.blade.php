@extends('website.main')
@section('content')
    @include('website.messages')
    <section class="hero-area bg-1 text-center overly">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Header Contetnt -->
                    <div class="content-block">
                        <h1>Elveszett kedvenc háziállatod, vagy esetleg találtál egyet?</h1>
                        <h2>
                            <p>Itt kaphatsz a leghamarabb segítséget.<br>
                        </h2>
                        <div class="short-popular-category-list text-center">
                            <h2>Ne késlekedj, adj fel hirdetést!</h2>
                            <button type="button" onclick="location.href='/website/advertisement/create'"
                                class="btn btn-main">Hirdetés feladása</button>
                        </div>
                    </div>
                    <!-- Advance Search -->
                    <div class="advance-search">
                        <form method="get" class="form-horizontal form-bordered form-bordered" enctype="multipart/form-data"
                            action="{{ url('/website/home') }}" role="search">
                            @csrf
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 col-md-12 align-content-center">
                                        <form>
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <input name="title" type="text" class="form-control my-2 my-lg-1"
                                                        id="inputtext4"
                                                        placeholder="Írd be a keresni kívánt hirdetés nevét" value="{{$title}}">
                                                </div>
                                                <div class="list-inline-item">
                                                    <button type="submit" class="btn btn-primary">Keresés</button>
                                                </div>
                                                
                                                <br>                                            
                                            @if (isset($_GET['title']))
                                                <div class="list-inline-item">
                                                    <button onclick="location='/'" type="button"
                                                        class="btn animalfilterbtn">Visszaállítás</button>
                                                </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container End -->
        </form>
    </section>

    <!--===================================
                                                =            Client Slider            =
                                                ====================================-->
    <!--===========================================
                                                =            Popular deals section            =
                                                ============================================-->
    @if (isset($homeadverts))
        <section id="shop" class="popular-deals section bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>Hirdetések</h2>
                            @if (isset($_GET['title']))
                            <p>Találtok a(z) "{{$title}}" keresésedre</p>
                            @else
                            <p>A Te hirdetésed is felkerülhet ide</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- offer 01 -->
                    <div class="col-lg-12">
                        <div class="trending-ads-slide">
                            @foreach ($homeadverts as $homeadvert)
                                <div class="col-sm-12 col-lg-12">
                                    <!-- product card -->

                                    <div class="product-item bg-light">
                                        <!--Users ad start-->
                                        @if (Auth::check() && Auth::user()->id == $homeadvert->user_id)
                                            <div class="sajat-hirdetes">

                                                <div class="card">
                                                    <div class="thumb-content">
                                                        <a href="/website/hirdetesReszletei/{{ $homeadvert->id }}">
                                                            <img class="card-img-top img-fluid"
                                                                src="/assets/images/advertisement/{{ $homeadvert->image_attach }}"
                                                                alt="Hirdetés">
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="card-title"><a
                                                                href="/website/hirdetesReszletei/{{ $homeadvert->id }}"
                                                                data-filter=".filter-{{ $homeadvert->id }}">{{ $homeadvert->title }}</a>
                                                        </h4>

                                                        <ul class="list-inline product-meta">
                                                            <li class="list-inline-item">
                                                                <i class="fa fa-calendar"></i>
                                                                {{ $homeadvert->disappeared }}
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a><i
                                                                        class="fa fa-folder-open"></i>{{ isset($homeadvert) ? ($homeadvert->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}</a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <p>{{ isset($homeadvert) ? ($homeadvert->sex == 'Male' ? 'Hím' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->sex == 'Female' ? 'Nőstény' : '') : '' }}
                                                                </p>
                                                            </li>
                                                            @if ($homeadvert->search_find == 'search')
                                                                <li class="list-inline-item">
                                                                    <i class="fa"></i>Neve:
                                                                    {{ $homeadvert->name }}
                                                                </li>
                                                            @endif
                                                            <li class="list-inline-item">
                                                                <i class="fa fa-phone"></i>
                                                                {{ $homeadvert->pre_phone_number }}
                                                                {{ $homeadvert->phone_number }}
                                                            </li>
                                                        </ul>
                                                        <p class="card-text">Jellemzői:
                                                            {{ $homeadvert->characteristics }}
                                                        </p>
                                                        <ul class="list-inline product-meta">
                                                            <li class="list-inline-item">
                                                                {{ $homeadvert->user->name }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- else user no start-->
                                            @else
                                                <div class="card">
                                                    <div class="thumb-content">
                                                        <a href="/website/hirdetesReszletei/{{ $homeadvert->id }}">
                                                            <img class="card-img-top img-fluid"
                                                                src="/assets/images/advertisement/{{ $homeadvert->image_attach }}"
                                                                alt="Hirdetés">
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="card-title"><a
                                                                href="/website/hirdetesReszletei/{{ $homeadvert->id }}"
                                                                data-filter=".filter-{{ $homeadvert->id }}">{{ $homeadvert->title }}</a>
                                                        </h4>

                                                        <ul class="list-inline product-meta">
                                                            <li class="list-inline-item">
                                                                <i class="fa fa-calendar"></i>
                                                                {{ $homeadvert->disappeared }}
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a><i
                                                                        class="fa fa-folder-open"></i>{{ isset($homeadvert) ? ($homeadvert->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}</a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <p>{{ isset($homeadvert) ? ($homeadvert->sex == 'Male' ? 'Hím' : '') : '' }}{{ isset($homeadvert) ? ($homeadvert->sex == 'Female' ? 'Nőstény' : '') : '' }}
                                                                </p>
                                                            </li>
                                                            @if ($homeadvert->search_find == 'search')
                                                                <li class="list-inline-item">
                                                                    <i class="fa"></i>Neve:
                                                                    {{ $homeadvert->name }}
                                                                </li>
                                                            @endif
                                                            <li class="list-inline-item">
                                                                <i class="fa fa-phone"></i>
                                                                {{ $homeadvert->pre_phone_number }}
                                                                {{ $homeadvert->phone_number }}
                                                            </li>
                                                        </ul>
                                                        <p class="card-text">Jellemzői:
                                                            {{ $homeadvert->characteristics }}
                                                        </p>
                                                        <ul class="list-inline product-meta">
                                                            <li class="list-inline-item">
                                                                {{ $homeadvert->user->name }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- else user no end-->
                                        @endif
                                        <!-- Users ad end -->
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====================================
                                                =            Call to Action            =
                                                =====================================-->
    <section class="call-to-action overly bg-3 section-sm">
        <!-- Container Start -->
        <div class="container">
            <div class="row justify-content-md-center text-center">
                <div class="col-md-8">
                    <div class="content-holder">
                        <h2>Adj fel hirdetést, vagy segíts másoknak megtalálni elveszett háziállataikat!</h2>
                        <ul class="list-inline mt-30">
                            <li class="list-inline-item"><button type="button"
                                    onclick="location.href='/website/advertisement/create'" class="btn btn-main">Hirdetés
                                    feladása</button>
                            </li>
                            <li class="list-inline-item"><button type="button" class="btn btn-secondary"
                                    onclick="location.href='/website/hirdetesek'">Böngészés
                                </button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    <!-- #blog end -->
@endsection('content')
