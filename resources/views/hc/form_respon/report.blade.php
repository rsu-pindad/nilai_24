<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .table td,
        .table th {
            padding: 0.10rem 0.75rem 0.10rem 0.75rem;
        }
    </style>
</head>

<body>
    <h6 class="text-center">LAPORAN HASIL KINERJA PEGAWAI</h6>
    <h6 class="text-center">LEVEL {{ $dp3Calculated->employee->level }}</h6>
    <table class="table table-bordered small">
        <tbody>
            <tr>
                <td class="font-weight-bold">Nama</td>
                <td>{{ $dp3Calculated->employee->nama }}</td>
                <td class="font-weight-bold">Penempatan</td>
                <td>{{ $dp3Calculated->employee->penempatan }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">NPP</td>
                <td>{{ $dp3Calculated->employee->npp }}</td>
                <td class="font-weight-bold">Unit</td>
                <td>{{ $dp3Calculated->employee->unit }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Jabatan</td>
                <td>{{ $dp3Calculated->employee->jabatan }}</td>
                <td class="font-weight-bold">Masa Penilaian</td>
                <td>{{ '01-01-2022 sd 31-12-2022' }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <tr class="font-weight-bold">
                <td>NO</td>
                <td colspan="2">FAKTOR</td>
                <td>NILAI</td>
            </tr>
            <tr class="font-weight-bold">
                <td>A</td>
                <td colspan="3">KEPEMIMPINAN</td>
            </tr>
            <tr>
                <td>1</td>
                <td colspan="2">STRATEGI PERENCANAAN</td>
                <td>{{ $calculateFactor['kpmn_perencanaan'] }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td colspan="2">STRATEGI PENGAWASAN</td>
                <td>{{ $calculateFactor['kpmn_pengawasan'] }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td colspan="2">STRATEGI INOVASI</td>
                <td>{{ $calculateFactor['kpmn_inovasi'] }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td colspan="2">KEPEMIMPINAN</td>
                <td>{{ $calculateFactor['kpmn_kepemimpinan'] }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td colspan="2">MEMBIMBING & MEMBANGUN</td>
                <td>{{ $calculateFactor['kpmn_membimbing'] }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td colspan="2">PENGAMBILAN KEPUTUSAN</td>
                <td>{{ $calculateFactor['kpmn_keputusan'] }}</td>
            </tr>
            <tr class="font-weight-bold">
                <td colspan="3">JUMLAH A</td>
                <td>{{ $totalFactor['kpmn'] }}</td>
            </tr>

            <tr class="font-weight-bold">
                <td>B</td>
                <td colspan="3">NILAI PERUSAHAAN & PRILAKU</td>
            </tr>
            <tr>
                <td>1</td>
                <td colspan="2">KERJASAMA</td>
                <td>{{ $calculateFactor['nnpp_kerjasama'] }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td colspan="2">KOMUNIKASI</td>
                <td>{{ $calculateFactor['nnpp_komunikasi'] }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td colspan="2">DISIPLIN & KEHADIRAN</td>
                <td>{{ $calculateFactor['nnpp_disiplin'] }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td colspan="2">DEDIKASI & INTEGRITAS</td>
                <td>{{ $calculateFactor['nnpp_dedikasi'] }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td colspan="2">ETIKA</td>
                <td>{{ $calculateFactor['nnpp_etika'] }}</td>
            </tr>
            <tr class="font-weight-bold">
                <td colspan="3">JUMLAH B</td>
                <td>{{ $totalFactor['nnpp'] }}</td>
            </tr>

            <tr class="font-weight-bold">
                <td>C</td>
                <td colspan="3">TUGAS SASARAN KINERJA & PROFESI</td>
            </tr>
            <tr>
                <td>1</td>
                <td colspan="2">GOAL PENCAPAIAN</td>
                <td>{{ $calculateFactor['skpp_goal'] }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td colspan="2">ERROR PENCAPAIAN</td>
                <td>{{ $calculateFactor['skpp_error'] }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td colspan="2">PROSES - PENCAPAIAN KINERJA (DOKUMEN)</td>
                <td>{{ $calculateFactor['skpp_dokumen'] }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td colspan="2">PROSES - PENCAPAIAN KINERJA (INISIATIF)</td>
                <td>{{ $calculateFactor['skpp_inisiatif'] }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td colspan="2">PROSES - PENCAPAIAN KINERJA (POLA PIKIR)</td>
                <td>{{ $calculateFactor['skpp_pola_pikir'] }}</td>
            </tr>
            <tr class="font-weight-bold">
                <td colspan="3">JUMLAH C</td>
                <td>{{ $totalFactor['skpp'] }}</td>
            </tr>

            <tr class="font-weight-bold">
                <td colspan="3">TOTAL D = A + B + C</td>
                <td>{{ $dp3Calculated->total_nilai }}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>D <span style="font-family: DejaVu Sans;">&gt;</span> 95</td>
                                <td>Sangat Baik</td>
                            </tr>
                            <tr>
                                <td>D <span style="font-family: DejaVu Sans;">&#62;</span> 85 <span
                                        style="font-family: DejaVu Sans;">&le;</span> 95</td>
                                <td>Baik</td>
                            </tr>
                            <tr>
                                <td>D <span style="font-family: DejaVu Sans;">&#62;</span> 65 <span
                                        style="font-family: DejaVu Sans;">&le;</span> 85</td>
                                <td>Cukup</td>
                            </tr>
                            <tr>
                                <td>D <span style="font-family: DejaVu Sans;">&#62;</span> 50 <span
                                        style="font-family: DejaVu Sans;">&le;</span> 65</td>
                                <td>Kurang</td>
                            </tr>
                            <tr>
                                <td>D <span style="font-family: DejaVu Sans;">&#8804;</span> 50</td>
                                <td>Sangat Kurang</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td colspan="2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Nilai Kinerja</td>
                                <td>{{ $dp3Calculated->total_nilai }}</td>
                            </tr>
                            <tr>
                                <td>Kriteria</td>
                                <td>{{ $dp3Calculated->kriteria }}</td>
                            </tr>
                            <tr>
                                <td>Poin</td>
                                <td>{{ $dp3Calculated->nilai_dp3 }}</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="float-right table-borderless text-center small ">
        <tbody>
            <tr>
                <td class="px-4">
                    <span>Bandung, {{ $today }}</span> <br>
                    <span class="font-weight-bold">
                        PT PINDAD MEDIKA UTAMA

                    </span>
                </td>
            </tr>
            <tr>
                <td style="height: 60px"></td>
            </tr>
            <tr>
                <td class="font-weight-bold">
                    <span>{{ $signatureName }}</span><br>
                    <span>{{ $position }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
