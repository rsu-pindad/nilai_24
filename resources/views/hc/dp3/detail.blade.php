@extends('templates.main')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title ?? 'Tabel Total Skor DP3' }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('penilai-rekap-all') }}">Kembali</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">
                      {{ $person_nilai->nama_karyawan ?? '-' }} -
                      {{ $person_nilai->npp_karyawan ?? '-' }} -
                      {{ $person_nilai->level_jabatan ?? '-' }}
                    </li>
                  </ol>
                </nav>
                <div class="btn-group p-2"
                     role="group">
                  <button class="btn btn-outline-danger">
                    <a href="{{ route('dp3-total-detail-pdf', ['dinilai' => $person_nilai->npp_karyawan]) }}"
                       class="text-muted"
                       target="_blank">PDF</a>
                  </button>
                  <button class="btn btn-outline-danger">
                    <a href="{{ route('dp3-total-detail-pdf-simple', ['dinilai' => $person_nilai->npp_karyawan]) }}"
                       class="text-muted"
                       target="_blank">PDF Simple</a>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @php
                  $atasan = 0;
                  $rekanan = 0;
                  $staff = 0;
                  $self = 0;
                  $nilai_aspek_b = 0;
                  $nilai_aspek_a = 0;
                  $nilai_aspek_c = 0;
                  $presentase_masuk = 0;
                  if (
                      Str::remove(' ', $person_nilai->level_jabatan) == 'Direksi' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IA' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IB' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IC' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IANS' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'II' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IINS' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'III' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IIINS' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IIII' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IV'
                  ) {
                      $atasan = 60;
                      $rekanan = 20;
                      $staff = 15;
                      $self = 5;
                  } else {
                      $atasan = 65;
                      $rekanan = 25;
                      $staff = 0;
                      $self = 15;
                  }
                  if (
                      Str::remove(' ', $person_nilai->level_jabatan) == 'Direksi' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IA' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IB' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IC' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IANS'
                  ) {
                      $nilai_aspek_b = 40;
                      $nilai_aspek_a = 25;
                      $nilai_aspek_c = 35;
                  } elseif (
                      Str::remove(' ', $person_nilai->level_jabatan) == 'II' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IINS'
                  ) {
                      $nilai_aspek_b = 35;
                      $nilai_aspek_a = 25;
                      $nilai_aspek_c = 40;
                  } elseif (
                      Str::remove(' ', $person_nilai->level_jabatan) == 'III' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IIINS' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IIII'
                  ) {
                      $nilai_aspek_b = 30;
                      $nilai_aspek_a = 25;
                      $nilai_aspek_c = 45;
                  } elseif (
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IV' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IVA(III)' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IVA(IIINS)' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IVA'
                  ) {
                      $nilai_aspek_b = 10;
                      $nilai_aspek_a = 30;
                      $nilai_aspek_c = 60;
                  } elseif (
                      Str::remove(' ', $person_nilai->level_jabatan) == 'IVB' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'V' ||
                      Str::remove(' ', $person_nilai->level_jabatan) == 'THL'
                  ) {
                      $nilai_aspek_b = 0;
                      $nilai_aspek_a = 35;
                      $nilai_aspek_c = 65;
                  } else {
                      $nilai_aspek_b = 0;
                      $nilai_aspek_a = 0;
                      $nilai_aspek_c = 0;
                  }
                @endphp

                @php
                  $skor = round($detail_nilai->sum('avg_nilai_dp3') * 100, 3);
                  $kriteria_skor_dp3 = '';
                  if ($skor > 95) {
                      $kriteria_skor_dp3 = 'Sangat Baik';
                  } elseif ($skor <= 95 && $skor > 85) {
                      $kriteria_skor_dp3 = 'Baik';
                  } elseif ($skor <= 85 && $skor > 65) {
                      $kriteria_skor_dp3 = 'Cukup';
                  } elseif ($skor <= 65 && $skor > 50) {
                      $kriteria_skor_dp3 = 'Kurang';
                  } else {
                      $kriteria_skor_dp3 = '-';
                  }
                @endphp

                <table id="dataTablesRekap2"
                       class="table-striped table-hover table-bordered table">
                  <thead>
                    <tr>
                      <th colspan='2'></th>

                      <th colspan='7'>Leadership (B) {{ $nilai_aspek_b }}%</th>
                      <th colspan='6'>Perilaku (A) {{ $nilai_aspek_a }}%</th>
                      <th colspan='6'>Sasaran (C) {{ $nilai_aspek_c }}%</th>
                      <th rowspan='2'>(A+B+C)</th>
                      <th rowspan='2'>Relasi</th>
                      <th rowspan='2'>Total</th>
                    </tr>
                    <tr>
                      <th>No</th>
                      <th>Respon ID</th>

                      <th>Perencanaan</th>
                      <th>Pengawasan</th>
                      <th>Inovasi</th>
                      <th>Kepemimpinaan</th>
                      <th>Membimbing</th>
                      <th>Keputusan</th>
                      <th>(B)</th>

                      <th>Kerjasama</th>
                      <th>Komunikasi</th>
                      <th>Kedisiplinan</th>
                      <th>Dedikasi</th>
                      <th>Etika</th>
                      <th>(A)</th>

                      <th>Goal</th>
                      <th>Error</th>
                      <th>Dokumentasi</th>
                      <th>Inisiatif</th>
                      <th>Pola Pikir</th>
                      <th>(C)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($detail_nilai as $p)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          @if ($p->jumlah_relasi > 1)
                            {{ $p->jumlah_relasi }} Penilai
                          @else
                            {{ $p->pool_respon_id }}
                          @endif
                        </td>

                        <td>{{ round($p->k1, 3) }}</td>
                        <td>{{ round($p->k2, 3) }}</td>
                        <td>{{ round($p->k3, 3) }}</td>
                        <td>{{ round($p->k4, 3) }}</td>
                        <td>{{ round($p->k5, 3) }}</td>
                        <td>{{ round($p->k6, 3) }}</td>
                        <td><b>{{ round($p->tk, 3) }}</b></td>

                        <td>{{ round($p->p1, 3) }}</td>
                        <td>{{ round($p->p2, 3) }}</td>
                        <td>{{ round($p->p3, 3) }}</td>
                        <td>{{ round($p->p4, 3) }}</td>
                        <td>{{ round($p->p5, 3) }}</td>
                        <td><b>{{ round($p->tp, 3) }}</b></td>

                        <td>{{ round($p->s1, 3) }}</td>
                        <td>{{ round($p->s2, 3) }}</td>
                        <td>{{ round($p->s3, 3) }}</td>
                        <td>{{ round($p->s4, 3) }}</td>
                        <td>{{ round($p->s5, 3) }}</td>
                        <td><b>{{ round($p->ts, 3) }}</b></td>

                        <td><b>{{ round($p->tk + $p->tp + $p->ts, 3) }}</b></td>

                        @if (Str::remove(' ', $p->relasi) == 'atasan')
                          @php
                            $presentase_masuk += $atasan;
                          @endphp
                          <td>
                            (<b>{{ $atasan }}%</b>)
                            <br />
                            <a href="/penilai-rekap/detail?dinilai={{ $p->npp_dinilai }}&relasi=atasan&penilai={{ $p->identitas_penilai->id }}"
                               target="_blank">{{ $p->relasi }}</a>
                          </td>
                        @elseif(Str::remove(' ', $p->relasi) == 'rekanan')
                          @php
                            $presentase_masuk += $rekanan;
                          @endphp
                          <td>
                            (<b>{{ $rekanan }}%</b>)
                            <br />
                            <a href="/penilai-rekap/detail?dinilai={{ $p->npp_dinilai }}&relasi=rekanan&penilai={{ $p->identitas_penilai->id }}"
                               target="_blank">{{ $p->relasi }}</a>
                          </td>
                        @elseif(Str::remove(' ', $p->relasi) == 'staff')
                          @php
                            $presentase_masuk += $staff;
                          @endphp
                          <td>(<b>{{ $staff }}%</b>) {{ $p->relasi }}
                          </td>
                        @elseif(Str::remove(' ', $p->relasi) == 'self')
                          @php
                            $presentase_masuk += $self;
                          @endphp
                          <td>(<b>{{ $self }}%</b>)
                            <br />
                            <a href="/penilai-rekap/detail?dinilai={{ $p->npp_dinilai }}&relasi=self&penilai={{ $p->identitas_penilai->id }}"
                               target="_blank">{{ $p->relasi }}</a>
                          </td>
                        @else
                          <td>Tidak Masuk</td>
                        @endif

                        <td><b>{{ round($p->avg_nilai_dp3, 3) }}</b></td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-gradient-light">
                      <td colspan='2'
                          class='text-dark text-right'>Skor Akhir</td>

                      <td>{{ round($detail_nilai->avg('k1'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('k2'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('k3'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('k4'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('k5'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('k6'), 3) }}</td>
                      <td><b>{{ round($detail_nilai->avg('tk'), 3) }}</b></td>

                      <td>{{ round($detail_nilai->avg('p1'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('p2'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('p3'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('p4'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('p5'), 3) }}</td>
                      <td><b>{{ round($detail_nilai->avg('tp'), 3) }}</b></td>

                      <td>{{ round($detail_nilai->avg('s1'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('s2'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('s3'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('s4'), 3) }}</td>
                      <td>{{ round($detail_nilai->avg('s5'), 3) }}</td>
                      <td><b>{{ round($detail_nilai->avg('ts'), 3) }}</b></td>

                      <td>
                        <b>{{ round($detail_nilai->avg('tk') + $detail_nilai->avg('tp') + $detail_nilai->avg('ts'), 3) }}</b>
                      </td>
                      {{-- <td>{{$nilai_aspek_b + $nilai_aspek_a + $nilai_aspek_c}}%</td> --}}
                      <td>{{ $presentase_masuk }}%</td>
                      <td class="text-dark"><b>{{ round($detail_nilai->sum('avg_nilai_dp3'), 3) }}</b></td>
                    </tr>
                    <tr>
                      <td colspan="2"
                          class="text-right">
                        Kriteria Skor
                      </td>
                      <td colspan="19"
                          class="bg-gradient-light"></td>
                      <td></td>
                      <td>
                        {{ $kriteria_skor_dp3 }}
                      </td>
                      <td>
                        {{ $skor }}
                      </td>
                    </tr>
                  </tfoot>
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

@pushOnce('styles')
  <link rel="stylesheet"
        href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endPushOnce

@pushOnce('scripts')
  <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    var table = $("#dataTablesRekap2").DataTable({
      // layout: {
      //     topStart: {
      //         buttons: [{
      //             extend: 'pdfHtml5'
      //             , text: 'Save current page'
      //             , exportOptions: {
      //                 modifier: {
      //                     page: 'current'
      //                 }
      //             }
      //         }]
      //     }
      // }
      fixedColumns: {
        start: 2,
        end: 3
      }
      // , fixedHeader: {
      //     header: true
      //     , footer: true
      // }
      ,
      ordering: false,
      scrollCollapse: true,
      searching: false,
      scrollX: false,
      scrollY: '50vh',
      lengthChange: false,
      paging: false,
      info: false,
    });
  </script>
@endPushOnce
