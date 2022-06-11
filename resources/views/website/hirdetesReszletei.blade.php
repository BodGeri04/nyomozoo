@extends('website.main')
@section('content')
    @include('website.messages')
    <script src='/js/mapbox-gl.js'></script>
    <link rel='stylesheet' href="/css/mapbox-gl.css" />
    <section class="section bg-gray">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <!-- Left sidebar -->
                <div class="col-md-8">
                    <div class="product-details">
                        <h1 class="product-title">{{ $ownad->title }}</h1>
                        @if((Auth::check()&&$ownad->user_id==Auth::user()->id)||(Auth::check()&&Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1))
                        <span title="Eddigi megtekintések" class="float-right fa fa-user"> {{$ownad->views+1}}</span>
                        @endif
                        <div class="product-meta">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-user-o"></i> {{ $ownad->user->name }}</li>
                                <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Állat:
                                    {{ isset($ownad) ? ($ownad->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}
                                </li>
                                @if ($ownad->search_find == 'search')
                                    <li class="list-inline-item"><i class="fa fa-folder-open"></i> Állat neve:
                                        {{ $ownad->name }}</li>
                                @endif
                                <li class="list-inline-item"><i class="fa fa-location-arrow"></i> Irányítószám:
                                    {{ $ownad->zip_number }}</li>
                            </ul>
                        </div>
                        @if (session('flash'))
                            <p style="color:rgb(0, 212, 0)">{{ session('flash') }}</p>
                        @endif
                        <!-- product slider -->
                        <div class="product-slider">
                            <div class="product-slider-item my-4">
                                <img id="myImg" class="img-fluid w-50"
                                    src="/assets/images/advertisement/{{ $ownad->image_attach }}">
                            </div>
                        </div>

                        <!-- product slider -->
                        <div class="content mt-6 pt-6">
                            <ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Az állatról</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                        href="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Fontos adatok</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                        href="#pills-contact" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Kapcsolatfelvétel</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    @if ($ownad->search_find == 'search')
                                        <h3 class="tab-title">Elveszett háziállat tulajdonságai</h3>
                                    @else
                                        <h3 class="tab-title">Talált háziállat tulajdonságai</h3>
                                    @endif
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-bordered product-table">
                                            <tbody>
                                                <tr>
                                                    <td>Milyen állat?</td>
                                                    <td>{{ isset($ownad) ? ($ownad->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($ownad) ? ($ownad->animal_type == 'parrot' ? 'Papagáj' : '') : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Neme</td>
                                                    <td>{{ isset($ownad) ? ($ownad->sex == 'Male' ? 'Hím' : '') : '' }}{{ isset($ownad) ? ($ownad->sex == 'Female' ? 'Nőstény' : '') : '' }}
                                                    </td>
                                                </tr>
                                                @if ($ownad->search_find == 'search')
                                                    <tr>
                                                        <td>Neve</td>
                                                        <td>{{ $ownad->name }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <p><label>Jellemzői: {{ $ownad->characteristics }}</label></p>
                                    <p><label>Egyéb adatok: {{ $ownad->comment }}</label></p>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <h3 class="tab-title">Az állat adatai</h3>
                                    <div class="card-body table-responsive p-0">
                                        <?php
                                            $created_date_ad=explode(' ',$ownad->created_at)
                                        ?>
                                        <table class="table table-bordered product-table">
                                            <tbody>
                                                <tr>
                                                    @if ($ownad->search_find == 'search')
                                                        <td>Eltűnés dátuma</td>
                                                    @else
                                                        <td>Megtalálás dátuma</td>
                                                    @endif
                                                    <td>{{ $ownad->disappeared }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hirdetés publikálása</td>
                                                    <td>{{ $created_date_ad[0] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Irányítószám</td>
                                                    <td>{{ $ownad->zip_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Csip</td>
                                                    <td>{{ isset($ownad) ? ($ownad->chip == '1' ? 'Van' : '') : '' }}{{ isset($ownad) ? ($ownad->chip == '0' ? 'Nincs' : '') : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Elérhetőség</td>
                                                    <td>{{ $ownad->pre_phone_number }} {{ $ownad->phone_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <h3 class="tab-title">Vedd fel a kapcsolatot a hirdetővel</h3>
                                    <?php
                                $created_date_user=explode(' ',$ownad->user->created_at)
                                    ?>
                                    <div class="product-review">
                                        <div class="media">
                                            <!-- Avater -->
                                            <img src="/assets/images/users/{{ $ownad->user->image_attach }}"
                                                alt="Profilkép">
                                            <div class="media-body">
                                                <!-- Ratings -->
                                                <div class="name">
                                                    <h5>{{ $ownad->user->name }}</h5>
                                                </div>
                                                <div class="date">
                                                    <p>Csatlakozott: {{ $created_date_user[0] }}<br>
                                                        Telefonszáma:
                                                        {{ $ownad->pre_phone_number }} {{ $ownad->phone_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-submission">
                                            <div class="review-submit">
                                                <form action="/website/hirdetesReszletei/{{ $ownad->id }}"
                                                    class="row" method="POST">
                                                    @csrf
                                                    @if (!(Auth::check() && Auth::user()->id == $ownad->user->id))
                                                        @if (Auth::check())
                                                            <div class="col-lg-6">
                                                                <input required type="text" name="name" id="name"
                                                                    class="form-control" placeholder="A Te neved">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input required type="email" name="email" id="email"
                                                                    class="form-control" placeholder="A Te emailed">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input required type="phone" name="phone" id="phone"
                                                                    class="form-control" placeholder="A Te telefonszámod">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input required type="text" name="subject" id="email"
                                                                    class="form-control" placeholder="Tárgy">
                                                            </div>
                                                            <div class="col-12">
                                                                <textarea required name="message" id="review" rows="15"
                                                                    class="form-control"
                                                                    placeholder="Üzenet. Célszerű azt is ideírni, hogy a hirdetőnek, mely hirdetésére reagálsz."></textarea>
                                                            </div>
                                                            <div class="g-recaptcha col-lg-6"
                                                                data-sitekey="{{ config('services.recaptcha.site_key') }}">
                                                            </div>
                                                            @error('g-recaptcha-response')
                                                                <div class="text-red-500">{{ $message }}</div>
                                                            @enderror
                                                            <div class="col-12">
                                                                <br>
                                                                <button type="submit" class="btn btn-main">Küldés</button>
                                                            </div>
                                                        @else
                                                            <div class="col-12">
                                                                <button type="button" onclick="location.href='/login'"
                                                                    class="btn btn-main">Az üzenetküldéshez először
                                                                    jelentkezz be!</button>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="col-12">
                                                            <label class="font-weight-bold">Saját hirdetésre nem tudsz
                                                                válaszolni!<label>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="widget price text-center">
                            <h4>Státusz</h4>
                            <p style="color: rgb(102, 250, 102)">
                                {{ isset($ownad) ? ($ownad->status == 'active' ? 'Aktív' : '') : '' }}{{ isset($ownad) ? ($ownad->status == 'inactive' ? 'Inaktív' : '') : '' }}
                            </p>
                        </div>
                        <!-- User Profile widget -->
                        <div class="widget user text-center">
                            <h4>{{ $ownad->user->name }}</h4>
                            <p class="member-time">Tagsági ideje: {{ $created_date_user[0] }}</p>
                            <ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item"><a id="pills-contact-tab" data-toggle="pill" role="tab"
                                        aria-controls="pills-contact" href="#pills-contact" aria-selected="false"
                                        class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3">Kapcsolatfelvétel</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Map Widget -->
                        <div class="widget map">
                            <div id="map">
                                <x-mapbox id="mapId" :center="['long' => 19.04, 'lat'=>47.49]"/>
                            </div>
                        </div>
                        <!-- Safety tips widget -->
                        <div class="widget disclaimer">
                            <h5 class="widget-header">Netikett</h5>
                            <ul>
                                <li>Ne írj csupa nagybetűvel, mert az kiabálásnak számít, használj kis- és nagybetűket is!
                                </li><br>
                                <li>Légy tömör anélkül, hogy túlságosan lényegre törő lennél!</li><br>
                                <li>Ne írj a chatre vagy a fórumba oda nem illő dolgokat!</li><br>
                                <li>Ha ezeket nem tartod be, akkor az oldalról kitilthatnak.</li><br>
                                <li>Bővebben a szabályokról <a href="https://hu.wikipedia.org/wiki/Netikett"
                                        target="blank_">itt</a> olvashatsz.</li>
                            </ul>
                        </div>
                        <!-- Coupon Widget -->
                        <div class="widget coupon text-center">
                            <!-- Coupon description -->
                            <p>Elveszett a legkedvencebb háziállatod?
                            </p>
                            <!-- Submit button -->
                            <a href="/website/advertisement/create" class="btn btn-transparent-white">Adj fel
                                hirdetést!</a>
                        </div>
                        <div id="myModal" class="modal">
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            modalImg.alt = this.alt;
            captionText.innerHTML = this.alt;
        }


        // When the user clicks on <span> (x), close the modal
        modal.onclick = function() {
            img01.className += " out";
            setTimeout(function() {
                modal.style.display = "none";
                img01.className = "modal-content";
            }, 400);

        }
    </script>
    <style>
/*terkep kezdete*/

#map {
display: block;
position: relative;
margin: 0px auto;
width: 100%;
height: 350px;
border: none;
border-radius: 3px;
}

/*terkep vege*/

       /*KepNagyitas kezdete*/
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
  display: block;
  margin-left: auto;
  margin-right: auto
}

#myImg:hover {
  opacity: 0.7;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

.modal-content {
  margin: auto;
  display: block;
  width: 60%;
  height: 60%;
  max-width: 60%;
}


@-webkit-keyframes zoom {
  from {-webkit-transform:scale(1)}
  to {-webkit-transform:scale(2)}
}

@keyframes zoom {
  from {transform:scale(0.4)}
  to {transform:scale(1)}
}

@-webkit-keyframes zoom-out {
  from {transform:scale(1)}
  to {transform:scale(0)}
}
@keyframes zoom-out {
  from {transform:scale(1)}
  to {transform:scale(0)}
}

.modal-content, #caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

.out {
  animation-name: zoom-out;
  animation-duration: 0.6s;
}

@media only screen and (max-width: 700px){
  .modal-content {
      width: 100%;
  }
}
 /*KepNagyitas vege*/
    </style>
@endsection('content')
