@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="settings">
                                        <h5>Form Setting Jadwal</h5>
                                        <form class="form-horizontal" action="{{ route('aturjadwal/store', Auth::user()) }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group row">
                                                <label for="jadwal" class="col-sm-2 col-form-label">Jadwal Penilaian</label>
                                                <div class="col-sm-10">
                                                    <input type="date"
                                                        class="form-control @error('jadwal') is-invalid @enderror"
                                                        id="jadwal" name="jadwal"
                                                        value="{{ old('jadwal') ? old('jadwal') : '' }}">
                                                    @error('jadwal')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="return confirm('Yakin anda menetapkan jadwal?')">Tetapkan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="jadwalberjalan">
                                        <h5>Jadwal Penilaian</h5>
                                        <p>
                                            Dilaksanakan : {{$jadwalberjalan['jadwal'] ?? ''}}
                                        </p>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
