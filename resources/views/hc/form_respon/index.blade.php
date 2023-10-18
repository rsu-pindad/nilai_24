@extends('templates.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $page }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Header
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive px-4">
                                    <table class="table" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th>NPP Dinilai</th>
                                                <th>Level Dinilai</th>
                                                <th>Nama Dinilai</th>
                                                <th>Skor DP3</th>
                                                <th>Kriteria </th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dp3Calculated as $dp3)
                                                <tr>
                                                    <td>{{ $dp3->npp_dinilai }}</td>
                                                    <td>{{ $dp3->nama_dinilai }}</td>
                                                    <td>{{ $dp3->level_dinilai }}</td>
                                                    <td>{{ $dp3->total_nilai }}</td>
                                                    <td>{{ $dp3->kriteria }}</td>
                                                    <td>
                                                        <a name="" id="" class="btn btn-primary"
                                                            href="{{ route('response/detail', $dp3['npp_dinilai']) }}"
                                                            role="button"><i class="fas fa-info-circle"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
