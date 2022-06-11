<!DOCTYPE html>
<html lang="hu">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin felület -Nyomozoo.hu-</title>
        <link rel="shortcut icon" href="/admin_assets/images/kutya_title.png" />
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/admin_assets/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="/admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="/admin_assets/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/admin_assets/plugins/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="/admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="/admin_assets/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="/admin_assets/plugins/summernote/summernote-bs4.min.css">
        <!-- Tinymce dokumentáció (textarea)-->
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>
    </head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="/admin_assets/images/kutya_title.png" alt="AdminLTELogo" height="60" width="60">
  </div>
@if (Request::url() != 'http://127.0.0.1:8000/admin/home')
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin/home" class="nav-link">Főoldal</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  @endif
<!-- Notifications Dropdown Menu -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-3">
    <!-- Brand Logo -->
    <a href="/admin/home" class="brand-link">
        <img src="/admin_assets/images/logo_export_jav_black.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-5" style="opacity: .8">
            <span class="brand-text font-weight-light"><hr>Nyomozoo.hu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-5 pb-4 mb-4 d-flex">
          <div class="image">
            <img src="/assets/images/users/{{Auth::user()->image_attach}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="/admin/user/{{Auth::user()->id}}/edit" class="d-block">{{Auth::user()->name}}</a>
          </div>
        </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="fas fa-book nav-icon"></i>
                    <p>
                       Admin oldal
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/home" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Főoldal</p>
                    </a>
                </li>
                    <li class="nav-item">
                        <a href="/admin/user" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Felhasználók</p>
                        </a>
                    </li>
                    <!--<li class="nav-item">
                      <a href="/admin/getIps" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Aktív felhasználók</p>
                      </a>
                  </li>-->
                  <li class="nav-item">
                    <a href="/admin/deletedUsers" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Törölt felhasználók</p>
                    </a>
                  </li>
                    <li class="nav-item">
                        <a href="/website/advertisement" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Hirdetések listája</p>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="/admin/deletedAds" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Törölt hirdetések listája</p>
                      </a>
                  </li>
                    <li class="nav-item">
                        <a href="/website/velemeny" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vélemények</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/emailSend" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Email küldése</p>
                        </a>
                    </li>
                    @if(Auth::user()->email=="bodge04@gmail.com")
                    <li class="nav-item">
                        <a href="/admin/maintenance" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Karbantartás</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item menu-closed">
              <a href="#" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>
                      Felhasználói rész
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Főoldal</p>
                  </a>
              </li>
                  <li class="nav-item">
                      <a href="/website/hirdetesek" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Elveszett hirdetések</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/website/talaltHirdetesek" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Talált hirdetések</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/website/sajatHirdetesek" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Saját hirdetéseim</p>
                      </a>
                  </li>
              </ul>
          </li>
          <br>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Kijelentkezés
              </p>
            </a>
          </li>
        </ul>
    </nav>
    
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @yield('content')
  <footer class="main-footer">
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
                </div>
            </div>
        </footer>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/admin_assets/plugins/jQuery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin_assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/admin_assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/admin_assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/admin_assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/admin_assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin_assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/admin_assets/plugins/moment/moment.min.js"></script>
<script src="/admin_assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/admin_assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin_assets/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin_assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin_assets/js/pages/dashboard.js"></script>
<!-- bs-custom-file-input -->
<script src="/admin_assets/js/bs-custom-file-input.min.js"></script>
<!-- sweetalert.js -->
<script src="/admin_assets/js/sweetalert.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<!-- admin.js -->
<script src="/admin_assets/js/admin.js"></script>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
