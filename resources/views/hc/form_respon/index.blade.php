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
                                Data GForm Respon

                                <div class="card-tools row">
                                    <div class="col">
                                        <form action="{{ route('response/calculate') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">
                                                <i class="fas fa-calculator fa-fw"></i> Hitung
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modelId">
                                            <i class="fas fa-upload fa-fw"></i> Impor</a>
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive px-4">
                                    <table class="table" id="dataTables">
                                        <thead>

                                            <tr>
                                                <th rowspan="3">#</th>
                                                <th rowspan="3">NPP Dinilai</th>
                                                <th rowspan="3">Level</th>
                                                <th rowspan="3">Nama Dinilai</th>
                                                <th colspan="{{ 4 * 6 }}" class="text-center">Kepemimpinan</th>
                                                <th colspan="{{ 4 * 5 }}" class="text-center">Nilai Perusahaan &
                                                    Perilaku</th>
                                                <th colspan="{{ 4 * 5 }}" class="text-center">Tugas Sasaran Kinerja
                                                    & Profesi</th>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-center">Strategi Perencanaan</th>
                                                <th colspan="4" class="text-center">Strategi Pengawasan</th>
                                                <th colspan="4" class="text-center">Strategi Inovasi</th>
                                                <th colspan="4" class="text-center">Kepemimpinan</th>
                                                <th colspan="4" class="text-center">Membimbing dan Membangun</th>
                                                <th colspan="4" class="text-center">Pengambilan Keputusan</th>

                                                <th colspan="4" class="text-center">Kerjasama</th>
                                                <th colspan="4" class="text-center">Komunikasi</th>
                                                <th colspan="4" class="text-center">Disiplin & Kehadiran</th>
                                                <th colspan="4" class="text-center">Dedikasi & Integritas</th>
                                                <th colspan="4" class="text-center">Etika</th>

                                                <th colspan="4" class="text-center">Goal Pencapaian</th>
                                                <th colspan="4" class="text-center">Error Pencapaian</th>
                                                <th colspan="4" class="text-center">Proses - Pencapaian Kinerja ( Dokumen
                                                    )</th>
                                                <th colspan="4" class="text-center">Proses - Pencapaian Kinerja (
                                                    Inisiatif )</th>
                                                <th colspan="4" class="text-center">Proses - Pencapaian Kinerja ( Pola
                                                    Pikir )</th>
                                            </tr>
                                            <tr>
                                                @for ($i = 0; $i < 16; $i++)
                                                    <th>Self</th>
                                                    <th>Atasan</th>
                                                    <th>Rekan</th>
                                                    <th>Staff</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($responseMap as $rK => $rV)
                                                <tr>
                                                    <td>
                                                        <a name="" id="" class="btn btn-primary"
                                                            href="{{ route('response/detail', $rV['npp_dinilai']) }}"
                                                            role="button"><i class="fas fa-info-circle"></i></a>
                                                    </td>
                                                    <td>{{ $rV['npp_dinilai'] }}</td>
                                                    <td>{{ $rV['level_dinilai'] }}</td>
                                                    <td>{{ $rV['nama_dinilai'] }}</td>

                                                    @foreach ($rV['kepemimpinan']['perencanaan'] as $kpmnPr)
                                                        <td>{{ $kpmnPr }}</td>
                                                    @endforeach
                                                    @foreach ($rV['kepemimpinan']['pengawasan'] as $kpmnPn)
                                                        <td>{{ $kpmnPn }}</td>
                                                    @endforeach
                                                    @foreach ($rV['kepemimpinan']['inovasi'] as $kpmnIv)
                                                        <td>{{ $kpmnIv }}</td>
                                                    @endforeach
                                                    @foreach ($rV['kepemimpinan']['kepemimpinan'] as $kpmnKp)
                                                        <td>{{ $kpmnKp }}</td>
                                                    @endforeach
                                                    @foreach ($rV['kepemimpinan']['membimbing'] as $kpmnMb)
                                                        <td>{{ $kpmnMb }}</td>
                                                    @endforeach
                                                    @foreach ($rV['kepemimpinan']['keputusan'] as $kpmnKt)
                                                        <td>{{ $kpmnKt }}</td>
                                                    @endforeach

                                                    @foreach ($rV['nilai_perusahaan']['kerjasama'] as $nnppKs)
                                                        <td>{{ $nnppKs }}</td>
                                                    @endforeach
                                                    @foreach ($rV['nilai_perusahaan']['komunikasi'] as $nnppKk)
                                                        <td>{{ $nnppKk }}</td>
                                                    @endforeach
                                                    @foreach ($rV['nilai_perusahaan']['disiplin'] as $nnppDp)
                                                        <td>{{ $nnppDp }}</td>
                                                    @endforeach
                                                    @foreach ($rV['nilai_perusahaan']['dedikasi'] as $nnppDk)
                                                        <td>{{ $nnppDk }}</td>
                                                    @endforeach
                                                    @foreach ($rV['nilai_perusahaan']['etika'] as $nnppEk)
                                                        <td>{{ $nnppEk }}</td>
                                                    @endforeach

                                                    @foreach ($rV['sasaran_kerja']['goal'] as $skppGl)
                                                        <td>{{ $skppGl }}</td>
                                                    @endforeach
                                                    @foreach ($rV['sasaran_kerja']['error'] as $skppEr)
                                                        <td>{{ $skppEr }}</td>
                                                    @endforeach
                                                    @foreach ($rV['sasaran_kerja']['dokumen'] as $skppDm)
                                                        <td>{{ $skppDm }}</td>
                                                    @endforeach
                                                    @foreach ($rV['sasaran_kerja']['inisiatif'] as $skppIt)
                                                        <td>{{ $skppIt }}</td>
                                                    @endforeach
                                                    @foreach ($rV['sasaran_kerja']['pola_pikir'] as $skppPp)
                                                        <td>{{ $skppPp }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Data DP3

                            </div>
                            <div class="card-body ">
                                <div class="table-responsive px-4">
                                    <table class="table" id="dataTables2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NPP Dinilai</th>
                                                <th>Nama Dinilai</th>
                                                <th>Level Dinilai</th>
                                                <th>Skor DP3</th>
                                                <th>Kriteria </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dp3Calculated as $dp3)
                                                <tr>
                                                    <td>
                                                        <a name="" id="" class="btn btn-primary"
                                                            href="{{ route('response/detail', $dp3['npp_dinilai']) }}"
                                                            role="button"><i class="fas fa-info-circle"></i></a>
                                                    </td>
                                                    <td>{{ $dp3->npp_dinilai }}</td>
                                                    <td>{{ $dp3->nama_dinilai }}</td>
                                                    <td>{{ $dp3->level_dinilai }}</td>
                                                    <td>{{ $dp3->total_nilai }}</td>
                                                    <td>{{ $dp3->kriteria }}</td>
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



    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('response/import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file_respon">File Respon</label>
                            <input type="file" class="form-control @error('file_response') is-invalid @enderror"
                                name="file_respon" id="file_respon">
                            @error('file_respon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
