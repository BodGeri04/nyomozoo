<!DOCTYPE html>
<html lang="hu">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<head>

    <!-- SITE TITTLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nyomozoo.hu - Elveszett és megtalált háziállatok egy helyen.
    </title>
    <meta name="description" lang="hu"
        content="Elveszett kedvenc háziállatod? A leghamarabb itt kaphatsz segítésget. Ne késlekedj, adj fel hirdetést! Mi segítünk nyomozni!">
    <meta name="title" lang="hu"
        content="Elveszett kedvenc háziállatod? A leghamarabb itt kaphatsz segítésget. Ne késlekedj, adj fel hirdetést! Mi segítünk nyomozni!">
    <meta name="Author" lang="hu" content="Nyomozoo.hu">
    <meta name="rating" content="general">
    <meta name="keywords"
        content="Nyomozoo.hu, nyomozoo.hu, nyomozoo, nyomoz, nyom, nyomozoohu, nyomozoo hu, elveszett háziállat">
    <link rel="shortcut icon" href="/admin_assets/images/kutya_title.png" />
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- PLUGINS CSS STYLE -->
    <link href="/admin_assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/admin_assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin_assets/plugins/bootstrap/css/bootstrap-slider.css">
    <!-- Font Awesome -->
    <link href="/admin_assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link href="/admin_assets/plugins/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="/admin_assets/plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
    <!-- Fancy Box -->
    <link href="/admin_assets/plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
    <link href="/admin_assets/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="/css/style_1.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='/scss/_sweetalert.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>
    <link rel="stylesheet" href="/css/style_.css">
    <link rel="stylesheet" href="/admin_assets/plugins/summernote/summernote-bs4.css" />
    <link rel="stylesheet" href="/css/style__.css">
    <link rel="stylesheet" href="/scss/cookie.scss">
    <link rel="stylesheet" href="/css/feedback.css">
    <link rel="stylesheet" href="/scss/templates/_navigation.scss"></head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-5TLRLYDMYE"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-5TLRLYDMYE');
    </script>-->
<body class="body-wrapper">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light navigation">
                        <a class="navbar-brand" href="/">
                            <img src="/admin_assets/images/logo_export_new_white.png" alt="kep">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto main-nav ">
                                @if (Request::url() == 'https://nyomozoo.hu/website/home' || Request::url() == 'https://nyomozoo.hu/' || Request::url()=='https://www.nyomozoo.hu/' || Request::url()=='https://www.nyomozoo.hu/website/home')
                                <li class="nav-item active">
                                    <a class="nav-link" href="/">Kezdőlap</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Kezdőlap</a>
                                </li>
                                @endif
                                <!-- Dropdown list -->
                                @if (Request::url() == 'https://nyomozoo.hu/website/hirdetesek' || Request::url() == 'https://www.nyomozoo.hu/website/hirdetesek')
                                <li class="nav-item active">
                                    <a class="nav-link" href="/website/hirdetesek">Hirdetések</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/website/hirdetesek">Hirdetések</a>
                                </li>
                                @endif
                                @if (Auth::check()&&(Request::url() == 'https://nyomozoo.hu/website/felhasznModosit'|| Request::url() == 'https://www.nyomozoo.hu/website/felhasznModosit'))
                                <li class="nav-item active">
                                    <a class="nav-link" href="/website/felhasznModosit">Felhasználó adatai</a>
                                </li>
                                @elseif(Auth::check()&&(Request::url() != 'https://nyomozoo.hu/website/felhasznModosit' || Request::url() != 'https://www.nyomozoo.hu/website/felhasznModosit'))
                                <li class="nav-item">
                                    <a class="nav-link" href="/website/felhasznModosit">Felhasználó adatai</a>
                                </li>
                                @endif
                                @if (Auth::check()&&(Request::url() == 'https://nyomozoo.hu/website/sajatHirdetesek' || Request::url() == 'https://www.nyomozoo.hu/website/sajatHirdetesek'))
                                <li class="nav-item active">
                                    <a class="nav-link" href="/website/sajatHirdetesek">Saját hirdetéseim</a>
                                </li>
                                @elseif(Auth::check()&&(Request::url() != 'https://nyomozoo.hu/website/sajatHirdetesek' || Request::url() != 'https://www.nyomozoo.hu/website/sajatHirdetesek'))
                                <li class="nav-item">
                                    <a class="nav-link" href="/website/sajatHirdetesek">Saját hirdetéseim</a>
                                </li>
                                @endif
                                @if (Request::url() == 'https://nyomozoo.hu/website/rolunk' || Request::url() == 'https://www.nyomozoo.hu/website/rolunk')
                                <li class="nav-item active">
                                    <a class="nav-link" href="/website/rolunk">Az oldalról</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/website/rolunk">Az oldalról</a>
                                </li>
                                @endif
                            </ul>
                            <ul class="navbar-nav ml-auto mt-10">
                                <li class="nav-item">
                                    @if (!Auth::check())
                                        <a href="{{url('login')}}"
                                            class="nav-link login-button">Bejelentkezés</a>
                                    @endif
                                    @if (Auth::check())
                                        <button type="button" onclick="location.href='/logout'"
                                            class="nav-link login-button">Kijelentkezés</button>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white add-button" href="/website/advertisement/create"><i
                                            class="fa fa-plus-circle"></i> Adj fel hirdetést</a>
                                </li>
                                @endif
                                @if (!Auth::check())
                                    <li class="nav-item">
                                        <button type="button" onclick="location.href='/register'"
                                            class="nav-link login-button">Regisztráció</button>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!--===============================
=            Hero Area            =
================================-->
    @yield('content')
    <!--============================
=            Footer            =
=============================-->
    <footer class="footer section section-sm">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 offset-md-1 offset-lg-0">
                    <!-- About -->
                    <div class="block about">
                        <!-- footer logo -->
                        <img src="/admin_assets/images/logo_export_jav_black.png" alt="kep">
                        <!-- description -->
                        <p class="alt-color">A Nyomozoo.hu Magyarország egyetlen online háziállatkereső oldala,
                            2021
                            óta vagyunk jelen a hazai online világban.
                            @if (Request::url() !== 'https://nyomozoo.hu/website/rolunk')
                                <a href="/website/rolunk">Bővebben</a>
                            @endif
                        </p>

                        <p class="alt-color">Az oldal célja, hogy a lehető legjobb szolgáltatást biztosítsa mind a
                            keresőnek, mind a megtalálónak.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 offset-lg-1 col-md-3">
                </div>

                <!-- Link list -->
                <div class="col-lg-4 col-md-3 offset-md-1 offset-lg-0">
                    <ul class="navbar-nav ml-auto main-nav ">
                        <div class="block">
                            <h4>Oldalak</h4>
                            <ul>
                                <li><a href="/website/home">Főoldal</a></li>
                            </ul>
                            @if (Auth::check())
                                <ul>
                                    <li><a href="/website/advertisement/create">Hirdetésfeladás</a></li>
                                </ul>
                            @endif
                            <ul>
                                <li><a href="/website/hirdetesek">Böngészés a hirdetések között</a></li>
                            </ul>
                            @if (Auth::check())
                                <ul>
                                    <li><a href="/website/felhasznModosit">Felhasználói adatok módosítás</a></li>
                                </ul>
                                <ul>
                                    <li><a href="/website/velemeny/create">Értékeld az oldalt</a></li>
                                </ul>
                            @endif
                            <ul>
                                <li><a href="/website/kapcsolat">Kapcsolat</a></li>
                            </ul>
                            @if (Auth::check() &&
    Auth::user()->where('id', Auth::user()->id)->where('Admin', 1)->count() == 1)
                                <h4>Admin</h4>
                                <ul>
                                    <li><a href="/admin/home">Admin felület</a></li>
                                </ul>
                            @endif
                        </div>
                    </ul>
                    @if (Auth::check())
                        <label>Bejelentkezve: <a href="/website/felhasznModosit"> {{ Auth::user()->name }}</a>
                            felhasználóval.</label>
                    @endif
                </div>

            </div>
        </div>
        <!-- Container End -->

    </footer>
    <!-- Footer Bottom -->
    <footer class="footer-bottom">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <!-- Copyright -->
                    <div class="copyright">
                        ©
                        <script>
                            var CurrentYear = new Date().getFullYear()
                            document.write(CurrentYear)
                        </script>. Minden jog fenntartva. Az oldal teljes fejlesztője Bod Gergely
                        <a class="fa fa-facebook" href="https://www.facebook.com/nyomozoo"
                        target="_blank"></a>
                        <!--<div class="fb-like" data-href="https://www.facebook.com/nyomozoo" data-width="500"
                            data-layout="standard" data-action="like" data-size="small" data-share="true"></div>-->
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="block">
                        <ul class="navbar-nav ml-auto main-nav ">
                            <li><a href="/website/adatkezeles">Adatkezelési tájékoztató</a>
                                <a href="/website/hasznalatiFeltetelek">Felhasználási feltételek</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
        <!-- To Top -->
        <div class="top-to">
            <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
        </div>
    </footer>
    <!-- FacebookLikePage -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v12.0"
        nonce="HMn3UNtv"></script>
    <!-- JAVASCRIPTS -->
    <script src="/admin_assets/plugins/jQuery/jquery.min.js"></script>
    <script src="/admin_assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/admin_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin_assets/plugins/bootstrap/js/bootstrap-slider.js"></script>
    <script src="/admin_assets/js/admin.js"></script>
    <script src="/admin_assets/plugins/summernote/summernote-bs4.js"></script>
    <!-- tether js -->
    <script src="/admin_assets/plugins/tether/js/tether.min.js"></script>
    <!--<script src="/admin_assets/plugins/raty/jquery.raty-fa.js"></script>-->
    <script src="/admin_assets/plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="/admin_assets/plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="/admin_assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
    <script src="/admin_assets/plugins/smoothscroll/SmoothScroll.min.js"></script>

    <script src="/admin_assets/plugins/google-map/gmap.js"></script>
    <!-- sweetalert.js -->
    <script src="/admin_assets/js/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="/js/script.js"></script>
    <script src="/js/script_.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
    <script src="/js/script_1.js?v=1.1"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js">
    </script>

</body>

</html>
