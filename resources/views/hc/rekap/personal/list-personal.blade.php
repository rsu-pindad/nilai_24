<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Personal {{$detail_data->identitas_dinilai->npp_karyawan}} - {{$detail_data->identitas_dinilai->nama_karyawan ?? ''}}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">

        <link rel="icon" href="{{asset('/dist/img/logo.png')}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{asset('/dist/img/logo.png')}}" type="image/x-icon">

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{asset('/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('/dist/js/adminlte.js')}}"></script>

</head>
<body>
@php
use Carbon\Carbon;
@endphp
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="#" class="brand-link text-muted">
                    <img src="{{asset('/dist/img/logo.png')}}" alt="Logo" class="brand-image img-circle">
                    Hasil Personal - {{$detail_data->identitas_dinilai->npp_karyawan}} - {{$detail_data->identitas_dinilai->nama_karyawan ?? ''}}
                </a>
            </div>
            <div class="card-body">
                @php
                    $jabatan = $detail_data->identitas_dinilai->level_jabatan;
                    if($jabatan == 'IA' || $jabatan == 'IC')
                    {
                        $ket1 = '25%';
                        $ket2 = '25%';
                        $ket3 = '50%';
                    }
                    elseif($jabatan == 'II' || $jabatan == 'IINS')
                    {
                        $ket1 = '25%';
                        $ket2 = '30%';
                        $ket3 = '45%';
                    }
                    else if($jabatan == 'III')
                    {
                        $ket1 = '25%';
                        $ket2 = '35%';
                        $ket3 = '45%';
                    }
                    else if($jabatan == 'IVA')
                    {
                        $ket1 = '30%';
                        $ket2 = '60%';
                        $ket3 = '10%';
                    }
                    else
                    {
                        $ket1 = '35%';
                        $ket2 = '65%';
                        $ket3 = '0%';
                    }
                @endphp
                <table class="table table-sm table-responsive table-striped table-bordered table-hover" id="tableDetailPersonal">
                    <thead>
                        <tr>
                            <th colspan="5">Penilaian Kinerja</th>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td rowspan="3" id="head-nama-dinilai" colspan="2">
                                {{$detail_data->identitas_dinilai->nama_karyawan}}
                            </td>
                            <td>Npp</td>
                            <td id="head-npp-dinilai">
                                {{$detail_data->identitas_dinilai->npp_karyawan}}
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td id="head-jabatan-dinilai" colspan="2">
                                {{$detail_data->identitas_dinilai->level_jabatan}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-wrap">Unit Kerja</td>
                            <td id="head-unit-dinilai" colspan="2">
                                {{$detail_data->identitas_dinilai->unit_jabatan}}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="5">Penilai</th>
                        </tr>
                        <tr>
                            <td colspan="2">Nama</td>
                            <td colspan="2">Npp</td>
                            <td>Status</td>
                        </tr>
                        <tr id="penilai_atasan">
                            <td colspan="2">{{$atasan->nama_karyawan}}</td>
                            <td colspan="2">{{$atasan->npp_karyawan}}</td>
                            <td></td>
                        </tr>
                        <tr id="penilai_selevel">
                            <td colspan="2">{{$rekan->nama_karyawan}}</td>
                            <td colspan="2">{{$rekan->npp_karyawan}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">{{$staff->nama_karyawan ?? ''}}</td>
                            <td colspan="2">{{$staff->npp_karyawan ?? ''}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th rowspan="2">Komponen Penilaian Kinerja</th>
                            <td>Bobot</td>
                            <td rowspan="2">Penilaian</td>
                            <td rowspan="2">Nilai</td>
                            <td rowspan="2">Total Nilai</td>
                        </tr>
                        <tr>
                            <td>Keterangan Pencapaian</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td id="ket_kp_1">a ({{$ket1}})</td>
                            <td>b</td>
                            <td>c</td>
                            <td>d</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="7">1.Nilai - Nilai Perusahaan Dan Perilaku</td>
                            <td></td>
                            <td>1-25</td>
                            <td>(b/25)x a</td>
                            <td>(c)x 100</td>
                        </tr>
                        <tr>
                            <td>Kerjasama</td>
                            <td id="pp1">{{$detail_data->p_avg_1}}</td>
                            <td id="ppm1">{{$detail_data->mutator_p_avg_1}}</td>
                            <td id="pp1_sum" class="ppm">{{round($detail_data->mutator_p_avg_1 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Komunikasi</td>
                            <td id="pp2">{{$detail_data->p_avg_2}}</td>
                            <td id="ppm2">{{$detail_data->mutator_p_avg_2}}</td>
                            <td id="pp2_sum" class="ppm">{{round($detail_data->mutator_p_avg_2 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Disiplin dan Kehadiran / Absensi</td>
                            <td id="pp3">{{$detail_data->p_avg_3}}</td>
                            <td id="ppm3">{{$detail_data->mutator_p_avg_3}}</td>
                            <td id="pp3_sum" class="ppm">{{round($detail_data->mutator_p_avg_3 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Dedikasi dan Integritas</td>
                            <td id="pp4">{{$detail_data->p_avg_4}}</td>
                            <td id="ppm4">{{$detail_data->mutator_p_avg_4}}</td>
                            <td id="pp4_sum" class="ppm">{{round($detail_data->mutator_p_avg_4 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Etika</td>
                            <td id="pp5">{{$detail_data->p_avg_5}}</td>
                            <td id="ppm5">{{$detail_data->mutator_p_avg_5}}</td>
                            <td id="pp5_sum" class="ppm">{{round($detail_data->mutator_p_avg_5 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td id="sum_p_total" class="totalNilai">
                                {{round(
                                    (
                                    $detail_data->mutator_p_avg_1 +
                                    $detail_data->mutator_p_avg_2 +
                                    $detail_data->mutator_p_avg_3 +
                                    $detail_data->mutator_p_avg_4 +
                                    $detail_data->mutator_p_avg_5
                                    ) * 100
                                    ,2)}}
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="8">2.Tugas Utama, Sasaran Kinerja Dan Pengembangan Profesi</td>
                            <td></td>
                            <td>1-25</td>
                            <td>(b/25)x a</td>
                            <td>(c)x 100</td>
                        </tr>
                        <tr>
                            <td id="ket_kp_2">a ({{$ket2}})</td>
                            <td>b</td>
                            <td>c</td>
                            <td>d</td>
                        </tr>
                        <tr>
                            <td>Goal - Pencapaian Kinerja</td>
                            <td id="sp1">{{$detail_data->s_avg_1}}</td>
                            <td id="spm1">{{$detail_data->mutator_s_avg_1}}</td>
                            <td id="sp1_sum" class="spm">{{round($detail_data->mutator_s_avg_1 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Error - Pencapaian Kinerja</td>
                            <td id="sp2">{{$detail_data->s_avg_2}}</td>
                            <td id="spm2">{{$detail_data->mutator_s_avg_2}}</td>
                            <td id="sp2_sum" class="spm">{{round($detail_data->mutator_s_avg_2 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Proses - Pencapaian Kinerja (Dokumen)</td>
                            <td id="sp3">{{$detail_data->s_avg_3}}</td>
                            <td id="spm3">{{$detail_data->mutator_s_avg_3}}</td>
                            <td id="sp3_sum" class="spm">{{round($detail_data->mutator_s_avg_3 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Proses - Pencapaian Kinerja (Inisiatif)</td>
                            <td id="sp4">{{$detail_data->s_avg_4}}</td>
                            <td id="spm4">{{$detail_data->mutator_s_avg_4}}</td>
                            <td id="sp4_sum" class="spm">{{round($detail_data->mutator_s_avg_4 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Proses - Pencapaian Kinerja (Pola Pikir)</td>
                            <td id="sp5">{{$detail_data->s_avg_5}}</td>
                            <td id="spm5">{{$detail_data->mutator_s_avg_5}}</td>
                            <td id="sp5_sum" class="spm">{{round($detail_data->mutator_s_avg_5 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td id="sum_s_total" class="totalNilai">
                            {{round(
                                    (
                                    $detail_data->mutator_s_avg_1 +
                                    $detail_data->mutator_s_avg_2 +
                                    $detail_data->mutator_s_avg_3 +
                                    $detail_data->mutator_s_avg_4 +
                                    $detail_data->mutator_s_avg_5
                                    ) * 100,2)}}
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="10">3.Kepemimpinan, Kompetensi Dan Pengembangan Profesi</td>
                            <td></td>
                            <td>1-30</td>
                            <td>(b/30)x a</td>
                            <td>(c)x 100</td>
                        </tr>
                        <tr>
                            <td id="ket_kp_3">a ({{$ket3}})</td>
                            <td>b</td>
                            <td>c</td>
                            <td>d</td>
                        </tr>
                        <tr>
                            <td>Strategi - Perencanaan</td>
                            <td id="kp1">{{$detail_data->k_avg_1}}</td>
                            <td id="kpm1">{{$detail_data->mutator_k_avg_1}}</td>
                            <td id="kp1_sum" class="kpm">{{round($detail_data->mutator_k_avg_1 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Strategi - Pengawasan</td>
                            <td id="kp2">{{$detail_data->k_avg_2}}</td>
                            <td id="kpm2">{{$detail_data->mutator_k_avg_2}}</td>
                            <td id="kp2_sum" class="kpm">{{round($detail_data->mutator_k_avg_2 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Strategi - Inovasi</td>
                            <td id="kp3">{{$detail_data->k_avg_3}}</td>
                            <td id="kpm3">{{$detail_data->mutator_k_avg_3}}</td>
                            <td id="kp3_sum" class="kpm">{{round($detail_data->mutator_k_avg_3 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Kepemimpinan</td>
                            <td id="kp4">{{$detail_data->k_avg_4}}</td>
                            <td id="kpm4">{{$detail_data->mutator_k_avg_4}}</td>
                            <td id="kp4_sum" class="kpm">{{round($detail_data->mutator_k_avg_4 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Membimbingan dan Membangun</td>
                            <td id="kp5">{{$detail_data->k_avg_5}}</td>
                            <td id="kpm5">{{$detail_data->mutator_k_avg_5}}</td>
                            <td id="kp5_sum" class="kpm">{{round($detail_data->mutator_k_avg_5 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td>Pengambilan keputusan</td>
                            <td id="kp6">{{$detail_data->k_avg_6}}</td>
                            <td id="kpm6">{{$detail_data->mutator_k_avg_6}}</td>
                            <td id="kp6_sum" class="kpm">{{round($detail_data->mutator_k_avg_6 * 100,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td id="sum_k_total" class="totalNilai">
                            {{round(
                                    ($detail_data->mutator_k_avg_1 +
                                    $detail_data->mutator_k_avg_2 +
                                    $detail_data->mutator_k_avg_3 +
                                    $detail_data->mutator_k_avg_4 +
                                    $detail_data->mutator_k_avg_5 +
                                    $detail_data->mutator_k_avg_6) * 100
                                    ,2)}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Jumlah</td>
                            <td id="totalSumNilai">
                            @php
                                $sasaran = round(
                                    (
                                    $detail_data->mutator_s_avg_1 +
                                    $detail_data->mutator_s_avg_2 +
                                    $detail_data->mutator_s_avg_3 +
                                    $detail_data->mutator_s_avg_4 +
                                    $detail_data->mutator_s_avg_5
                                    ) * 100,2);
                                $perilaku = round(
                                    (
                                    $detail_data->mutator_p_avg_1 +
                                    $detail_data->mutator_p_avg_2 +
                                    $detail_data->mutator_p_avg_3 +
                                    $detail_data->mutator_p_avg_4 +
                                    $detail_data->mutator_p_avg_5
                                    ) * 100,2);
                                $kepemimpinaan = round(
                                    (
                                    $detail_data->mutator_k_avg_1 +
                                    $detail_data->mutator_k_avg_2 +
                                    $detail_data->mutator_k_avg_3 +
                                    $detail_data->mutator_k_avg_4 +
                                    $detail_data->mutator_k_avg_5 +
                                    $detail_data->mutator_k_avg_6
                                    ) * 100,2);
                                $total_pm = $detail_data->sum_rekap_self +
                                $detail_data->sum_rekap_atasan +
                                $detail_data->sum_rekap_rekan +
                                $detail_data->sum_rekap_staff;
                                /**
                                $detail_data->$sum_rekap_self + 
                                $detail_data->$sum_rekap_atasan + 
                                $detail_data->$sum_rekap_rekan + 
                                $detail_data->$sum_rekap_sstaff) * 10;
                                 */
                            @endphp
                            {{$total_pm}}
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <th colspan="4">Catatan / Rekomendasi (Pegawai, Pejabat Penilai, Atasan Pejabat Penilai, SDM)</th>
                        </tr>
                        <tr>
                            <td id="keterangan">
                            @php
                            if($total_pm > 94)
                            {
                                $kriteria = 'Sangat Baik';
                            }
                            elseif($total_pm <= 94 && $total_pm > 80)
                            {
                                $kriteria = 'Baik';
                            }
                            elseif($total_pm <= 80 && $total_pm > 65)
                            {
                                $kriteria = 'Cukup';
                            }
                            elseif($total_pm <= 65 && $total_pm > 50)
                            {
                                $kriteria = 'Kurang';
                            }
                            else
                            {
                                $kriteria = 'Sangat Kurang';
                            }
                            @endphp
                            {{$kriteria}}
                            </td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td>{{Carbon::now()->format('Y/m/d')}}</td>
                            <td colspan="2">{{Carbon::now()->format('Y/m/d')}}</td>
                            <td colspan="2">{{Carbon::now()->format('Y/m/d')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>