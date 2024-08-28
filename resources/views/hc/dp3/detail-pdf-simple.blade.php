<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Hasil Personal DP3</title>
    <style>
      @page {
        margin: 0cm 0cm;
      }

      body {
        font-family: Georgia, serif;
        background: none;
        color: black;
        margin-top: 1.5cm;
        margin-left: 1.5cm;
        margin-right: 1.5cm;
        margin-bottom: 1.5cm;
      }

      .styled-table,
      {
      /* border: 1px solid black; */
      /* padding: 0.1rem 0.50rem 0.1rem 0.50rem; */
      border-collapse: collapse;
      table-layout: fixed;
      margin: 8px 0;
      font-size: 0.8em;
      font-family: DejaVu Sans;
      /* min-width: 700px; */
      min-width: 700px;
      max-width: max-content;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      /* width: 100%; */
      }

      /* .center{
            margin-left: auto;
            margin-right: auto;
        } */
      /* .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        } */
      .styled-table th,
      .styled-table td {
        padding: 1px 16px;
      }

      .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
        /* border: 0.1px solid #080808; */
      }

      .styled-table tbody tr:nth-of-type(odd) {
        /* background-color: #f3f3f3; */
        background-color: #fff;
      }

      .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
      }

      /* === BASE HEADING === */
      h1 {
        position: relative;
        padding: 0;
        margin: 0;
        font-family: DejaVu Sans, sans-serif;
        font-weight: 600;
        font-size: 1.5em;
        color: #080808;
        /* -webkit-transition: all 0.4s ease 0s; */
        /* -o-transition: all 0.4s ease 0s; */
        /* transition: all 0.4s ease 0s; */
      }

      h1 span {
        display: block;
        font-size: 0.1em;
        /* line-height: 1.3; */
      }

      h1 em {
        font-style: normal;
        font-weight: 600;
      }

      /* === HEADING STYLE #2 === */
      .two h1 {
        /* text-transform: capitalize; */
        color: rgba(0, 0, 0, 0.7);
        text-transform: uppercase;
      }

      .two h1:before {
        position: absolute;
        left: 0;
        bottom: 0;
        width: max-content;
        height: 0px;
        content: "";
        /* background-color: #c50000; */
      }

      .two h1 span {
        font-size: 20px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 4px;
        line-height: 2em;
        padding-left: 0.25em;
        color: rgba(0, 0, 0, 0.7);
        padding-bottom: 1px;
      }

      .alt-two h1 {
        text-align: center;
      }

      .alt-two h1:before {
        left: 50%;
        margin-left: -30px;
      }

      .boldText {
        font-weight: bold;
      }

      .semiBoldText {
        font-weight: 600;
      }

      .floatRight {
        position: fixed;
        bottom: 176px;
        right: 70px;
      }

      /* table td { width: 10em; border: 1px solid black; } */
      /* table td:nth-child(2) { text-align: end; } */
      /* WaterMark */
      /* .watermark {
            position: fixed;
            bottom: 260;
            left: 50;
            transform: rotate(-45deg);
            font-size: 100px;
            color: #989595;
            opacity: 0.25;
            pointer-events: none;
            white-space: nowrap;
        } */
      .watermark {
        position: fixed;
        bottom: 400;
        left: 20;
        transform: rotate(-45deg);
        font-size: 90px;
        color: #989595;
        opacity: 0.18;
        pointer-events: none;
        white-space: nowrap;
      }

      header {
        position: fixed;
        top: 0.5cm;
        left: 0.5cm;
        right: 0cm;
        height: 3cm;
      }
    </style>

  </head>

  <body>
    @php
      $sk1 = 0;
      $sk2 = 0;
      $sk3 = 0;
      $sk4 = 0;
      $sk5 = 0;
      $sk6 = 0;
      $tk = 0;

      $sp1 = 0;
      $sp2 = 0;
      $sp3 = 0;
      $sp4 = 0;
      $sp5 = 0;
      $tp = 0;

      $ss1 = 0;
      $ss2 = 0;
      $ss3 = 0;
      $ss4 = 0;
      $ss5 = 0;
      $ts = 0;

      foreach ($detail_nilai as $dn) {
          $sk1 = round($dn->k1, 3);
          $sk2 = round($dn->k2, 3);
          $sk3 = round($dn->k3, 3);
          $sk4 = round($dn->k4, 3);
          $sk5 = round($dn->k5, 3);
          $sk6 = round($dn->k6, 3);

          $sp1 = round($dn->p1, 3);
          $sp2 = round($dn->p2, 3);
          $sp3 = round($dn->p3, 3);
          $sp4 = round($dn->p4, 3);
          $sp5 = round($dn->p5, 3);

          $ss1 = round($dn->s1, 3);
          $ss2 = round($dn->s2, 3);
          $ss3 = round($dn->s3, 3);
          $ss4 = round($dn->s4, 3);
          $ss5 = round($dn->s5, 3);
      }
      $aspek_perilaku = round($sp1 + $sp2 + $sp3 + $sp4 + $sp5, 3) * 100;
      $aspek_sasaran = round($ss1 + $ss2 + $ss3 + $ss4 + $ss5, 3) * 100;
      $aspek_kepemimpinan = round($sk1 + $sk2 + $sk3 + $sk4 + $sk5 + $sk6, 3) * 100;
      $total_aspek = $aspek_perilaku + $aspek_sasaran + $aspek_kepemimpinan;

    @endphp
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
          $atasan = 0.6;
          $rekanan = 0.2;
          $staff = 0.15;
          $self = 0.05;
      } else {
          $atasan = 0.65;
          $rekanan = 0.25;
          $staff = 0;
          $self = 0.15;
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
    <header>
      <img src="{{ public_path('/dist/img/logo.png') }}"
           alt="Logo"
           width="100px"
           height="100px">
    </header>
    <div class="watermark">RSU PINDAD <br>CONFIDENTIAL</div>
    <main>
      <div class="two alt-two">
        <h1>Laporan Hasil Kinerja Pegawai
          <span>Level {{ $person_nilai->level_jabatan }}</span>
        </h1>
      </div>
      <table class="styled-table">
        <tr>
          <td class="boldText">Nama</td>
          <td colspan="3">{{ $person_nilai->nama_karyawan }}</td>
          <td class="boldText"
              colspan="2">Penempatan</td>
          <td colspan="{{ count($jumlah_relasi_nilai) }}">{{ $person_nilai->unit_jabatan }}</td>
        </tr>
        <tr>
          <td class="boldText">NPP</td>
          <td colspan="3">{{ $person_nilai->npp_karyawan }}</td>
          <td class="boldText"
              colspan="2">Unit</td>
          <td colspan="{{ count($jumlah_relasi_nilai) }}">RSU PINDAD</td>
        </tr>
        <tr>
          <td class="boldText">Jabatan</td>
          <td colspan="3">{{ $person_nilai->level_jabatan }}</td>
          <td class="boldText"
              colspan="2">Masa Penilaian</td>
          <td colspan="{{ count($jumlah_relasi_nilai) }}">01-01-2023 sd 31-12-2023</td>
        </tr>
      </table>
      <table class="styled-table">
        <tr class="boldText">
          <td>NO</td>
          <td colspan="3">ASPEK</td>
          <td colspan="{{ count($jumlah_relasi_nilai) + 1 }}"
              style="text-align:center;">NILAI</td>
        </tr>
        <tr class="boldText">
          <td>A ({{ $nilai_aspek_a }}%)</td>
          <td colspan="3">NILAI-NILAI PERUSAHAAN DAN PERILAKU</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-transform: capitalize;"
                class="semiBoldText text-left">{{ $dn->relasi }}</td>
          @empty
            <td></td>
          @endforelse
          <td></td>
        </tr>
        <tr>
          <td style="text-align:right;">1</td>
          <td colspan="3">Kerjasama</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->kerjasama_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sp1, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">2</td>
          <td colspan="3">Komunikasi</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->komunikasi_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sp2, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">3</td>
          <td colspan="3">Kedisiplinan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->absensi_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sp3, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">4</td>
          <td colspan="3">Dedikasi dan Integritas</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->integritas_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sp4, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">5</td>
          <td colspan="3">Etika</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->etika_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sp5, 3) * 100 }}</td>
        </tr>
        <tr class="semiBoldText">
          <td colspan="4"
              class="text-right">Jumlah A</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->sum_nilai_p_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sp1 + $sp2 + $sp3 + $sp4 + $sp5, 3) * 100 }}</td>
        </tr>
        <tr class="boldText">
          <td class="text-right">B ({{ $nilai_aspek_c }}%)</td>
          <td colspan="3"
              class="text-left">SASARAN KINERJA DAN PROSES PENCAPAIAN</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-transform: capitalize;"
                class="semiBoldText text-right">{{ $dn->relasi }}</td>
          @empty
            <td></td>
          @endforelse
          <td></td>
        </tr>
        <tr>
          <td style="text-align:right;">1</td>
          <td colspan="3">Goal</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->goal_kinerja_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($ss1, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">2</td>
          <td colspan="3">Error</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->error_kinerja_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($ss2, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">3</td>
          <td colspan="3">Dokumentasi</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->proses_dokumen_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($ss3, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">4</td>
          <td colspan="3">Inisiatif</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->proses_inisiatif_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($ss4, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">5</td>
          <td colspan="3">Pola Pikir</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->proses_polapikir_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($ss5, 3) * 100 }}</td>
        </tr>
        <tr class="semiBoldText">
          <td colspan="4"
              class="text-right">Jumlah B</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->sum_nilai_s_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($ss1 + $ss2 + $ss3 + $ss4 + $ss5, 3) * 100 }}</td>
        </tr>
        <tr class="boldText">
          <td class="text-right">C ({{ $nilai_aspek_b }}%)</td>
          <td colspan="3"
              class="text-left">LEADERSHIP</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-transform: capitalize;"
                class="semiBoldText text-right">{{ $dn->relasi }}</td>
          @empty
            <td></td>
          @endforelse
          <td></td>
        </tr>
        <tr>
          <td style="text-align:right;">1</td>
          <td colspan="3">Strategi - Perencanaan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->strategi_perencanaan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sk1, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">2</td>
          <td colspan="3">Strategi – Pengawasan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->strategi_pengawasan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sk2, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">3</td>
          <td colspan="3">Strategi - Inovasi</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->strategi_inovasi_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sk3, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">4</td>
          <td colspan="3">Kepemimpinan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->kepemimpinan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sk4, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">5</td>
          <td colspan="3">Membimbingan dan Membangun</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->membimbing_membangun_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sk5, 3) * 100 }}</td>
        </tr>
        <tr>
          <td style="text-align:right;">6</td>
          <td colspan="3">Pengambilan keputusan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->pengambilan_keputusan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td>{{ round($sk6, 3) * 100 }}</td>
        </tr>
        <tr class="semiBoldText">
          <td colspan="4"
              class="text-right">Jumlah C</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->sum_nilai_k_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <<td>{{ round($sk1 + $sk2 + $sk3 + $sk4 + $sk5 + $sk6, 3) * 100 }}</td>
        </tr>
        <tr class="semiBoldText">
          <td colspan="4"
              class="text-right">Konversi DP3</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ $dn->sum_nilai_dp3 * 100 }}</td>
          @empty
            <td></td>
          @endforelse
          <td></td>
        </tr>
        @php
          $skor_akhir_dp3 = 0;
          foreach ($detail_nilai as $dn) {
              $skor_akhir_dp3 += round($dn->avg_nilai_dp3);
          }
        @endphp
        <tr class="boldText">
          <td class="text-right"
              colspan="4">Skor Akhir DP3</td>
          <td style="text-align:right;"
              colspan="{{ count($jumlah_relasi_nilai) }}">
            {{ round($detail_nilai->sum('avg_nilai_dp3'), 4) * 100 }}
          </td>
          <td>{{ $total_aspek }}</td>
        </tr>
        <tr style="font-size: 0.9em;background-color: #fff; border-bottom:none !important;">
          <td colspan="4">
            <table style="font-family: DejaVu Sans;">
              <tr>
                <td>Sangat Baik</td>
                <td>Skor &gt; 95</td>
              </tr>
              <tr>
                <td>Baik</td>
                <td>85 &#62; Skor &le; 95</td>
              </tr>
              <tr>
                <td>Cukup</td>
                <td>65 &#62; Skor &le; 85</td>
              </tr>
              <tr>
                <td>Kurang</td>
                <td>50 &#62; Skor &le; 65</td>
              </tr>
              <tr>
                <td>Sangat Kurang</td>
                <td>Skor &le; 50</td>
              </tr>
            </table>
          </td>
          <td colspan="{{ count($jumlah_relasi_nilai) + 1 }}">
            <table>
              <tr>
                <td>Nilai Kinerja</td>
                <td style="text-align:right;">
                  {{ round($detail_nilai->sum('avg_nilai_dp3'), 4) * 100 }}
                </td>
              </tr>
              <tr>
                <td>Kriteria</td>
                <td>{{ $kriteria_skor_dp3 }}</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table class="floatRight">
        <tr>
          <td class="px-4"
              style="text-align:center;">
            <span>Bandung,</span><br />
            <span class="font-weight-bold">
              PT PINDAD MEDIKA UTAMA
            </span>
          </td>
        </tr>
        <tr>
          <td style="height: 2.6em;"></td>
        </tr>
        <tr>
          <td class="font-weight-bold"
              style="text-align:center;">
            <u>Novita Indah Fitriyani</u><br>
            <span>Kepala Bidang HC</span>
          </td>
        </tr>
      </table>
    </main>
  </body>

</html>
