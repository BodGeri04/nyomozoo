@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Visszajelzések</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="name" class="form-control float-right" placeholder="Keresés">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            @include('admin.messages')
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-dark">
                    <thead>
                        <tr>
                            <th>Felhasználó ID</th>
                            <th>Adott csillagok száma</th>
                            <th>Vélemény leírása</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedback as $feedback)
                            <tr id="tr-{{ $feedback->id }}">
                                <td><a href="/admin/user/{{ $feedback->user_id }}/edit">{{$feedback->user_id}}</td>
                                <td>{{ $feedback->stars }}</td>
                                <td>{{ $feedback->feedback_description }}</td>
                                <td class="text-right"><button
                                        onclick="window.deleteConfirm('Biztos törölni szeretnéd a(z){{ $feedback->id }}. véleményt?', '{!! route('velemeny.destroy', $feedback->id) !!}', 'tr-{{ $feedback->id }}')"
                                        type="button" class="mb-1 mt-1 mr-1 btn btn-danger">Törlés</button></td>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                    @empty($feedback)
                        <tbody>
                            <td class="text-center">Jelenleg nincs egy vélemény sem beregisztrálva.
                            </td>
                        </tbody>
                    @endempty
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection('content')
