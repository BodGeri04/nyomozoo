@extends('website.main')
@section('content')
    @include('website.messages')
    <!-- page title -->
    <!--================================
        =            Page Title            =
        =================================-->
    <section class="page-title">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <!-- Title text -->
                    <h3>Kapcsolat</h3>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    <!-- page title -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-us-content p-4">
                        <h4>Észrevételed van, vagy problémába ütköztél bizonyos funkció használata közben?</h4>
                        <h1 class="pt-3 pb-8">Vedd fel velünk a kapcsolatot!</h1>
                        <label class="pt-5 pb-8" style="font-size: 17px">Az üzentre általában 2 munkanapon belül
                            válaszolunk.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="/website/kapcsolat" class="row" method="POST">
                        @csrf
                        <fieldset class="p-4">
                            <div class="form-group">
                                @if (Auth::check())
                                    <div class="row">
                                        <div class="col-lg-6 py-2">
                                            <input type="text" class="form-control" name="name" id="name" required
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="col-lg-6 pt-2">
                                            <input type="email" name="email" id="email" class="form-control" required
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="col-lg-6 pt-5">
                                            <input type="text" name="subject" placeholder="Tárgy *" id="subject"
                                                class="form-control" required>
                                        </div>
                                    </div>
                            </div>
                            <textarea required name="message" rows="10" class="form-control"
                                placeholder="Üzenet *"></textarea><br>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                            @error('g-recaptcha-response')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <div class="btn-grounp">
                                <button type="submit" class="btn btn-primary mt-2 float-right">Küldés</button>
                            </div>
                        @else
                            <div class="col-12">
                                <button type="button" onclick="location.href='/login'" class="btn btn-main">Az
                                    üzenetküldéshez először
                                    jelentkezz be!</button>
                            </div>
                            @endif
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us end -->
@endsection('content')
