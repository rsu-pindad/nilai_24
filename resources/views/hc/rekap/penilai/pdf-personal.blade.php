<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Personal DP3</title>

    <!-- <link rel="stylesheet" href="{{public_path('/dist/css/adminlte.css')}}"> -->

    <!-- <script src="{{public_path('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            font-family: Georgia, serif;
            background: none;
            color: black;
            margin-top: 2cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 2cm;
        }

        .styled-table,{
            /* border: 1px solid black; */
            /* padding: 0.1rem 0.50rem 0.1rem 0.50rem; */
            border-collapse: collapse;
            margin: 16px 0;
            font-size: 0.8em;
            font-family: DejaVu Sans;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            /* width: 100%; */
        }
        .center{
            margin-left: auto;
            margin-right: auto;
        }
        /* .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        } */
        .styled-table th,
        .styled-table td {
            padding: 2px 16px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
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
        height: px;
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
            text-align:center;
        }
        .alt-two h1:before {
            left:50%; margin-left:-30px;
        }

        .boldText { font-weight:bold; }
        .semiBoldText { font-weight:600; }

        .floatRight{
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
        <img src="{{ public_path('/dist/img/logo.png')}}" alt="Logo" width="18%" height="100%">
    </header>
    <div class="watermark">RSU PINDAD <br>CONFIDENTIAL</div>
    <main>
    <div class="two alt-two">
        <h1>Laporan Hasil Kinerja Pegawai
            <span>Level {{$level}}</span>
        </h1>
    </div>
    <table class="styled-table center">
        <tr>
            <td class="boldText">Nama</td>
            <td>{{$nama}}</td>
            <td class="boldText">Penempatan</td>
            <td>{{$unit}}</td>
        </tr>
        <tr>
            <td class="boldText">NPP</td>
            <td>{{$npp}}</td>
            <td class="boldText">Unit</td>
            <td>RSUP Bandung</td>
        </tr>
        <tr>
            <td class="boldText">Jabatan</td>
            <td>{{$level}}</td>
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
            <td style="text-align:right;">{{round($p1 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">2</td>
            <td colspan="2">Komunikasi</td>
            <td style="text-align:right;">{{round($p2 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">3</td>
            <td colspan="2">Kedisiplinan</td>
            <td style="text-align:right;">{{round($p3 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">4</td>
            <td colspan="2">Dedikasi dan Integritas</td>
            <td style="text-align:right;">{{round($p4 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">5</td>
            <td colspan="2">Etika</td>
            <td style="text-align:right;">{{round($p5 * 100)}}</td>
        </tr>
        <tr class="semiBoldText">
            <td colspan="3" class="text-right">Jumlah A</td>
            <td style="text-align:right;">{{round($raspek_p * 100)}}</td>
        </tr>
        <tr class="boldText">
            <td class="text-right">B</td>
            <td colspan="3" class="text-left">SASARAN KINERJA DAN PROSES PENCAPAIAN</td>
        </tr>
        <tr>
            <td style="text-align:right;">1</td>
            <td colspan="2">Goal</td>
            <td style="text-align:right;">{{round($s1 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">2</td>
            <td colspan="2">Error</td>
            <td style="text-align:right;">{{round($s2 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">3</td>
            <td colspan="2">Dokumentasi</td>
            <td style="text-align:right;">{{round($s3 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">4</td>
            <td colspan="2">Inisiatif</td>
            <td style="text-align:right;">{{round($s4 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">5</td>
            <td colspan="2">Pola Pikir</td>
            <td style="text-align:right;">{{round($s5 * 100)}}</td>
        </tr>
        <tr class="semiBoldText">
            <td colspan="3" class="text-right">Jumlah B</td>
            <td style="text-align:right;">{{round($raspek_s * 100)}}</td>
        </tr>
        <tr class="boldText">
            <td class="text-right">B</td>
            <td colspan="3" class="text-left">LEADERSHIP</td>
        </tr>
        <tr>
            <td style="text-align:right;">1</td>
            <td colspan="2">Strategi - Perencanaan</td>
            <td style="text-align:right;">{{round($k1 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">2</td>
            <td colspan="2">Strategi – Pengawasan</td>
            <td style="text-align:right;">{{round($k2 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">3</td>
            <td colspan="2">Strategi - Inovasi</td>
            <td style="text-align:right;">{{round($k3 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">4</td>
            <td colspan="2">Kepemimpinan</td>
            <td style="text-align:right;">{{round($k4 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">5</td>
            <td colspan="2">Membimbingan dan Membangun</td>
            <td style="text-align:right;">{{round($k5 * 100)}}</td>
        </tr>
        <tr>
            <td style="text-align:right;">6</td>
            <td colspan="2">Pengambilan keputusan</td>
            <td style="text-align:right;">{{round($k6 * 100)}}</td>
        </tr>
        <tr class="semiBoldText">
            <td colspan="3" class="text-right">Jumlah C</td>
            <td style="text-align:right;">{{round($raspek_k * 100)}}</td>
        </tr>
        <!-- <tr class="semiBoldText">
            <td colspan="3" class="text-right">Jumlah A+B+C</td>
            <td>{{round((($raspek_k + $raspek_s + $raspek_p) * 100),2)}}</td>
        </tr> -->
        <tr class="boldText">
            <td colspan="3" class="text-right">Skor Akhir DP3</td>
            <td style="text-align:right;">{{round($total_raspek,1)}}</td>
        </tr>
        <tr style="font-size: 0.9em;">
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
                        <td style="text-align:right;">{{round($total_raspek,1)}}</td>
                    </tr>
                    <tr>
                        <td>Kriteria</td>
                        <td>{{$kriteria_dp3}}</td>
                    </tr>
                    <tr>
                        <td>Point</td>
                        <td style="text-align:right;">{{$point_dp3}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
    </table>
    <table class="floatRight">
        <tbody>
            <tr>
                <td class="px-4" style="text-align:center;">
                    <span>Bandung,</span> {{$nows}}<br/>
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
        </tbody>
    </table>
    </main>  
</body>
</html>