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
      max-width: 700px;
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
        border-bottom: 0px solid #dddddd;
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
        -webkit-transition: all 0.4s ease 0s;
        -o-transition: all 0.4s ease 0s;
        transition: all 0.4s ease 0s;
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
        width: 60px;
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
      {{-- {{dd(count($jumlah_relasi_nilai))}} --}}
      <table class="styled-table">
        <tr>
          <td class="boldText">Nama</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">{{ $person_nilai->nama_karyawan }}</td>
          <td class="boldText">Penempatan</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">{{ $person_nilai->unit_jabatan }}</td>
        </tr>
        <tr>
          <td class="boldText">NPP</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">{{ $person_nilai->npp_karyawan }}</td>
          <td class="boldText">Unit</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">RSU PINDAD</td>
        </tr>
        <tr>
          <td class="boldText">Jabatan</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">{{ $person_nilai->level_jabatan }}</td>
          <td class="boldText">Masa Penilaian</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">01-01-2023 sd 31-12-2023</td>
        </tr>
        <tr class="boldText">
          <td>NO</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">ASPEK</td>
          <td colspan="{{ count($jumlah_relasi_nilai) }}"
              style="text-align:center;">NILAI</td>
        </tr>
        <tr class="boldText">
          <td>A</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">NILAI-NILAI PERUSAHAAN DAN PERILAKU</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-transform: capitalize;">{{ $dn->relasi }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">1</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Kerjasama</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->kerjasama_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">2</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Komunikasi</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->komunikasi_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">3</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Kedisiplinan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->absensi_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">4</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Dedikasi dan Integritas</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->integritas_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">5</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Etika</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->etika_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr class="semiBoldText">
          <td colspan="{{ count($jumlah_relasi_nilai) }}"
              class="text-right">Jumlah A</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->tp, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr class="boldText">
          <td class="text-right">B</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}"
              class="text-left">SASARAN KINERJA DAN PROSES PENCAPAIAN</td>
        </tr>
        <tr>
          <td style="text-align:right;">1</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Goal</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->goal_kinerja_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">2</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Error</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->error_kinerja_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">3</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Dokumentasi</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->proses_dokumen_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">4</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Inisiatif</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->proses_inisiatif_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">5</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Pola Pikir</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->proses_polapikir_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr class="semiBoldText">
          <td colspan="{{ count($jumlah_relasi_nilai) }}"
              class="text-right">Jumlah B</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->ts, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr class="boldText">
          <td class="text-right">C</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}"
              class="text-left">LEADERSHIP</td>
        </tr>
        <tr>
          <td style="text-align:right;">1</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Strategi - Perencanaan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->strategi_perencanaan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">2</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Strategi – Pengawasan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->strategi_pengawasan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">3</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Strategi - Inovasi</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->strategi_inovasi_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">4</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Kepemimpinan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->kepemimpinan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">5</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Membimbingan dan Membangun</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->membimbing_membangun_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr>
          <td style="text-align:right;">6</td>
          <td colspan="{{ count($jumlah_relasi_nilai) - 1 }}">Pengambilan keputusan</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->pengambilan_keputusan_bobot_aspek, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        <tr class="semiBoldText">
          <td colspan="{{ count($jumlah_relasi_nilai) }}"
              class="text-right">Jumlah C</td>
          @forelse ($detail_nilai as $dn)
            <td style="text-align:right;">{{ round($dn->tk, 2) * 100 }}</td>
          @empty
            <td></td>
          @endforelse
        </tr>
        @php
          $skor_akhir_dp3 = 0;
          foreach ($detail_nilai as $dn) {
              $skor_akhir_dp3 += $dn->avg_nilai_dp3;
          }
        @endphp
        <tr class="boldText">
          <td colspan="{{ count($jumlah_relasi_nilai) }}"
              class="text-right">Skor Akhir DP3</td>
          <td colspan="{{ count($jumlah_relasi_nilai) }}"
              style="text-align:right;">
            {{ round($skor_akhir_dp3, 2) * 100 }}
          </td>
        </tr>
        <tr style="font-size: 0.9em;background-color: #fff;">
          <td colspan="{{ count($jumlah_relasi_nilai) }}">
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
          <td colspan="{{ count($jumlah_relasi_nilai) }}">
            <table>
              <tr>
                <td>Nilai Kinerja</td>
                <td style="text-align:right;"></td>
              </tr>
              <tr>
                <td>Kriteria</td>
                <td></td>
              </tr>
              <tr>
                <td>Point</td>
                <td style="text-align:right;"></td>
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
