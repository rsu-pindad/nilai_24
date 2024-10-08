<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Dokumen Penilaian</title>
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
        margin: 0;
        padding: 0;
      }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

    @php

      $jabatanDinilai = $dataRekap->identitas_dinilai->level_jabatan;
      $relasi = $dataRekap->relasi_respon->relasi;
      $aspek_perusahaan = false;
      $aspek_kepemimpinan = false;
      $aspek_sasaran = false;
      $bobot_penilai = false;
      if (
          Str::remove(' ', $jabatanDinilai) == 'DIREKSI' ||
          Str::remove(' ', $jabatanDinilai) == 'IA' ||
          Str::remove(' ', $jabatanDinilai) == 'IB' ||
          Str::remove(' ', $jabatanDinilai) == 'IC' ||
          Str::remove(' ', $jabatanDinilai) == 'IANS' ||
          Str::remove(' ', $jabatanDinilai) == 'II' ||
          Str::remove(' ', $jabatanDinilai) == 'III' ||
          Str::remove(' ', $jabatanDinilai) == 'IIINS' ||
          Str::remove(' ', $jabatanDinilai) == 'IIII' ||
          Str::remove(' ', $jabatanDinilai) == 'IV' ||
          Str::remove(' ', $jabatanDinilai) == 'IVA(III)' ||
          Str::remove(' ', $jabatanDinilai) == 'IVA(IIINS)' ||
          Str::remove(' ', $jabatanDinilai) == 'IVA'
      ) {
          if ($relasi == 'atasan') {
              $bobot_penilai = '60%';
          }
          if ($relasi == 'rekanan') {
              $bobot_penilai = '20%';
          }
          if ($relasi == 'staff') {
              $bobot_penilai = '15%';
          }
          if ($relasi == 'self') {
              $bobot_penilai = '5%';
          }
      } else {
          if ($relasi == 'atasan') {
              $bobot_penilai = '65%';
          }
          if ($relasi == 'rekanan') {
              $bobot_penilai = '25%';
          }
          if ($relasi == 'staff') {
              $bobot_penilai = '-';
          }
          if ($relasi == 'self') {
              $bobot_penilai = '10%';
          }
      }

      if (
          Str::remove(' ', $jabatanDinilai) == 'DIREKSI' ||
          Str::remove(' ', $jabatanDinilai) == 'IA' ||
          Str::remove(' ', $jabatanDinilai) == 'IB' ||
          Str::remove(' ', $jabatanDinilai) == 'IC' ||
          Str::remove(' ', $jabatanDinilai) == 'IANS'
      ) {
          $aspek_perusahaan = '25%';
          $aspek_sasaran = '35%';
          $aspek_kepemimpinan = '40%';
      } elseif (Str::remove(' ', $jabatanDinilai) == 'II') {
          $aspek_perusahaan = '25%';
          $aspek_sasaran = '40%';
          $aspek_kepemimpinan = '35%';
      } elseif (
          Str::remove(' ', $jabatanDinilai) == 'III' ||
          Str::remove(' ', $jabatanDinilai) == 'IIINS' ||
          Str::remove(' ', $jabatanDinilai) == 'IIII'
      ) {
          $aspek_perusahaan = '25%';
          $aspek_sasaran = '45%';
          $aspek_kepemimpinan = '30%';
      } elseif (
          Str::remove(' ', $jabatanDinilai) == 'IV' ||
          Str::remove(' ', $jabatanDinilai) == 'IVA(III)' ||
          Str::remove(' ', $jabatanDinilai) == 'IVA(IIINS)' ||
          Str::remove(' ', $jabatanDinilai) == 'IVA'
      ) {
          $aspek_perusahaan = '30%';
          $aspek_sasaran = '60%';
          $aspek_kepemimpinan = '10%';
      } else {
          $aspek_perusahaan = '35%';
          $aspek_sasaran = '65%';
          $aspek_kepemimpinan = '0%';
      }
    @endphp

    <div class="mx-auto max-w-xl px-2 py-4">
      <table class="table-auto border-collapse border-spacing-0 border-slate-500 text-xs">
        <thead>
          <tr>
            <th colspan="5"
                class="border border-slate-600">Penilaian Kinerja</th>
          </tr>

          <tr>
            <td class="border border-slate-600">Nama</td>
            <td colspan="2">{{ $dataRekap->identitas_dinilai->nama_karyawan }}</td>
            <td class="pr-2 text-right">NIK</td>
            <td class="border border-slate-600">{{ $dataRekap->identitas_dinilai->npp_karyawan }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Jabatan</td>
            <td class="border border-slate-600"
                colspan="4">{{ $dataRekap->identitas_dinilai->level_jabatan }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Unit Kerja</td>
            <td class="border border-slate-600"
                colspan="4">{{ $dataRekap->identitas_dinilai->unit_jabatan }}</td>
          </tr>

          <tr>
            <th class="border border-slate-600"
                colspan="5">Pejabat Penilai</th>
          </tr>

          <tr>
            <td class="border border-slate-600">Nama</td>
            <td colspan="2">{{ $dataRekap->identitas_penilai->nama_karyawan }}</td>
            <td class="pr-2 text-right">NIK</td>
            <td class="border border-slate-600">{{ $dataRekap->identitas_penilai->npp_karyawan }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Jabatan</td>
            <td class="border border-slate-600"
                colspan="4">{{ $dataRekap->identitas_penilai->level_jabatan }}</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Unit Kerja</td>
            <td class="border border-slate-600"
                colspan="4">{{ $dataRekap->identitas_penilai->unit_jabatan }}</td>
          </tr>

          <tr>
            <th class="border border-slate-600"
                colspan="5">Atasan Pejabat Penilai</th>
          </tr>

          <tr>
            <td class="border border-slate-600">Nama</td>
            <td colspan="2"></td>
            <td class="pr-2 text-right">NIK</td>
            <td class="border border-slate-600">12345</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Jabatan</td>
            <td class="border border-slate-600"
                colspan="4"></td>
          </tr>

          <tr>
            <td class="border border-slate-600">Unit Kerja</td>
            <td class="border border-slate-600"
                colspan="4"></td>
          </tr>
        </thead>
        <tbody>
          <tr class="font-semibold">
            <td rowspan="2"
                class="border border-slate-600">
              Komponen Penilaian <br>Kinerja
            </td>
            <td class="border border-slate-600">Bobot</td>
            <td class="border border-slate-600"
                rowspan="2">Penilaian</td>
            <td class="border border-slate-600"
                rowspan="2">Nilai</td>
            <td class="border border-slate-600"
                rowspan="2">Total</td>
          </tr>

          <tr class="font-semibold">
            <td class="border border-slate-600">Keterangan Pencapaian</td>
          </tr>

          <tr>
            <td class="border border-slate-600">Bobot Kinerja:</td>
            <td class="border border-slate-600">a</td>
            <td class="border border-slate-600">b</td>
            <td class="border border-slate-600">c = (jml b / (Penilaian)) * a</td>
            <td class="border border-slate-600">d = c * 100</td>
          </tr>

          {{-- Nilai - Nilai <br>Perusahaan --}}
          <tr>
            <td class="border border-slate-600 font-semibold">1.Nilai - Nilai <br>Perusahaan</td>
            <td class="border border-slate-600">{{ $aspek_perusahaan }}</td>
            <td class="border border-slate-600">1 2 3 4 5</td>
            <td class="border border-slate-600">
              ({{ $dataRekap->relasi_respon->kerjasama + $dataRekap->relasi_respon->komunikasi + $dataRekap->relasi_respon->absensi + $dataRekap->relasi_respon->integritas + $dataRekap->relasi_respon->etika }}/25)
              * ({{ $aspek_perusahaan }})%</td>
            <td class="border border-slate-600"></td>
          </tr>

          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Kerjasama</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->kerjasama }}</td>
            <td class="border border-slate-600">{{ $dataRekap->kerjasama_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->kerjasama_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Komunikasi</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->komunikasi }}</td>
            <td class="border border-slate-600">{{ $dataRekap->komunikasi_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->komunikasi_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Disiplin dan Kehadiran / Absensi</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->absensi }}</td>
            <td class="border border-slate-600">{{ $dataRekap->absensi_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->absensi_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Dedikasi dan Integritas</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->integritas }}</td>
            <td class="border border-slate-600">{{ $dataRekap->integritas_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->integritas_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Etika</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->etika }}</td>
            <td class="border border-slate-600">{{ $dataRekap->etika_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->etika_bobot_aspek * 100 }}</td>
          </tr>

          {{-- Kepemimpinan --}}
          <tr>
            <td class="border border-slate-600 font-semibold">2.Kepemimpinan</td>
            <td class="border border-slate-600">{{ $aspek_kepemimpinan }}</td>
            <td class="border border-slate-600">1 2 3 4 5</td>
            <td class="border border-slate-600">
              ({{ $dataRekap->relasi_respon->strategi_perencanaan + $dataRekap->relasi_respon->strategi_pengawasan + $dataRekap->relasi_respon->strategi_inovasi + $dataRekap->relasi_respon->kepemimpinan + $dataRekap->relasi_respon->membimbing_membangun + $dataRekap->relasi_respon->pengambilan_keputusan }}/30)
              * ({{ $aspek_kepemimpinan }})%</td>
            <td class="border border-slate-600"></td>
          </tr>

          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Strategi - Perencanaan</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->strategi_perencanaan }}</td>
            <td class="border border-slate-600">{{ $dataRekap->strategi_perencanaan_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->strategi_perencanaan_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Strategi - Pengawasan</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->strategi_pengawasan }}</td>
            <td class="border border-slate-600">{{ $dataRekap->strategi_pengawasan_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->strategi_pengawasan_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Strategi - Inovasi</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->strategi_inovasi }}</td>
            <td class="border border-slate-600">{{ $dataRekap->strategi_inovasi_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->strategi_inovasi_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Kepemimpinan</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->kepemimpinan }}</td>
            <td class="border border-slate-600">{{ $dataRekap->kepemimpinan_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->kepemimpinan_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Membimbing dan Membangun</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->membimbing_membangun }}</td>
            <td class="border border-slate-600">{{ $dataRekap->membimbing_membangun_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->membimbing_membangun_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Pengambilan Keputusan</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->pengambilan_keputusan }}</td>
            <td class="border border-slate-600">{{ $dataRekap->pengambilan_keputusan_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->pengambilan_keputusan_bobot_aspek * 100 }}</td>
          </tr>

          {{-- Sasaran --}}
          <tr>
            <td class="border border-slate-600 font-semibold">3.Tugas Utama <br>Sasaran Kinerja <br>Dan<br>Pengembangan
              Profesi</td>
            <td class="border border-slate-600">{{ $aspek_sasaran }}</td>
            <td class="border border-slate-600">1 2 3 4 5</td>
            <td class="border border-slate-600">
              ({{ $dataRekap->relasi_respon->goal_kinerja + $dataRekap->relasi_respon->error_kinerja + $dataRekap->relasi_respon->proses_dokumen + $dataRekap->relasi_respon->proses_inisiatif + $dataRekap->relasi_respon->proses_polapikir }}/25)
              * ({{ $aspek_sasaran }})%</td>
            <td class="border border-slate-600"></td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Goal - Pencapaian Kinerja</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->goal_kinerja }}</td>
            <td class="border border-slate-600">{{ $dataRekap->goal_kinerja_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->goal_kinerja_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Error - Pencapaian Kinerja</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->error_kinerja }}</td>
            <td class="border border-slate-600">{{ $dataRekap->error_kinerja_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->error_kinerja_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Proses - Pencapaian Kinerja <br>( Dokumen )</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->proses_dokumen }}</td>
            <td class="border border-slate-600">{{ $dataRekap->proses_dokumen_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->proses_dokumen_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Proses - Pencapaian Kinerja <br>( Inisiatif )</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->proses_inisiatif }}</td>
            <td class="border border-slate-600">{{ $dataRekap->proses_inisiatif_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->proses_inisiatif_bobot_aspek * 100 }}</td>
          </tr>
          <tr>
            <td class="border border-slate-600"></td>
            <td class="border border-slate-600">Proses - Pencapaian Kinerja <br>( Pola Pikir )</td>
            <td class="border border-slate-600">{{ $dataRekap->relasi_respon->proses_polapikir }}</td>
            <td class="border border-slate-600">{{ $dataRekap->proses_polapikir_bobot_aspek }}</td>
            <td class="border border-slate-600">{{ $dataRekap->proses_polapikir_bobot_aspek * 100 }}</td>
          </tr>

          {{-- Jumlah Nilai --}}
          <tr>
            <td colspan="4"
                class="border border-slate-800"></td>
            <td class="border border-slate-800 font-bold">
              {{ ($dataRekap->sum_nilai_k_bobot_aspek + $dataRekap->sum_nilai_s_bobot_aspek + $dataRekap->sum_nilai_p_bobot_aspek) * 100 }}
              ({{ $bobot_penilai }})
            </td>
          </tr>

          {{-- Keterangan --}}
          <tr>
            <td colspan="2"
                class="border border-slate-600 font-semibold">Keterangan</td>
            <td colspan="3"
                class="border border-slate-600 font-semibold">CATATAN / REKOMENDASI <br>( Pegawai, Pejabat Penilai,
              Atasan Pejabat Penilai, SDM ) :
            </td>
          </tr>

          <tr>
            <td class="border border-slate-600">Sangat Baik</td>
            <td class="border border-slate-600">: > 95 (4)</td>
            <td class="border-r-2 border-slate-500"
                colspan="3"></td>
          </tr>
          <tr>
            <td class="border border-slate-600">Baik</td>
            <td class="border border-slate-600">: 85 < &
                <=95
                (3)</td>
            <td class="border-r-2 border-slate-500"
                colspan="3"></td>
          </tr>
          <tr>
            <td class="border border-slate-600">Cukup</td>
            <td class="border border-slate-600">: 65 < &
                <=85
                (2)</td>
            <td class="border-r-2 border-slate-500"
                colspan="3"></td>
          </tr>
          <tr>
            <td class="border border-slate-600">Kurang</td>
            <td class="border border-slate-600">: 50 < &
                <=65
                (2)</td>
            <td class="border-r-2 border-slate-500"
                colspan="3"></td>
          </tr>
          <tr>
            <td class="border border-slate-600">Sangat Kurang</td>
            <td class="border border-slate-600">: < 50
                (0)</td>
            <td class="border-b-2 border-r-2 border-slate-500"
                colspan="3"></td>
          </tr>

          <tr>
            <td colspan="5"
                class="p-2"></td>
          </tr>

          {{-- Pejabat --}}
          <tr>
            <td colspan="5"
                class="border border-slate-700">
              <div class="grid grid-flow-col grid-rows-3 justify-items-center">
                <div class="grid-rows-subgrid row-span-3 grid gap-2 px-3">
                  <div class="row-start-1 font-semibold">Pegawai yang dinilai,</div>
                  <div class="row-start-2 py-3"></div>
                  <div class="row-start-3">Tanggal:</div>
                </div>
                <div class="grid-rows-subgrid row-span-3 grid gap-2 px-3">
                  <div class="row-start-1 font-semibold">Penjabat Penilai,</div>
                  <div class="row-start-2 py-3"></div>
                  <div class="row-start-3">Tanggal:</div>
                </div>
                <div class="grid-rows-subgrid row-span-3 grid gap-2 px-3">
                  <div class="row-start-1 font-semibold">Atasan Pejabat Penilai,</div>
                  <div class="row-start-2 py-3"></div>
                  <div class="row-start-3">Tanggal:</div>
                </div>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

  </body>

</html>
