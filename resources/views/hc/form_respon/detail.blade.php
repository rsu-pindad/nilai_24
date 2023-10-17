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

                                <div class="card-tools">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modelId">
                                        <i class="fas fa-plus"></i> Data
                                    </button>


                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive px-4">
                                    <table class="table" id="dataTables">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">NPP Penilai</th>
                                                <th rowspan="2">Nama Penilai</th>
                                                <th rowspan="2">Level Penilai</th>
                                                <th rowspan="2">Relasi Penilai</th>
                                                <th colspan="6" class="text-center">Kepemimpinan</th>
                                                <th colspan="5" class="text-center">Nilai Perusahaan &
                                                    Perilaku</th>
                                                <th colspan="5" class="text-center">Tugas Sasaran Kinerja
                                                    & Profesi</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Strategi Perencanaan</th>
                                                <th class="text-center">Strategi Pengawasan</th>
                                                <th class="text-center">Strategi Inovasi</th>
                                                <th class="text-center">Kepemimpinan</th>
                                                <th class="text-center">Membimbing dan Membangun</th>
                                                <th class="text-center">Pengambilan Keputusan</th>

                                                <th class="text-center">Kerjasama</th>
                                                <th class="text-center">Komunikasi</th>
                                                <th class="text-center">Disiplin & Kehadiran</th>
                                                <th class="text-center">Dedikasi & Integritas</th>
                                                <th class="text-center">Etika</th>

                                                <th class="text-center">Goal Pencapaian</th>
                                                <th class="text-center">Error Pencapaian</th>
                                                <th class="text-center">Proses - Pencapaian Kinerja ( Dokumen
                                                    )</th>
                                                <th class="text-center">Proses - Pencapaian Kinerja (
                                                    Inisiatif )</th>
                                                <th class="text-center">Proses - Pencapaian Kinerja ( Pola
                                                    Pikir )</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response as $r)
                                                <tr>
                                                    <td>
                                                        <form action="{{ route('response/detail/delete', $r->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin akan menghapus data ini?')"><i
                                                                    class="fas fa-trash-alt fa-fw"></i></button>
                                                        </form>
                                                    </td>
                                                    <td>{{ $r->npp_penilai }}</td>
                                                    <td>{{ $r->nama_penilai }}</td>
                                                    <td>{{ $r->level_penilai }}</td>
                                                    <td>{{ $r->relasi_penilai }}</td>

                                                    <td>{{ $r->kpmn_perencanaan }}</td>
                                                    <td>{{ $r->kpmn_pengawasan }}</td>
                                                    <td>{{ $r->kpmn_inovasi }}</td>
                                                    <td>{{ $r->kpmn_kepemimpinan }}</td>
                                                    <td>{{ $r->kpmn_membimbing }}</td>
                                                    <td>{{ $r->kpmn_keputusan }}</td>

                                                    <td>{{ $r->nnpp_kerjasama }}</td>
                                                    <td>{{ $r->nnpp_komunikasi }}</td>
                                                    <td>{{ $r->nnpp_disiplin }}</td>
                                                    <td>{{ $r->nnpp_dedikasi }}</td>
                                                    <td>{{ $r->nnpp_etika }}</td>

                                                    <td>{{ $r->skpp_goal }}</td>
                                                    <td>{{ $r->skpp_error }}</td>
                                                    <td>{{ $r->skpp_dokumen }}</td>
                                                    <td>{{ $r->skpp_inisiatif }}</td>
                                                    <td>{{ $r->skpp_pola_pikir }}</td>


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
                                Header
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive px-4">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="5" class="text-center text-bold">1. Kepemimpinan</td>
                                            </tr>
                                            <tr class="text-bold">
                                                <td></td>
                                                <td>Self</td>
                                                <td>Atasan</td>
                                                <td>Rekan</td>
                                                <td>Staff</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Strategi Perencanaan
                                                </td>
                                                @foreach ($result['kepemimpinan']['perencanaan'] as $kpPc)
                                                    <td>{{ $kpPc }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Strategi Pengawasan
                                                </td>
                                                @foreach ($result['kepemimpinan']['pengawasan'] as $kpPg)
                                                    <td>{{ $kpPg }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Strategi Inovasi
                                                </td>
                                                @foreach ($result['kepemimpinan']['inovasi'] as $kpIv)
                                                    <td>{{ $kpIv }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Kepemimpinan
                                                </td>
                                                @foreach ($result['kepemimpinan']['kepemimpinan'] as $kpKp)
                                                    <td>{{ $kpKp }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Membimbing & Membangun
                                                </td>
                                                @foreach ($result['kepemimpinan']['membimbing'] as $kpMb)
                                                    <td>{{ $kpMb }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Pengambilan Keputusan
                                                </td>
                                                @foreach ($result['kepemimpinan']['keputusan'] as $kpKt)
                                                    <td>{{ $kpKt }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-info">
                                                <th>Total Nilai Indikator</th>
                                                <th>{{ collect($result['kepemimpinan'])->sum('self') }}</th>
                                                <th>{{ collect($result['kepemimpinan'])->sum('atasan') }}</th>
                                                <th>{{ collect($result['kepemimpinan'])->sum('selevel') }}</th>
                                                <th>{{ collect($result['kepemimpinan'])->sum('staff') }}</th>
                                            </tr>
                                            <tr class="bg-light">
                                                <th class="text-primary">Total Nilai Kepemimpinan</th>
                                                <th class="text-primary text-center" colspan="4">
                                                    {{ collect($result['kepemimpinan'])->sum('self') +
                                                        collect($result['kepemimpinan'])->sum('atasan') +
                                                        collect($result['kepemimpinan'])->sum('selevel') +
                                                        collect($result['kepemimpinan'])->sum('staff') }}
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="5" class="text-center text-bold">2. Nilai Perusahaan &
                                                    Perilaku</td>
                                            </tr>
                                            <tr class="text-bold">
                                                <td></td>
                                                <td>Self</td>
                                                <td>Atasan</td>
                                                <td>Rekan</td>
                                                <td>Staff</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Kerjasama
                                                </td>
                                                @foreach ($result['nilai_perusahaan']['kerjasama'] as $npKs)
                                                    <td>{{ $npKs }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Komunikasi
                                                </td>
                                                @foreach ($result['nilai_perusahaan']['komunikasi'] as $npKk)
                                                    <td>{{ $npKk }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Disiplin & Kehadiran
                                                </td>
                                                @foreach ($result['nilai_perusahaan']['disiplin'] as $npDp)
                                                    <td>{{ $npDp }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Dedikasi & Integritas
                                                </td>
                                                @foreach ($result['nilai_perusahaan']['dedikasi'] as $npDd)
                                                    <td>{{ $npDd }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Etika
                                                </td>
                                                @foreach ($result['nilai_perusahaan']['etika'] as $npEt)
                                                    <td>{{ $npEt }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-info">
                                                <th>Total Nilai Indikator</th>
                                                <th>{{ collect($result['nilai_perusahaan'])->sum('self') }}</th>
                                                <th>{{ collect($result['nilai_perusahaan'])->sum('atasan') }}</th>
                                                <th>{{ collect($result['nilai_perusahaan'])->sum('selevel') }}</th>
                                                <th>{{ collect($result['nilai_perusahaan'])->sum('staff') }}</th>
                                            </tr>
                                            <tr class="bg-light">
                                                <th class="text-primary">Total Nilai Nilai Perusahaan & Prilaku</th>
                                                <th class="text-primary text-center" colspan="4">
                                                    {{ collect($result['nilai_perusahaan'])->sum('self') +
                                                        collect($result['nilai_perusahaan'])->sum('atasan') +
                                                        collect($result['nilai_perusahaan'])->sum('selevel') +
                                                        collect($result['nilai_perusahaan'])->sum('staff') }}
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="5" class="text-center text-bold">3. Tugas Sasaran Kinerja &
                                                    Profesi</td>
                                            </tr>
                                            <tr class="text-bold">
                                                <td></td>
                                                <td>Self</td>
                                                <td>Atasan</td>
                                                <td>Rekan</td>
                                                <td>Staff</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Goal Pencapaian
                                                </td>
                                                @foreach ($result['sasaran_kerja']['goal'] as $skGl)
                                                    <td>{{ $skGl }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Error Pencapaian
                                                </td>
                                                @foreach ($result['sasaran_kerja']['error'] as $skEr)
                                                    <td>{{ $skEr }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Proses - Pencapaian Kinerja ( Dokumen )
                                                </td>
                                                @foreach ($result['sasaran_kerja']['dokumen'] as $skDm)
                                                    <td>{{ $skDm }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Proses - Pencapaian Kinerja ( Inisiatif )
                                                </td>
                                                @foreach ($result['sasaran_kerja']['inisiatif'] as $skIn)
                                                    <td>{{ $skIn }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold">
                                                    Proses - Pencapaian Kinerja ( Pola Pikir )
                                                </td>
                                                @foreach ($result['sasaran_kerja']['pola_pikir'] as $skPp)
                                                    <td>{{ $skPp }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-info">
                                                <th>Total Nilai Indikator</th>
                                                <th>{{ collect($result['sasaran_kerja'])->sum('self') }}</th>
                                                <th>{{ collect($result['sasaran_kerja'])->sum('atasan') }}</th>
                                                <th>{{ collect($result['sasaran_kerja'])->sum('selevel') }}</th>
                                                <th>{{ collect($result['sasaran_kerja'])->sum('staff') }}</th>
                                            </tr>
                                            <tr class="bg-light">
                                                <th class="text-primary">Total Nilai Tugas Sasaran Kinerja & Profesi </th>
                                                <th class="text-primary text-center" colspan="4">
                                                    {{ collect($result['sasaran_kerja'])->sum('self') +
                                                        collect($result['sasaran_kerja'])->sum('atasan') +
                                                        collect($result['sasaran_kerja'])->sum('selevel') +
                                                        collect($result['sasaran_kerja'])->sum('staff') }}
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table class="table table-borderless table-success rounded">
                                        <tbody>
                                            <tr>
                                                <td>Total Penilaian Keseluruhan</td>
                                                <td>{{ $scoreDp3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kriteria</td>
                                                <td>{{ $criteria }}</td>
                                            </tr>

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
    <div class="modal fade " id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form action="{{ route('response/detail/store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="npp_dinilai" value="{{ $npp }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="npp_penilai">NPP Penilai</label>
                                    <select class="form-control selectpicker" name="npp_penilai" id="npp_penilai"
                                        data-live-search="true">
                                        <option value="">Pilih Pegawai</option>
                                        @foreach ($employee as $e)
                                            <option value="{{ $e->npp }}">
                                                {{ $e->npp . ' - ' . $e->nama . ' (' . $e->level . ') ' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <span class="text-bold text-info">Kepemimpinan :</span>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="kpmn_perencanaan">Strategi Perencanaan</label>
                                    <input type="text"
                                        class="form-control @error('kpmn_perencanaan') is-invalid @enderror"
                                        name="kpmn_perencanaan" id="kpmn_perencanaan" placeholder="0"
                                        value="{{ old('kpmn_perencanaan', 3) }}">
                                    @error('kpmn_perencanaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="kpmn_pengawasan">Strategi Pengawasan</label>
                                    <input type="text"
                                        class="form-control @error('kpmn_pengawasan') is-invalid @enderror"
                                        name="kpmn_pengawasan" id="kpmn_pengawasan" placeholder="0"
                                        value="{{ old('kpmn_pengawasan', 3) }}">
                                    @error('kpmn_pengawasan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="kpmn_inovasi">Strategi Inovasi</label>
                                    <input type="text" class="form-control @error('kpmn_inovasi') is-invalid @enderror"
                                        name="kpmn_inovasi" id="kpmn_inovasi" placeholder="0"
                                        value="{{ old('kpmn_inovasi', 3) }}">
                                    @error('kpmn_inovasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="kpmn_kepemimpinan">Kepemimpinan</label>
                                    <input type="text"
                                        class="form-control @error('kpmn_kepemimpinan') is-invalid @enderror"
                                        name="kpmn_kepemimpinan" id="kpmn_kepemimpinan" placeholder="0"
                                        value="{{ old('kpmn_kepemimpinan', 3) }}">
                                    @error('kpmn_kepemimpinan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="kpmn_membimbing">Membimbing & Membangun</label>
                                    <input type="text"
                                        class="form-control @error('kpmn_membimbing') is-invalid @enderror"
                                        name="kpmn_membimbing" id="kpmn_membimbing" placeholder="0"
                                        value="{{ old('kpmn_membimbing', 3) }}">
                                    @error('kpmn_membimbing')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="kpmn_keputusan">Pengambilan Keputusan</label>
                                    <input type="text"
                                        class="form-control @error('kpmn_keputusan') is-invalid @enderror"
                                        name="kpmn_keputusan" id="kpmn_keputusan" placeholder="0"
                                        value="{{ old('kpmn_keputusan', 3) }}">
                                    @error('kpmn_keputusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <span class="text-bold text-info">Nilai Perusahaan & Perilaku :</span>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nnpp_kerjasama">Kerjasama</label>
                                    <input type="text"
                                        class="form-control @error('nnpp_kerjasama') is-invalid @enderror"
                                        name="nnpp_kerjasama" id="nnpp_kerjasama" placeholder="0"
                                        value="{{ old('nnpp_kerjasama', 3) }}">
                                    @error('nnpp_kerjasama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nnpp_komunikasi">Komunikasi</label>
                                    <input type="text"
                                        class="form-control @error('nnpp_komunikasi') is-invalid @enderror"
                                        name="nnpp_komunikasi" id="nnpp_komunikasi" placeholder="0"
                                        value="{{ old('nnpp_komunikasi', 3) }}">
                                    @error('nnpp_komunikasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nnpp_disiplin">Disiplin & Kehadiran</label>
                                    <input type="text"
                                        class="form-control @error('nnpp_disiplin') is-invalid @enderror"
                                        name="nnpp_disiplin" id="nnpp_disiplin" placeholder="0"
                                        value="{{ old('nnpp_disiplin', 3) }}">
                                    @error('nnpp_disiplin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nnpp_dedikasi">Dedikasi & Integritas</label>
                                    <input type="text"
                                        class="form-control @error('nnpp_dedikasi') is-invalid @enderror"
                                        name="nnpp_dedikasi" id="nnpp_dedikasi" placeholder="0"
                                        value="{{ old('nnpp_dedikasi', 3) }}">
                                    @error('nnpp_dedikasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nnpp_etika">Etika</label>
                                    <input type="text" class="form-control @error('nnpp_etika') is-invalid @enderror"
                                        name="nnpp_etika" id="nnpp_etika" placeholder="0"
                                        value="{{ old('nnpp_etika', 3) }}">
                                    @error('nnpp_etika')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <span class="text-bold text-info">Tugas Sasaran Kinerja & Profesi :</span>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="skpp_goal">Goal Pencapaian</label>
                                    <input type="text" class="form-control @error('skpp_goal') is-invalid @enderror"
                                        name="skpp_goal" id="skpp_goal" placeholder="0"
                                        value="{{ old('skpp_goal', 3) }}">
                                    @error('skpp_goal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="skpp_error">Error Pencapaian</label>
                                    <input type="text" class="form-control @error('skpp_error') is-invalid @enderror"
                                        name="skpp_error" id="skpp_error" placeholder="0"
                                        value="{{ old('skpp_error', 3) }}">
                                    @error('skpp_error')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="skpp_dokumen">Proses - Pencapaian Kinerja ( Dokumen )</label>
                                    <input type="text"
                                        class="form-control @error('skpp_dokumen') is-invalid @enderror"
                                        name="skpp_dokumen" id="skpp_dokumen" placeholder="0"
                                        value="{{ old('skpp_dokumen', 3) }}">
                                    @error('skpp_dokumen')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="skpp_inisiatif">Proses - Pencapaian Kinerja ( Inisiatif )</label>
                                    <input type="text"
                                        class="form-control @error('skpp_inisiatif') is-invalid @enderror"
                                        name="skpp_inisiatif" id="skpp_inisiatif" placeholder="0"
                                        value="{{ old('skpp_inisiatif', 3) }}">
                                    @error('skpp_inisiatif')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="skpp_pola_pikir">Proses - Pencapaian Kinerja ( Pola Pikir )</label>
                                    <input type="text"
                                        class="form-control @error('skpp_pola_pikir') is-invalid @enderror"
                                        name="skpp_pola_pikir" id="skpp_pola_pikir" placeholder="0"
                                        value="{{ old('skpp_pola_pikir', 3) }}">
                                    @error('skpp_pola_pikir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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
