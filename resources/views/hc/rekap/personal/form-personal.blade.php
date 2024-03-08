@php
use Carbon\Carbon;
@endphp

<div class="row">
    <!-- /.col -->
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
            HASIL PENILAIAN KINERJA KARYAWAN
            </div>
            <div class="card-body mx-auto">
            <table class="table table-sm table-responsive table-striped table-bordered table-hover" id="tableDetailPersonal">
                <thead>
                    <tr>
                        <th colspan="6">Penilaian Kinerja</th>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td rowspan="3" id="head-nama-dinilai" colspan="3"></td>
                        <td>Npp</td>
                        <td id="head-npp-dinilai"></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td id="head-jabatan-dinilai" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="text-wrap">Unit Kerja</td>
                        <td id="head-unit-dinilai" colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="6">Penilai</th>
                    </tr>
                    <tr>
                        <td colspan="2">Nama</td>
                        <td colspan="2">Npp</td>
                        <td colspan="2">Status</td>
                    </tr>
                    <tr id="penilai_atasan">
                    </tr>
                    <tr id="penilai_selevel">
                    </tr>
                    <tr>
                        <th rowspan="2">Komponen Penilaian Kinerja</th>
                        <td>Bobot</td>
                        <td rowspan="2">Penilaian</td>
                        <td rowspan="2">Avg</td>
                        <td rowspan="2">Nilai</td>
                        <td rowspan="2">Total Nilai</td>
                    </tr>
                    <tr>
                        <td>Keterangan Pencapaian</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td id="ket_kp_1">a</td>
                        <td>b</td>
                        <td>avg</td>
                        <td>c</td>
                        <td>d</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="7">1.Nilai - Nilai Perusahaan Dan Perilaku</td>
                        <td></td>
                        <td>1-5</td>
                        <td>avg</td>
                        <td>(b/25)x a</td>
                        <td>(c)x 100</td>
                    </tr>
                    <tr>
                        <td>Kerjasama</td>
                        <td id="pp1"></td>
                        <td id="pp1_avg"></td>
                        <td id="ppm1"></td>
                        <td id="pp1_sum" class="ppm"></td>
                    </tr>
                    <tr>
                        <td>Komunikasi</td>
                        <td id="pp2"></td>
                        <td id="pp2_avg"></td>
                        <td id="ppm2"></td>
                        <td id="pp2_sum" class="ppm"></td>
                    </tr>
                    <tr>
                        <td>Disiplin dan Kehadiran / Absensi</td>
                        <td id="pp3"></td>
                        <td id="pp3_avg"></td>
                        <td id="ppm3"></td>
                        <td id="pp3_sum" class="ppm"></td>
                    </tr>
                    <tr>
                        <td>Dedikasi dan Integritas</td>
                        <td id="pp4"></td>
                        <td id="pp4_avg"></td>
                        <td id="ppm4"></td>
                        <td id="pp4_sum" class="ppm"></td>
                    </tr>
                    <tr>
                        <td>Etika</td>
                        <td id="pp5"></td>
                        <td id="pp5_avg"></td>
                        <td id="ppm5"></td>
                        <td id="pp5_sum" class="ppm"></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td id="sum_p_total" class="totalNilai"></td>
                    </tr>
                    <tr>
                        <td rowspan="8">2.Tugas Utama, Sasaran Kinerja Dan Pengembangan Profesi</td>
                        <td></td>
                        <td>1-5</td>
                        <td>avg</td>
                        <td>(b/25)x a</td>
                        <td>(c)x 100</td>
                    </tr>
                    <tr>
                        <td id="ket_kp_2">a</td>
                        <td>b</td>
                        <td>avg</td>
                        <td>c</td>
                        <td>d</td>
                    </tr>
                    <tr>
                        <td>Goal - Pencapaian Kinerja</td>
                        <td id="sp1"></td>
                        <td id="sp1_avg"></td>
                        <td id="spm1"></td>
                        <td id="sp1_sum" class="spm"></td>
                    </tr>
                    <tr>
                        <td>Error - Pencapaian Kinerja</td>
                        <td id="sp2"></td>
                        <td id="sp2_avg"></td>
                        <td id="spm2"></td>
                        <td id="sp2_sum" class="spm"></td>
                    </tr>
                    <tr>
                        <td>Proses - Pencapaian Kinerja (Dokumen)</td>
                        <td id="sp3"></td>
                        <td id="sp3_avg"></td>
                        <td id="spm3"></td>
                        <td id="sp3_sum" class="spm"></td>
                    </tr>
                    <tr>
                        <td>Proses - Pencapaian Kinerja (Inisiatif)</td>
                        <td id="sp4"></td>
                        <td id="sp4_avg"></td>
                        <td id="spm4"></td>
                        <td id="sp4_sum" class="spm"></td>
                    </tr>
                    <tr>
                        <td>Proses - Pencapaian Kinerja (Pola Pikir)</td>
                        <td id="sp5"></td>
                        <td id="sp5_avg"></td>
                        <td id="spm5"></td>
                        <td id="sp5_sum" class="spm"></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td id="sum_s_total" class="totalNilai"></td>
                    </tr>
                    <tr>
                        <td rowspan="10">3.Kepemimpinan, Kompetensi Dan Pengembangan Profesi</td>
                        <td></td>
                        <td>1-5</td>
                        <td>avg</td>
                        <td>(b/30)x a</td>
                        <td>(c)x 100</td>
                    </tr>
                    <tr>
                        <td id="ket_kp_3">a</td>
                        <td>b</td>
                        <td>avg</td>
                        <td>c</td>
                        <td>d</td>
                    </tr>
                    <tr>
                        <td>Strategi - Perencanaan</td>
                        <td id="kp1"></td>
                        <td id="kp1_avg"></td>
                        <td id="kpm1"></td>
                        <td id="kp1_sum" class="kpm"></td>
                    </tr>
                    <tr>
                        <td>Strategi - Pengawasan</td>
                        <td id="kp2"></td>
                        <td id="kp2_avg"></td>
                        <td id="kpm2"></td>
                        <td id="kp2_sum" class="kpm"></td>
                    </tr>
                    <tr>
                        <td>Strategi - Inovasi</td>
                        <td id="kp3"></td>
                        <td id="kp3_avg"></td>
                        <td id="kpm3"></td>
                        <td id="kp3_sum" class="kpm"></td>
                    </tr>
                    <tr>
                        <td>Kepemimpinan</td>
                        <td id="kp4"></td>
                        <td id="kp4_avg"></td>
                        <td id="kpm4"></td>
                        <td id="kp4_sum" class="kpm"></td>
                    </tr>
                    <tr>
                        <td>Membimbingan dan Membangun</td>
                        <td id="kp5"></td>
                        <td id="kp5_avg"></td>
                        <td id="kpm5"></td>
                        <td id="kp5_sum" class="kpm"></td>
                    </tr>
                    <tr>
                        <td>Pengambilan keputusan</td>
                        <td id="kp6"></td>
                        <td id="kp6_avg"></td>
                        <td id="kpm6"></td>
                        <td id="kp6_sum" class="kpm"></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td id="sum_k_total" class="totalNilai"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Jumlah</td>
                        <td id="totalSumNilai"></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <th colspan="5">Catatan / Rekomendasi (Pegawai, Pejabat Penilai, Atasan Pejabat Penilai, SDM)</th>
                    </tr>
                    <tr>
                        <td id="keterangan"></td>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td>Pegawai yang dinilai</td>
                        <td colspan="3">Pejabat Penilai</td>
                        <td colspan="2">Atasan Pejabat</td>
                    </tr>
                    <tr>
                        <td id="ttd_dinilai"></td>
                        <td id="ttd_atasan_dinilai" colspan="3"></td>
                        <td id="ttd_atasan_penilai" colspan="2"></td>
                    </tr>
                    <tr>
                        <td>{{Carbon::now()->format('Y/m/d')}}</td>
                        <td colspan="3">{{Carbon::now()->format('Y/m/d')}}</td>
                        <td colspan="2">{{Carbon::now()->format('Y/m/d')}}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>