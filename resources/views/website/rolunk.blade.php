@extends('website.main')
@section('content')
@include('website.messages')
    <section class="page-title">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <!-- Title text -->
                    <h3>Rólunk</h3>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class=" col-lg-5 pt-5 pt-lg-5">
                    <div class="about-img">
                        <img src="/admin_assets/images/rolunk.png" class="img-fluid w-100 rounded" alt="logó">
                    </div>
                </div>
                <div class="col-lg-7 p-11">
                    <div class="about-content">
                        <h3 class="font-weight-bold">Bemutatkozás</h3>
                        <p>A Nyomozoo.hu Magyarország egyetlen online háziállatkereső oldala, 2021 óta vagyunk jelen a hazai
                            online világban.
                            Az ötlet tulajdonosa egy fiatal srác, akinek a szerettei között vannak a háziállatok is.
                            Pontosan emiatt döntött így, hogy segíteni szeretne olyan embereken,
                            akiknek a szeretett háziállatai elkóboroltak vagy esetleg az utcán menve rátaláltak egy kóborló állatra.
                        </p>
                        <h3 class="font-weight-bold">Az oldal célja</h3>
                        <p>A lehető legjobb szolgáltatás biztosítása mind a hirdetőnek, mind a megtalálónak. Segítségnyújtás
                            a gyors és egyszerű megtaláláshoz!</p>
                        <h3 class="font-weight-bold">Az oldal használata</h3>
                        <p>
                            <strong>Az oldal teljes egészében ingyen használható.</strong> <br>Egy új felhasználó bármilyen személyes adat megadása (regisztráció) nélkül is képes segítséget nyújtani a hirdetőknek.
                            Viszont ahhoz, hogy kialakulhasson egy egymást segítő közösség erősen ajánljuk, hogy belépéseddel megyegyszerűsítsd a kapcsolatfelvétel folyamatát, hiszen belépés, avagy regisztráció után láthatod csak a többi felhasználó személyes adatait.
                            <br>Valamint az adataid megadása után számos funkció nyílik meg előtted, mint például:<br>- képes leszel feltölteni elveszett vagy megtalált kiskedvence(ke)t<br>- elérhetővé válik az oldalon keresztüli azonnali Email küldés a hirdetőnek
                            <br>- az oldalra feltöltött hirdetéseidet képes leszel exportálni PDF formátumba és ezt akár kinyomtathatod, vagy tovább küldheted ismerőseidnek, hogy minél több ember segítsen az elveszett/megtalált háziállat hazajuttatásában.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading text-center text-capitalize font-weight-bold py-3">
                        <h2>Készítők</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card my-3 my-lg-0">
                        <!--<img class="card-img-top" src="images/team/team2.jpg" class="img-fluid w-100" alt="Card image cap">-->
                        <div class="card-body bg-gray text-center">
                            <h5 class="card-title">Bod Gergely</h5>
                            <p class="card-text">Az oldal tulajdonosa / fejlesztője</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card my-3 my-lg-0">
                        <!--<img class="card-img-top" src="images/team/team2.jpg" class="img-fluid w-100" alt="Card image cap">-->
                        <div class="card-body bg-gray text-center">
                            <h5 class="card-title">Juhász Dalma</h5>
                            <p class="card-text">Tervezőgrafikus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 my-lg-0 my-4">
                    <div class="counter-content text-center bg-light py-4 rounded">
                        <i class="fa fa-user-o d-block"></i>
                        <span class="counter my-2 d-block" style="color: #50a59e" data-count="{{ $allusers }}">0</span>
                        <h5>Felhasználók</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 my-lg-0 my-4">
                    <div class="counter-content text-center bg-light py-4 rounded">
                        <i class="fa fa-bookmark-o d-block"></i>

                        <span class="counter my-2 d-block" style="color: #50a59e" data-count="{{ $allaprovads }}">0</span>
                        <h5>Elfogadott hirdetések</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 my-lg-0 my-4">
                    <div class="counter-content text-center bg-light py-4 rounded">
                        <i class="fa fa-paw d-block"></i>
                        <span class="counter my-2 d-block" style="color: #50a59e" data-count="{{ $alldeletedads }}">0</span>
                        <h5>Gazdihoz visszajuttatott állatok száma</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
