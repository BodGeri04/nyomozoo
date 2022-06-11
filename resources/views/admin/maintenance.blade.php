@extends('admin.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-heading">
            <section class="section">
                <div class="card">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h3 class="card-title">Karbantartási mód</h3>
                        </div>
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="col-md-2">
                                    <div>
                                        <label for="basicInput">Aktiválás</label>
                                        <input type="checkbox" name="maintenanceBtnUp" class="form-control populate">
                                        <br>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div>
                                        <label for="basicInput">Inaktiválás</label>
                                        <input type="checkbox" name="maintenanceBtnDown" class="form-control populate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" onclick="" class="btn btn-primary me-1 mb-1">Mentés</button>
                                <button onclick="location='/admin/maintenance'" type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Vissza</button>
                            </div>
                        </form>
                    </div>
            </section>
        </div>
    </div>
@endsection('content')
