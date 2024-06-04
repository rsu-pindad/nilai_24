<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template DP3</title>
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
        border-collapse: collapse;
        table-layout: fixed;
        margin: 8px 0;
        font-size: 0.8em;
        font-family: DejaVu Sans;
        min-width: 700px;
        max-width: 700px;
        box-shadow: 0 0 20px;
        }
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
    .watermark {
        position: fixed;
        bottom: 400;
        left: 20;
        transform: rotate(-45deg);
        font-size: 90px;
        color: #989595;
        opacity: 0.05;
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
<img src="{{ public_path('/dist/img/logo.png') }}" alt="Logo" width="14%" height="100%">
</header>
<div class="watermark">RSU PINDAD <br>CONFIDENTIAL</div>
<main>
        <div class="two alt-two">
            <h1>Laporan Hasil Kinerja Pegawai
                <span>Level </span>
            </h1>
        </div>
        <table class="styled-table center">
            <tr>
                <td class="boldText">Nama</td>
                <td>.</td>
                <td class="boldText">Penempatan</td>
                <td>.</td>
            </tr>
            <tr>
                <td class="boldText">NPP</td>
                <td>.</td>
                <td class="boldText">Unit</td>
                <td>.</td>
            </tr>
            <tr>
                <td class="boldText">Jabatan</td>
                <td>.</td>
                <td class="boldText">Masa Penilaian</td>
                <td>01-01-2023 sd 31-12-2023</td>
            </tr>

            <tr class="boldText">
                <td>NO</td>
                <td colspan="2">ASPEK</td>
                <td>NILAI</td>
            </tr>
            <tr class="boldText">
                <td>A</td>
                <td colspan="3">NILAI-NILAI PERUSAHAAN DAN PERILAKU</td>
            </tr>
            <tr>
                <td style="text-align:right;">1</td>
                <td colspan="2">Kerjasama</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">2</td>
                <td colspan="2">Komunikasi</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">3</td>
                <td colspan="2">Kedisiplinan</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">4</td>
                <td colspan="2">Dedikasi dan Integritas</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">5</td>
                <td colspan="2">Etika</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr class="semiBoldText">
                <td colspan="3" class="text-right">Jumlah A</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr class="boldText">
                <td class="text-right">B</td>
                <td colspan="3" class="text-left">SASARAN KINERJA DAN PROSES PENCAPAIAN</td>
            </tr>
            <tr>
                <td style="text-align:right;">1</td>
                <td colspan="2">Goal</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">2</td>
                <td colspan="2">Error</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">3</td>
                <td colspan="2">Dokumentasi</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">4</td>
                <td colspan="2">Inisiatif</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">5</td>
                <td colspan="2">Pola Pikir</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr class="semiBoldText">
                <td colspan="3" class="text-right">Jumlah B</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr class="boldText">
                <td class="text-right">C</td>
                <td colspan="3" class="text-left">LEADERSHIP</td>
            </tr>
            <tr>
                <td style="text-align:right;">1</td>
                <td colspan="2">Strategi - Perencanaan</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">2</td>
                <td colspan="2">Strategi – Pengawasan</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">3</td>
                <td colspan="2">Strategi - Inovasi</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">4</td>
                <td colspan="2">Kepemimpinan</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">5</td>
                <td colspan="2">Membimbingan dan Membangun</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr>
                <td style="text-align:right;">6</td>
                <td colspan="2">Pengambilan keputusan</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr class="semiBoldText">
                <td colspan="3" class="text-right">Jumlah C</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr class="boldText">
                <td colspan="3" class="text-right">Skor Akhir DP3</td>
                <td style="text-align:right;">.</td>
            </tr>
            <tr style="font-size: 0.9em;background-color: #fff;">
                <td colspan="2">
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
                <td colspan="2">
                    <table>
                        <tr>
                            <td>Nilai Kinerja</td>
                            <td style="text-align:right;">.</td>
                        </tr>
                        <tr>
                            <td>Kriteria</td>
                            <td>.</td>
                        </tr>
                        <tr>
                            <td>Point</td>
                            <td style="text-align:right;">.</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="floatRight">
            <tr>
                <td class="px-4" style="text-align:center;">
                    <p style="text-align:left !important;">Bandung,</p>
                    <span class="font-weight-bold">
                        PT PINDAD MEDIKA UTAMA
                    </span>
                </td>
            </tr>
            <tr>
                <td style="height: 2.6em;"></td>
            </tr>
            <tr>
                <td class="font-weight-bold" style="text-align:center;">
                    <u>Novita Indah Fitriyani</u><br>
                    <span>Kepala Bidang HC</span>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>