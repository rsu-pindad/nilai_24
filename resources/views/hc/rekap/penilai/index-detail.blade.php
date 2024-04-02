<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Personal {{$data_penilai->relasi_karyawan->npp_karyawan}} - {{$data_penilai->relasi_karyawan->nama_karyawan ?? ''}}
    </title>

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
<body class="layout-boxed">
@php
use Carbon\Carbon;
@endphp
    <div class="wrapper">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="#" class="brand-link text-muted">
                        <img src="{{asset('/dist/img/logo.png')}}" alt="Logo" class="brand-image img-circle">
                        @isset($marks)
                        Hasil Personal - {{$data_penilai->relasi_karyawan->npp_karyawan ?? ''}} - {{$data_penilai->relasi_karyawan->nama_karyawan ?? ''}}
                        @else
                        Staff
                        @endisset
                    </a>
                </div>
                <div class="card-body">
                    @php
                        $jabatan = $data_penilai->jabatan_dinilai;
                        $relasi = $data_penilai->relasi;
                        if($jabatan == 'IA' || $jabatan == 'IC' || $jabatan == 'I A' || $jabatan == 'I C')
                        {
                            $ket1 = '25%';
                            $ket2 = '25%';
                            $ket3 = '50%';

                            $penilai_atasan = '60%';
                            $penilai_rekanan = '20%';
                            $penilai_staff = '15%';
                            $penilai_self = '5%';
                        }
                        elseif($jabatan == 'II' || $jabatan == 'IINS' || $jabatan == 'II NS')
                        {
                            $ket1 = '25%';
                            $ket2 = '30%';
                            $ket3 = '45%';

                            $penilai_atasan = '60%';
                            $penilai_rekanan = '20%';
                            $penilai_staff = '15%';
                            $penilai_self = '5%';
                        }
                        else if($jabatan == 'III')
                        {
                            $ket1 = '25%';
                            $ket2 = '35%';
                            $ket3 = '45%';

                            $penilai_atasan = '60%';
                            $penilai_rekanan = '20%';
                            $penilai_staff = '15%';
                            $penilai_self = '5%';
                        }
                        else if($jabatan == 'IVA' || $jabatan == 'IV A')
                        {
                            $ket1 = '30%';
                            $ket2 = '60%';
                            $ket3 = '10%';

                            $penilai_atasan = '60%';
                            $penilai_rekanan = '20%';
                            $penilai_staff = '15%';
                            $penilai_self = '5%';
                        }
                        else
                        {
                            $ket1 = '35%';
                            $ket2 = '65%';
                            $ket3 = '0%';

                            $penilai_atasan = '65%';
                            $penilai_rekanan = '25%';
                            $penilai_staff = '0%';
                            $penilai_self = '10%';
                        }
                        if($relasi == 'self'){
                            $bobot_penilai = $penilai_self;
                        }
                        elseif($relasi == 'atasan'){
                            $bobot_penilai = $penilai_atasan;
                        }
                        elseif($relasi == 'rekanan'){
                            $bobot_penilai = $penilai_rekanan;
                        }
                        elseif($relasi == 'staff'){
                            $bobot_penilai = $penilai_staff;
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
                                    {{$data_penilai->identitas_dinilai->nama_karyawan}}
                                </td>
                                <td>Npp</td>
                                <td id="head-npp-dinilai">
                                    {{$data_penilai->identitas_dinilai->npp_karyawan}}
                                </td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td id="head-jabatan-dinilai" colspan="2">
                                    {{$data_penilai->identitas_dinilai->level_jabatan}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-wrap">Unit Kerja</td>
                                <td id="head-unit-dinilai" colspan="2">
                                    {{$data_penilai->identitas_dinilai->unit_jabatan}}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="5">Penilai</th>
                            </tr>
                            <tr>
                                <td colspan="2">Nama</td>
                                <td colspan="3">Npp</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{$data_penilai->relasi_karyawan->nama_karyawan}}</td>
                                <td colspan="3">{{$data_penilai->relasi_karyawan->npp_karyawan}}</td>
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
                                <td>1-5</td>
                                <td>(b/25)x a</td>
                                <td>(c)x 100</td>
                            </tr>
                            <tr>
                                <td>Kerjasama</td>
                                <td id="pp1">{{$data_penilai->relasi_respon->kerjasama}}</td>
                                <td id="ppm1">{{round($data_penilai->kerjasama_bobot_aspek,3)}}</td>
                                <td id="pp1_sum" class="ppm">{{round($data_penilai->kerjasama_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Komunikasi</td>
                                <td id="pp2">{{$data_penilai->relasi_respon->komunikasi}}</td>
                                <td id="ppm2">{{$data_penilai->komunikasi_bobot_aspek}}</td>
                                <td id="pp2_sum" class="ppm">{{round($data_penilai->komunikasi_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Disiplin dan Kehadiran / Absensi</td>
                                <td id="pp3">{{$data_penilai->relasi_respon->absensi}}</td>
                                <td id="ppm3">{{$data_penilai->absensi_bobot_aspek}}</td>
                                <td id="pp3_sum" class="ppm">{{round($data_penilai->absensi_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Dedikasi dan Integritas</td>
                                <td id="pp4">{{$data_penilai->relasi_respon->integritas}}</td>
                                <td id="ppm4">{{$data_penilai->integritas_bobot_aspek}}</td>
                                <td id="pp4_sum" class="ppm">{{round($data_penilai->integritas_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Etika</td>
                                <td id="pp5">{{$data_penilai->relasi_respon->etika}}</td>
                                <td id="ppm5">{{$data_penilai->etika_bobot_aspek}}</td>
                                <td id="pp5_sum" class="ppm">{{round($data_penilai->etika_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    {{round($data_penilai->sum_nilai_p_bobot_aspek,3)}}
                                </td>
                                <td id="sum_p_total" class="totalNilai">
                                    {{round($data_penilai->sum_nilai_p_bobot_aspek,3) * 100}}
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
                                <td id="sp1">{{$data_penilai->relasi_respon->goal_kinerja}}</td>
                                <td id="spm1">{{$data_penilai->goal_kinerja_bobot_aspek}}</td>
                                <td id="sp1_sum" class="spm">{{round($data_penilai->goal_kinerja_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Error - Pencapaian Kinerja</td>
                                <td id="sp2">{{$data_penilai->relasi_respon->error_kinerja}}</td>
                                <td id="spm2">{{$data_penilai->error_kinerja_bobot_aspek}}</td>
                                <td id="sp2_sum" class="spm">{{round($data_penilai->error_kinerja_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Proses - Pencapaian Kinerja (Dokumen)</td>
                                <td id="sp3">{{$data_penilai->relasi_respon->proses_dokumen}}</td>
                                <td id="spm3">{{$data_penilai->proses_dokumen_bobot_aspek}}</td>
                                <td id="sp3_sum" class="spm">{{round($data_penilai->proses_dokumen_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Proses - Pencapaian Kinerja (Inisiatif)</td>
                                <td id="sp4">{{$data_penilai->relasi_respon->proses_inisiatif}}</td>
                                <td id="spm4">{{$data_penilai->proses_dokumen_bobot_aspek}}</td>
                                <td id="sp4_sum" class="spm">{{round($data_penilai->proses_dokumen_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Proses - Pencapaian Kinerja (Pola Pikir)</td>
                                <td id="sp5">{{$data_penilai->relasi_respon->proses_polapikir}}</td>
                                <td id="spm5">{{$data_penilai->proses_inisiatif_bobot_aspek}}</td>
                                <td id="sp5_sum" class="spm">{{round($data_penilai->proses_inisiatif_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                {{round($data_penilai->sum_nilai_s_bobot_aspek,3)}}
                                </td>
                                <td id="sum_s_total" class="totalNilai">
                                {{round($data_penilai->sum_nilai_s_bobot_aspek,3) * 100}}
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="11">3.Kepemimpinan, Kompetensi Dan Pengembangan Profesi</td>
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
                                <td id="kp1">{{$data_penilai->relasi_respon->strategi_perencanaan}}</td>
                                <td id="kpm1">{{$data_penilai->strategi_perencanaan_bobot_aspek}}</td>
                                <td id="kp1_sum" class="kpm">{{round($data_penilai->strategi_perencanaan_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Strategi - Pengawasan</td>
                                <td id="kp2">{{$data_penilai->relasi_respon->strategi_pengawasan}}</td>
                                <td id="kpm2">{{$data_penilai->strategi_pengawasan_bobot_aspek}}</td>
                                <td id="kp2_sum" class="kpm">{{round($data_penilai->strategi_pengawasan_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Strategi - Inovasi</td>
                                <td id="kp3">{{$data_penilai->relasi_respon->strategi_inovasi}}</td>
                                <td id="kpm3">{{$data_penilai->strategi_inovasi_bobot_aspek}}</td>
                                <td id="kp3_sum" class="kpm">{{round($data_penilai->strategi_inovasi_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Kepemimpinan</td>
                                <td id="kp4">{{$data_penilai->relasi_respon->kepemimpinan}}</td>
                                <td id="kpm4">{{$data_penilai->kepemimpinan_bobot_aspek}}</td>
                                <td id="kp4_sum" class="kpm">{{round($data_penilai->kepemimpinan_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Membimbingan dan Membangun</td>
                                <td id="kp5">{{$data_penilai->relasi_respon->membimbing_membangun}}</td>
                                <td id="kpm5">{{$data_penilai->membimbing_membangun_bobot_aspek}}</td>
                                <td id="kp5_sum" class="kpm">{{round($data_penilai->membimbing_membangun_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td>Pengambilan keputusan</td>
                                <td id="kp6">{{$data_penilai->relasi_respon->pengambilan_keputusan}}</td>
                                <td id="kpm6">{{$data_penilai->pengambilan_keputusan_bobot_aspek}}</td>
                                <td id="kp6_sum" class="kpm">{{round($data_penilai->pengambilan_keputusan_bobot_aspek,2) * 100}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>{{round($data_penilai->sum_nilai_k_bobot_aspek,3)}}</td>
                                <td id="sum_k_total" class="totalNilai">
                                {{round($data_penilai->sum_nilai_k_bobot_aspek,3) * 100}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Jumlah</td>
                                <td id="totalSumNilai">
                                {{round((
                                    $data_penilai->sum_nilai_k_bobot_aspek +
                                    $data_penilai->sum_nilai_s_bobot_aspek +
                                    $data_penilai->sum_nilai_p_bobot_aspek) * 100,
                                    3)}}
                                </td>
                            </tr>   
                            <tr>
                                <td colspan="3">Skor DP 3</td>
                                <td>
                                {{round(($data_penilai->sum_nilai_dp3 * 100),3)}} {{'('.$bobot_penilai.')'}}
                                </td>
                            </tr>
                            @isset($avg_penilai)
                            <tr class="text-center font-weight-bold">
                                <td colspan="4">Rata - Rata DP 3</td>
                                <td>
                                {{round($avg_penilai['sum_nilai_dp3'] * 100,2)}}
                                </td>
                            </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>