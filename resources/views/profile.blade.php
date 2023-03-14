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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td scope="row">NPP</td>
                                            <td>{{ Auth::user()->npp }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Nama</td>
                                            <td>{{ Auth::user()->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Penempatan</td>
                                            <td>{{ Auth::user()->penempatan }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Jabatan</td>
                                            <td>{{ Auth::user()->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Level</td>
                                            <td>{{ Auth::user()->level }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ./card-body -->
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
@endsection
