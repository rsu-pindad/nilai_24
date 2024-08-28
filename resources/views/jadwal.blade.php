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
                                <div class="tab-content p-3">
                                    <div class="active tab-pane" id="jadwalberjalan">
                                        <div class="container">
                                            <h5>Jadwal Penilaian</h5>
                                            <div class="row">
                                                <label class="col-sm-4" for="jadwalsetting">
                                                    Dilaksanakan
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="date" id="jadwalsetting" value="{{ $jadwalberjalan['jadwal'] ?? now()}}" 
                                                    class="form-control"
                                                    disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                                <div class="tab-content p-3">
                                    <div class="active tab-pane" id="settings">
                                        <div class="container">
                                            <h5>Form Setting Jadwal Penilaian</h5>
                                            <form class="form-horizontal" action="{{ route('aturjadwal/store', Auth::user()) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group row">
                                                    <label for="jadwal" class="col-sm-4 col-form-label">Jadwal Penilaian</label>
                                                    <div class="col-sm-8">
                                                        <input type="date"
                                                            class="form-control @error('jadwal') is-invalid @enderror"
                                                            id="jadwal" name="jadwal"
                                                            value="{{ old('jadwal', date('Y-m-d')) ? old('jadwal', date('Y-m-d')) : '' }}">
                                                        @error('jadwal')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="dokumenCheck" name="dokumenCheck" @if($jadwalberjalan->lihat_dokumen == true) checked @endif>
                                                        <label class="form-check-label" for="dokumenCheck">
                                                            Perlihatkan Dokumen
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="nilaiCheck" name="nilaiCheck" @if($jadwalberjalan->lihat_skor == true) checked @endif>
                                                        <label class="form-check-label" for="nilaiCheck">
                                                            Perlihatkan Nilai
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-10 col-sm-2">
                                                        <button type="submit" class="btn btn-primary"
                                                            onclick="return confirm('Yakin anda menetapkan jadwal?')">Tetapkan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
