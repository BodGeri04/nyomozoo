@extends('website.main')
@section('content')
@include('website.messages')
    <!-- Multi step form -->
    <section class="multi_step_form">
        <!-- Tittle -->
        @if ($mode == 'create')
            <form id="msform" method="POST" action="{{ route('advertisement.store') }}" enctype="multipart/form-data">
                @csrf
        @endif
        @if ($mode == 'edit')
            <form id="msform" method="POST" action="{{ route('advertisement.update', $advertisement->id) }}"
                enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                @csrf
        @endif
        <div class="tittle">
            @if ($mode == 'edit')
                <h2>Hirdetés módosítása</h2>
            @else
                <h2>Hirdetésfeladás</h2>
            @endif
            <p>Az eltünt, avagy megtalált háziállat adatait tudod megadni itt. Kövesd végig az űrlap utasításait.</p>
        </div>
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Hirdetés adatai</li>
            <li>Állat adatai</li>
            <li>Egyéb adatok</li>
        </ul>
        <!-- fieldsets -->
        <fieldset>
            @if ($mode == 'create' || Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1)
            <div class="form-group row">
                <label class="form-group col-md-3" for="basicInput">Keresel vagy találtál?</label>
                <div class="form-group col-md-3">
                    <select onchange="update();" id="search_find" name="search_find" data-plugin-selectOne
                        class="w-100 form-control mt-lg-1 mt-md-2">
                        <option value="search"
                            {{ isset($advertisement) ? ($advertisement->search_find == 'search' ? 'selected' : '') : '' }}>
                            Keresek
                        </option>
                        <option value="find"
                            {{ isset($advertisement) ? ($advertisement->search_find == 'find' ? 'selected' : '') : '' }}>
                            Találtam
                        </option>
                    </select>
                </div>
            </div>
            @endif
            <div class="form-group row">
                <label class="form-group col-md-3" for="basicInput">Hirdetés neve *<div class="help-tip">
                        <p>Egy jó cím növeli a megtalálás esélyeit. Próbáld egyértelműen megnevezni a hirdetésed tárgyát.
                        </p>
                    </div></label>
                <div class="form-group col-md-9">
                    <textarea id="title" type="text" name="title" class="form-control"
                      value="{{ isset($advertisement) ? $advertisement->title : '' }}" rows="3">{{ isset($advertisement) ? $advertisement->title : '' }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="form-group col-md-3" for="basicInput">Milyen állat? *</label>
                <div class="form-group col-md-4">
                    <select id="animal_type" name="animal_type" data-plugin-selectOne
                        class="w-100 form-control mt-lg-1 mt-md-2">
                        <option value="dog" selected
                            {{ isset($advertisement) ? ($advertisement->animal_type == 'dog' ? 'selected' : '') : '' }}>
                            Kutya
                        </option>
                        <option value="cat"
                            {{ isset($advertisement) ? ($advertisement->animal_type == 'cat' ? 'selected' : '') : '' }}>
                            Macska
                        </option>
                        <option value="rabbit"
                            {{ isset($advertisement) ? ($advertisement->animal_type == 'rabbit' ? 'selected' : '') : '' }}>
                            Nyúl
                        </option>
                        <option value="hedgehog"
                            {{ isset($advertisement) ? ($advertisement->animal_type == 'hedgehog' ? 'selected' : '') : '' }}>
                            Sündisznó
                        </option>
                        <option value="parrot"
                            {{ isset($advertisement) ? ($advertisement->animal_type == 'parrot' ? 'selected' : '') : '' }}>
                            Papagáj
                        </option>
                        <!--<option value="other"
                                        {{ isset($advertisement) ? ($advertisement->animal_type == 'other' ? 'selected' : '') : '' }}>
                                        Más...
                                    </option>-->
                    </select>
                </div>
            </div>
            <!--<div class="form-row">
                            <label id="otherlbl" class="form-group col-md-3" for="basicInput">Írja ide, ha más állatot szeretne hirdetni.</label>
                            <div class="form-group col-md-6">
                                <input id="otherinpt" type="text" name="test" class="form-control">
                            </div>
                        </div>-->
            <div class="form-row">
                <label class="form-group col-md-3" for="basicInput">Neme *</label>
                <div class="col-md-6">
                    <div class="form-group col-md-6">
                        <select id="sex" name="sex" data-plugin-selectOne class="form-control populate"
                            value="{{ isset($advertisement) ? $advertisement->sex : '' }}">
                            <option value="Male"
                                {{ isset($advertisement) ? ($advertisement->sex == 'Male' ? 'selected' : '') : '' }}>
                                Hím
                            </option>
                            <option value="Female"
                                {{ isset($advertisement) ? ($advertisement->sex == 'Female' ? 'selected' : '') : '' }}>
                                Nőstény
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            @if ($mode == 'edit' &&
    Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1)
                <div class="form-group row">
                    <label class="form-group col-md-3" style="color: red" for="basicInput">Publikálás</label>
                    <div class="form-group col-md-1">
                        <input type="checkbox" name="approve" class="form-control"
                            value="{{ isset($advertisement) ? ($advertisement->approve == 1 ? 'checked' : '') : '' }}{{ isset($advertisement) ? ($advertisement->approve == 0 ? 'unchecked' : '') : '' }}"
                            {{ isset($advertisement) ? ($advertisement->approve == 1 ? 'checked' : '') : '' }}{{ isset($advertisement) ? ($advertisement->approve == 0 ? 'unchecked' : '') : '' }}>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary me-1 mb-1" value="Mentés" />
                    </div>
                </div>
            @endif
            <br>
            <div class="form-group row">
                <label id="hide" class="form-group col-md-3" for="basicInput">Az állat neve *</label>
                <div class="form-group col-md-6">
                    <input id="name" type="text" name="name" class="form-control"
                        value="{{ isset($advertisement) ? $advertisement->name : '' }}">
                </div>
            </div>
            <br>
            @if (Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1)
                <button onclick="location.href='/website/advertisement'" type="button" class="btn btn-transparent">Admin
                    felület</button>
            @endif
            <button type="button" onclick="location.href='/website/home'"
                class="action-button previous previous_button">Vissza a főoldalra</button>
            <button type="button" class="next action-button">Tovább</button>
        </fieldset>
        <fieldset>
            <div class="form-group row">
                <label id="date" class="form-group col-md-3" for="basicInput">Elkóborlás dátuma *</label>
                <div class="form-group col-md-6">
                    <input id="disappeared" type="date" max="<?php echo date('Y-m-d'); ?>" name="disappeared" class="form-control"
                        value="{{ isset($advertisement) ? $advertisement->disappeared : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="form-group col-md-3" for="basicInput">Elérhetőség *</label>
                <div class="form-group col-md-4">
                    <input name="pre_phone_number" type="text" id="phone" class="form-control" placeholder="Pl.: +36"
                        value="{{ isset($advertisement) ? $advertisement->pre_phone_number : '' }}">
                </div>
                <div class="form-group col-md-5">
                    <input id="phone_number" id="phone" name="phone_number" type="text" class="form-control"
                        placeholder="Pl.: 301234567"
                        value="{{ isset($advertisement) ? $advertisement->phone_number : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label id="zip" class="form-group col-md-3" for="basicInput">Lakhelye (Ir. szám) *</label>
                <div class="form-group col-md-6">
                    <input id="zip_number" type="number" name="zip_number" class="form-control"
                        value="{{ isset($advertisement) ? $advertisement->zip_number : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="form-group col-md-3" for="basicInput">Van bejegyzett csipje?</label>
                <div class="form-group col-md-1">
                    <input type="checkbox" name="chip" class="form-control"
                        value="{{ isset($advertisement) ? ($advertisement->chip == 1 ? 'checked' : '') : '' }}{{ isset($advertisement) ? ($advertisement->chip == 0 ? 'unchecked' : '') : '' }}"
                        {{ isset($advertisement) ? ($advertisement->chip == 1 ? 'checked' : '') : '' }}{{ isset($advertisement) ? ($advertisement->chip == 0 ? 'unchecked' : '') : '' }}>
                </div>
            </div>
            <div class="form-row">
                <label class="form-group col-md-3" for="basicInput">Jellemzői * <div class="help-tip">
                        <p>Milyen fajta, milyen a szőrzete, van-e esetleg különlegessége, amiről fel lehet ismerni...</p>
                    </div></label>
                <div class="form-group col-md-9">
                    <textarea id="characteristics" type="text" name="characteristics" class="form-control"
                        value="{{ isset($advertisement) ? $advertisement->characteristics : '' }}">{{ isset($advertisement) ? $advertisement->characteristics : '' }}</textarea>
                </div>
            </div>
            </div>
            <button type="button" class="action-button previous previous_button">Előző oldal</button>
            <button type="button" class="next action-button">Tovább</button>
            </div>

        </fieldset>
        <fieldset>
            <div class="form-row">
                <label class="form-group col-md-4" for="basicInput">Egyéb megjegyzések <div class="help-tip">
                        <p>Hol látták utoljára, barátságos, vagy sem, milyen állapotban volt akkor az állat...</p>
                    </div></label>
                <div class="form-group col-md-8">
                    <input type="text" name="comment" class="form-control"
                        value="{{ isset($advertisement) ? $advertisement->comment : '' }}">
                </div>
            </div>
            <div class="">
                <h3>Egy jó minőségű kép feltöltése növeli a megtalálás esélyét, hiszen a képekkel rendelkező hirdetésekre
                    akár 10x többen kattintanak, és kizárólag így emelheted ki a hirdetésed az oldal tetején!</h3>
                <div class="file-upload col-md-12">

                    <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Kép
                        hozzáadása</button>
                    <div class="image-upload-wrap">
                        <input id="image_attach" class="file-upload-input" type='file' name="image_attach"
                            onchange="readURL(this);" accept="image/*"
                            value="{{ isset($advertisement) ? $advertisement->image_attach : '' }}" />
                        @if (isset($advertisement))
                            <?php echo "<img src='/assets/images/advertisement/$advertisement->image_attach' width=200 height=200> "; ?>
                        @endif
                        <div class="drag-text">
                            <h3>Húzd ide a képet, vagy csatolj a gomb segítségével</h3>
                        </div>
                    </div>
                    <div class="file-upload-content">
                        <img class="file-upload-image" src="#" alt="your image" />
                        <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Törlés <span
                                    class="image-title">Kép feltöltése</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="action-button previous previous_button">Előző oldal</button>
            <div class="col-sm-12 d-flex justify-content-end">
                <input type="submit" class="btn btn-primary btn--loading me-1 mb-1"
                    onclick="this.disabled=true;this.value='Küldés, kérjük várj...';this.form.submit();">
            </div>
        </fieldset>
        </form>
    </section>
    <!-- End Multi step form -->
    <script>
        function update() {
            var selected = document.getElementById("search_find").value;
            if (selected == 'find') {
                document.getElementById('hide').style.display = 'none';
                document.getElementById('name').style.display = 'none';
                document.getElementById('date').innerHTML = 'Megtalálás dátuma *';
                document.getElementById('zip').innerHTML = 'Megtalálás helyszíne (Ir. szám) *';
            } else {
                document.getElementById('hide').style.display = 'block';
                document.getElementById('name').style.display = 'block';
                document.getElementById('date').innerHTML = 'Elkóborlás dátuma *';
                document.getElementById('zip').innerHTML = 'Lakhelye (Ir. szám) *';
            }
        }
    </script>
    <script>
        function other() {
            var selected = document.getElementById("animal_type").value;
            if (selected == 'other') {
                document.getElementById('otherlbl').style.display = 'block';
                document.getElementById('otherinpt').style.display = 'block';
            } else {
                document.getElementById('otherlbl').style.display = 'none';
                document.getElementById('otherinpt').style.display = 'none';
            }
        }
    </script>
@endsection('content')
