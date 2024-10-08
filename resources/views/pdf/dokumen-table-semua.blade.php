<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Dokumen DP3 Personal</title>
    <style>
      /* Set A4 size */
      /* * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      } */
      @page {
        size: A4;
        margin: 0;
      }

      /* Set content to fill the entire A4 page */
      html,
      body {
        width: 210mm;
        height: 297mm;
        margin: 1;
        padding: 0;
      }

      /* background-image: url("<?php public_path('pmu.png'); ?>"); */
      #watermarked {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-image: url("https://survey.pmu.my.id/storage/basset/photos/settings/default_header.png");
        background-repeat: repeat;
        background-size: auto;
        opacity: 0.2;
        z-index: -999999;
      }
      
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>
    <div id="watermarked"
         class="m-4 grayscale">
    </div>
    @php

      $jabatanDinilai = false;
      $relasi = false;
      $aspek_perusahaan = false;
      $aspek_kepemimpinan = false;
      $aspek_sasaran = false;
      $bobot_penilai = false;
    @endphp

    <div class="mx-auto max-w-xl px-2 py-4">
      <div class="mb-2 flex items-center justify-between">
        <div class="flex items-center">
          <img class="mr-2 h-10 w-auto"
               src="https://survey.pmu.my.id/storage/basset/photos/settings/default_header.png"
               alt="Logo" />
          <div class="inline-block">
            <p class="text-lg font-semibold text-gray-700">PT PINDAD MEDIKA UTAMA</p>
            <p class="text-sm font-light text-gray-500">Jl. Jend. Gatot Soebroto No. 517 Bandung</p>
          </div>
        </div>
      </div>
      <table class="table-auto border-collapse border-spacing-3px outline-none text-xs">
        <thead>
          <tr>
            <th colspan="5"
                class="border border-slate-600">Laporan Hasil Kinerja Pegawai</th>
          </tr>
          <tr>
            <th colspan="2"
                class="border border-slate-600">Periode Penilaian</th>
            <th colspan="3"
                class="border border-slate-600">01-01-2023 sd 31-12-2023</th>
          </tr>

          <tr>
            <td class="border border-slate-600">Nama</td>
            <td colspan="2">{{ $rekap['nama_karyawan'] }}</td>
            <td class="pr-2 text-right">NIK</td>
            <td class="border border-slate-600">{{ $rekap['npp_karyawan'] }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Jabatan</td>
            <td class="border border-slate-600"
                colspan="4">{{ $rekap['level_jabatan'] }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Unit Kerja</td>
            <td class="border border-slate-600"
                colspan="4">{{ $rekap['unit_jabatan'] }}</td>
          </tr>

          <tr>
            <th class="border border-slate-600"
                colspan="5">Atasan Pejabat Pegawai</th>
          </tr>

          <tr>
            <td class="border border-slate-600">Nama</td>
            <td colspan="2">{{ $rekap['atasan_nama_karyawan'] }}</td>
            <td class="pr-2 text-right">NIK</td>
            <td class="border border-slate-600">{{ $rekap['atasan_npp_karyawan'] }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Jabatan</td>
            <td class="border border-slate-600"
                colspan="4">{{ $rekap['atasan_level_jabatan'] }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Unit Kerja</td>
            <td class="border border-slate-600"
                colspan="4">{{ $rekap['atasan_unit_jabatan'] }}</td>
          </tr>
        </thead>
        <tbody>
          <tr class="font-semibold">
            <td rowspan="2"
                class="border border-slate-600">
              Komponen Penilaian <br>Kinerja
            </td>
            <td class="border border-slate-600"
                colspan="3">Bobot</td>
            <td class="border border-slate-600"
                rowspan="2">Total</td>
          </tr>

          <tr class="font-semibold">
            <td class="border border-slate-600"
                colspan="3">Keterangan Pencapaian</td>
          </tr>

          {{-- Nilai - Nilai <br>Perusahaan --}}
          <tr>
            <td class="border border-slate-600 font-semibold">1.Nilai - Nilai <br>Perusahaan</td>
            <td class="border border-slate-600"
                colspan="3">{{ $aspek_perusahaan }}</td>
            <td class="border border-slate-600"></td>
          </tr>

          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Kerjasama</td>
            <td class="border border-slate-600 text-right">{{ $rekap['kerjasama_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Komunikasi</td>
            <td class="border border-slate-600 text-right">{{ $rekap['komunikasi_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Disiplin dan Kehadiran / Absensi</td>
            <td class="border border-slate-600 text-right">{{ $rekap['absensi_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Dedikasi dan Integritas</td>
            <td class="border border-slate-600 text-right">{{ $rekap['integritas_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Etika</td>
            <td class="border border-slate-600 text-right">{{ $rekap['etika_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600 font-semibold"
                colspan="4">Jumlah A</td>
            <td class="border border-slate-600 font-semibold text-right">{{ $rekap['sum_nilai_p_konversi_aspek'] }}</td>
          </tr>

          {{-- Kepemimpinan --}}
          <tr>
            <td class="border border-slate-600 font-semibold">2.Kepemimpinan</td>
            <td class="border border-slate-600"
                colspan="3">{{ $aspek_kepemimpinan }}</td>
            <td class="border border-slate-600"></td>
          </tr>

          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Strategi - Perencanaan</td>
            <td class="border border-slate-600 text-right">{{ $rekap['strategi_perencanaan_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Strategi - Pengawasan</td>
            <td class="border border-slate-600 text-right">{{ $rekap['strategi_pengawasan_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Strategi - Inovasi</td>
            <td class="border border-slate-600 text-right">{{ $rekap['strategi_inovasi_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Kepemimpinan</td>
            <td class="border border-slate-600 text-right">{{ $rekap['kepemimpinan_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Membimbing dan Membangun</td>
            <td class="border border-slate-600 text-right">{{ $rekap['membimbing_membangun_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Pengambilan Keputusan</td>
            <td class="border border-slate-600 text-right">{{ $rekap['pengambilan_keputusan_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600 font-semibold"
                colspan="4">Jumlah B</td>
            <td class="border border-slate-600 font-semibold text-right">{{ $rekap['sum_nilai_k_konversi_aspek'] }}</td>
          </tr>

          {{-- Sasaran --}}
          <tr>
            <td class="border border-slate-600 font-semibold">3.Tugas Utama <br>Sasaran Kinerja <br>Dan<br>Pengembangan
              Profesi</td>
            <td class="border border-slate-600"
                colspan="3">{{ $aspek_sasaran }}</td>
            <td class="border border-slate-600"></td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Goal - Pencapaian Kinerja</td>
            <td class="border border-slate-600 text-right">{{ $rekap['goal_kinerja_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Error - Pencapaian Kinerja</td>
            <td class="border border-slate-600 text-right">{{ $rekap['error_kinerja_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Proses - Pencapaian Kinerja ( Dokumen )</td>
            <td class="border border-slate-600 text-right">{{ $rekap['proses_dokumen_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Proses - Pencapaian Kinerja ( Inisiatif )</td>
            <td class="border border-slate-600 text-right">{{ $rekap['proses_inisiatif_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600"
                colspan="3">Proses - Pencapaian Kinerja ( Pola Pikir )</td>
            <td class="border border-slate-600 text-right">{{ $rekap['proses_polapikir_konversi_aspek'] }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600 font-semibold"
                colspan="4">Jumlah C</td>
            <td class="border border-slate-600 font-semibold text-right">{{ $rekap['sum_nilai_s_konversi_aspek'] }}</td>
          </tr>

          {{-- Jumlah Nilai --}}
          <tr>
            <td colspan="4"
                class="border border-slate-800 font-extrabold">Total Nilai</td>
            <td class="border border-slate-800 font-extrabold text-right">
              {{ $rekap['sum_nilai_dp3'] }}
            </td>
          </tr>

          {{-- Keterangan --}}
          <tr>
            <td colspan="2"
                class="border border-slate-600 font-semibold">Keterangan</td>
            <td colspan="3"
                class="border border-slate-600 font-semibold">CATATAN / REKOMENDASI <br>( Pegawai,
              Atasan Pejabat Penilai, SDM ) :
            </td>
          </tr>

          <tr>
            <td class="border border-slate-600">Sangat Baik</td>
            <td class="border border-slate-600">: > 95 (4)</td>
            <td class="border border-slate-600"
                colspan="3" rowspan="5"></td>
          </tr>
          <tr>
            <td class="border border-slate-600">Baik</td>
            <td class="border border-slate-600">: 85 < &
                <=95
                (3)</td>
          </tr>
          <tr>
            <td class="border border-slate-600">Cukup</td>
            <td class="border border-slate-600">: 65 < &
                <=85
                (2)</td>
          </tr>
          <tr>
            <td class="border border-slate-600">Kurang</td>
            <td class="border border-slate-600">: 50 < &
                <=65
                (2)</td>
          </tr>
          <tr>
            <td class="border border-slate-600">Sangat Kurang</td>
            <td class="border border-slate-600">: < 50
                (0)</td>
          </tr>
          
          {{-- Pejabat --}}
          <tr class="mt-4">
            <td colspan="5">
              <div class="grid grid-flow-col grid-rows-5 justify-items-end">
                <div class="grid-rows-subgrid row-span-5 grid px-4 text-center font-semibold">
                  <div class="row-start-1">Bandung,</div>
                  <div class="row-start-2">PT Pindad Medika Utama</div>
                  <div class="row-start-3 py-3"></div>
                  <div class="row-start-4 underline">Novita Indah Fitriyani</div>
                  <div class="row-start-5">Kepala Bidang HC</div>
                </div>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

  </body>

</html>
