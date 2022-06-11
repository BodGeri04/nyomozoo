@extends('admin.main')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Navbar -->
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
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if ($notifications == 0)
                        <span class="badge badge-info navbar-badge">{{ $notifications }}</span>
                    @else
                        <span class="badge badge-danger navbar-badge">{{ $notifications }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ $notifications }} db értesítés</span>
                    <div class="dropdown-divider"></div>
                    <a href="/website/advertisement" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $notifications }} db új hirdetés
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- /.navbar -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.messages')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Áttekintés</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="/admin/home">Főoldal</a></li>
                            <li class="breadcrumb-item active">Áttekintés</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Összes vélemény</span>
                                <a href="/website/velemeny"><span class="info-box-number">{{ $allreviews }} db</span></a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bookmark"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Összes hirdetés</span>
                                <a href="/website/advertisement"><span class="info-box-number">{{ $allads }}
                                        db</span></a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Összes felhasználó</span>
                                <a href="/admin/user"><span class="info-box-number">{{ $allusers }} db</span></a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Előző heti statisztikák és célok</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-center">
                                            <strong>{{ $currentweekstart }} / {{ $currentweekend }}</strong>
                                        </p>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="pie-chart" height="180" style="height: 180px;"></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Előző héten</strong>
                                        </p>
                                        <div class="progress-group">
                                            Feltöltött hirdetések
                                            <span class="float-right"><b>{{ $adslastweek }}</b>/10</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary" style="width: {{($adslastweek/10)*100}}%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            Regisztrációk
                                            <span class="float-right"><b>{{$userslastweek}}</b>/10</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" style="width: {{($userslastweek/10)*100}}%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text">Visszajelzések</span>
                                            <span class="float-right"><b>{{$feedbackslastweek}}</b>/10</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" style="width: {{($feedbackslastweek/10)*100}}%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <p class="text-center">
                                    <strong>Változások az előző héthez képest</strong>
                                </p>
                                <div class="row">
                                    <div class="col-sm-4 col-6">
                                        <div class="description-block border-right border-left">
                                            @if($currentweekstatisticsusers<100 && $currentweekstatisticsusers>0)
                                            <span class="description-percentage text-danger"><i
                                                    class="fas fa-caret-down"></i> {{$currentweekstatisticsusers}}%</span>
                                            <h5 class="description-header">{{$userslastweek}} / {{$currentweekusers}}</h5>
                                            <span class="description-text">Felhasználók</span>
                                            @elseif($currentweekstatisticsusers>=100)
                                            <span class="description-percentage text-success"><i
                                                class="fas fa-caret-up"></i> {{$currentweekstatisticsusers}}%</span>
                                            <h5 class="description-header">{{$userslastweek}} / {{$currentweekusers}}</h5>
                                            <span class="description-text">Felhasználók</span>
                                            @endif
                                            @if($currentweekstatisticsusers==0)
                                            <span class="description-percentage text-warning"><i
                                                class="fas fa-caret-left"></i> 0%</span>
                                            <h5 class="description-header">Nincs adat!</h5>
                                            <span class="description-text">Felhasználók</span>
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-6">
                                        <div class="description-block border-right">
                                            @if($currentweekstatisticsads<100 && $currentweekstatisticsads>0)
                                            <span class="description-percentage text-danger"><i
                                                    class="fas fa-caret-down"></i> {{$currentweekstatisticsads}}%</span>
                                            <h5 class="description-header">{{$adslastweek}} / {{$currentweekads}}</h5>
                                            <span class="description-text">Aktív hirdetések</span>
                                            @elseif($currentweekstatisticsads>=100)
                                                <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> {{$currentweekstatisticsads}}%</span>
                                                 <h5 class="description-header">{{$adslastweek}} / {{$currentweekads}}</h5>
                                                <span class="description-text">Aktív hirdetések</span>
                                            @endif
                                            @if($currentweekstatisticsads==0)
                                            <span class="description-percentage text-warning"><i
                                                class="fas fa-caret-left"></i> 0%</span>
                                             <h5 class="description-header">Nincs adat!</h5>
                                            <span class="description-text">Aktív hirdetések</span>
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-6">
                                        <div class="description-block border-right">
                                            @if($currentfeedbacksstatistics<100 && $currentfeedbacksstatistics>0)
                                            <span class="description-percentage text-danger"><i
                                                    class="fas fa-caret-down"></i> {{$currentfeedbacksstatistics}}%</span>
                                            <h5 class="description-header">{{$feedbackslastweek}} / {{$currentfeedbacks}}</h5>
                                            <span class="description-text">Visszajelzések</span>
                                            @elseif($currentfeedbacksstatistics>=100)
                                            <span class="description-percentage text-success"><i
                                                class="fas fa-caret-up"></i> {{$currentfeedbacksstatistics}}%</span>
                                            <h5 class="description-header">{{$feedbackslastweek}} / {{$currentfeedbacks}}</h5>
                                            <span class="description-text">Visszajelzések</span>
                                            @endif
                                            @if($currentfeedbacksstatistics==0)
                                            <span class="description-percentage text-warning"><i
                                                class="fas fa-caret-left"></i> 0%</span>
                                            <h5 class="description-header">Nincs adat!</h5>
                                            <span class="description-text">Visszajelzések</span>
                                            @endif
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- USERS LIST -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Nemrég regisztráltak</h3>
                                        <div class="card-tools">
                                            <span class="badge badge-danger">{{ $allusers }} db aktív
                                                felhasználó</span>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <ul class="users-list clearfix">
                                            @foreach ($users as $user)
                                                <li>
                                                    <img src="/assets/images/users/{{ $user->image_attach }}"
                                                        alt="Felhasználó képe">
                                                    <a class="users-list-name"
                                                        href="/admin/user/{{ $user->id }}/edit">{{ $user->name }}</a>
                                                    <span class="users-list-date">{{ $user->created_at }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- /.users-list -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <a href="/admin/user">Az összes felhasználó</a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!--/.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Nemrég feltöltött aktív hirdetések</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Hirdetés ID</th>
                                                <th>Hirdetés címe</th>
                                                <th>Keres/talált</th>
                                                <th>Állat</th>
                                                <th>Feltöltő neve</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ads as $ad)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('advertisement.edit', $ad->id) }}">{{ $ad->id }}</a>
                                                    </td>
                                                    <td>{{ $ad->title }}</td>
                                                    <td>
                                                        @if ($ad->search_find == 'search')
                                                            <span
                                                                class="badge badge-warning">{{ isset($ad) ? ($ad->search_find == 'search' ? 'Keres' : '') : '' }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-info">{{ isset($ad) ? ($ad->search_find == 'find' ? 'Talált' : '') : '' }}</span>
                                                    </td>
                                            @endif
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                    {{ isset($ad) ? ($ad->animal_type == 'dog' ? 'Kutya' : '') : '' }}{{ isset($ad) ? ($ad->animal_type == 'cat' ? 'Macska' : '') : '' }}{{ isset($ad) ? ($ad->animal_type == 'rabbit' ? 'Nyúl' : '') : '' }}{{ isset($ad) ? ($ad->animal_type == 'hedgehog' ? 'Sündisznó' : '') : '' }}{{ isset($ad) ? ($ad->animal_type == 'parrot' ? 'papagáj' : '') : '' }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="/admin/user/{{ $ad->user->id }}/edit">
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                        {{ $ad->user->name }}</div>
                                                </a>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="/website/advertisement" class="btn btn-sm btn-secondary float-right">Az összes
                                    megtekintése</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <!-- Info Boxes Style 2 -->
                        <div class="info-box mb-3 bg-success">
                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Hirdetésmegtekintés szám</span>
                                <span class="info-box-number">{{$allviewsads}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->

                        <!-- PRODUCT LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Függőben lévő hirdetések</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach ($waitingads as $waitingad)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="/assets/images/advertisement/{{ $waitingad->image_attach }}"
                                                    alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('advertisement.edit', $waitingad->id) }}"
                                                    class="product-title">{{ $waitingad->title }}
                                                    @if ($waitingad->search_find == 'search')
                                                        <span
                                                            class="badge badge-warning float-right">{{ isset($waitingad) ? ($waitingad->search_find == 'search' ? 'Keres' : '') : '' }}
                                                </a>
                                            @else
                                                <span
                                                    class="badge badge-info float-right">{{ isset($waitingad) ? ($waitingad->search_find == 'find' ? 'Talált' : '') : '' }}</span>
                                    @endif
                            </div>
                            </li>
                            @endforeach
                            @empty($waitingad)
                                <span>Nincs függőben lévő hirdetés!</span>
                            @endempty
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="/website/advertisement" class="uppercase">Összes megtekintése</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Nemrég hozzáadott vélemények</h3>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                              </button>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-1">
                          <ul class="products-list product-list-in-card pl-2 pr-2">
                              @foreach ($lastreviews as $lastreview)
                                  <li class="item">
                                    <div class="product-img">
                                     <label>{{$lastreview->user_id}}</label>
                                    </div>
                                      <div class="product-info">
                                          <a href="/website/velemeny"
                                              class="product-title">{{ $lastreview->stars }}</a> db csillag 
                                      </div>
                                  </li>
                      @endforeach
                      @empty($lastreviews)
                          <span>Nincs vélemény!</span>
                      @endempty
                      </ul>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                      <a href="/website/velemeny" class="uppercase">Összes megtekintése</a>
                  </div>
                  <!-- /.card-footer -->
              </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection('content')
