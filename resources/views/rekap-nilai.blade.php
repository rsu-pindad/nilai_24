@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Nilai'}}</h1>
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
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                            <h5>Nilai Masuk</h5>
                                <table class="table table-sm table-border table-responsive">
                                    <thead>
                                        <tr>
                                            <th>&sum; Jumlah Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($nilai as $n)
                                    <tr>
                                        <td>{{$n->total}}</td>
                                    </tr>  
                                    @empty
                                    <tr>
                                        <td>maaf blm ada nilai masuk</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
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
