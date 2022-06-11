<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="shortcut icon" href="/admin_assets/images/kutya_title.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nyomozoo.hu - Elveszett és megtalált háziállatok egy helyen. A Nyomozoo.hu segít megtalálni kiskedvencedet.</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
  <link rel="stylesheet" href="/admin_assets/plugins/css/adminlte.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    @yield('content')
</body>
<!-- jQuery -->
<script src="/admin_assets/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin_assets/js/adminlte.min.js"></script>
<script src="/admin_assets/js/show_pass.js"></script>
</html>

