@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekapitulasi Nilai Masuk' }}</h1>
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
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>Nilai masuk</br> skor akhir </br>DP3</th>
                                            <th>Dokumen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                @if ($lihatSkor->lihat_skor != false)
                                                <td>{{ $nilai }}</td>
                                                @else
                                                <td>SDM menutup akses...</td>
                                                @endif
                                                @if ($lihatDokumen->lihat_dokumen != false)
                                                <td class="px-2">
                                                    <div class="btn-toolbar d-flex justify-content-around" role="toolbar"
                                                        arua-label="grup satu">
                                                        <div class="btn-group mr-2" role="group" aria-label="group aksi">
                                                            <a href="/nilai-rekap/documen/report?id={{ $id }}&npp={{ $npp_karyawan }}"
                                                                target="_blank" class="btn btn-sm btn-danger">
                                                                <i class="far fa-file-pdf"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                @else
                                                <td>SDM menutup akses...</td>
                                                @endif
                                            </tr>
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
