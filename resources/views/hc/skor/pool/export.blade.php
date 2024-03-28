<table>
    <thead> 
        <tr>
            <th>No</th>
            <th>Penilai</th>
            <th>Dinilai</th>
            <th>Jabatan Dinilai</th>
            <th>K1</th>
            <th>K2</th>
            <th>K3</th>
            <th>K4</th>
            <th>K5</th>
            <th>K6</th>
            <th>P1</th>
            <th>P2</th>
            <th>P3</th>
            <th>P4</th>
            <th>P5</th>
            <th>S1</th>
            <th>S2</th>
            <th>S3</th>
            <th>S4</th>
            <th>S5</th>
            <th>Sum</th>
            <th>Relasi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pool_skor as $pool)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pool->karyawan->npp_karyawan }}</td>
            <td>{{ $pool['npp_dinilai'] }}</td>
            <td>{{ $pool['jabatan_dinilai'] }}</td>
            <td>{{ $pool['strategi_perencanaan'] }}</td>
            <td>{{ $pool['strategi_pengawasan'] }}</td>
            <td>{{ $pool['strategi_inovasi'] }}</td>
            <td>{{ $pool['kepemimpinan'] }}</td>
            <td>{{ $pool['membimbing_membangun'] }}</td>
            <td>{{ $pool['pengambilan_keputusan'] }}</td>
            <td>{{ $pool['kerjasama'] }}</td>
            <td>{{ $pool['komunikasi'] }}</td>
            <td>{{ $pool['absensi'] }}</td>
            <td>{{ $pool['integritas'] }}</td>
            <td>{{ $pool['etika'] }}</td>
            <td>{{ $pool['goal_kinerja'] }}</td>
            <td>{{ $pool['error_kinerja'] }}</td>
            <td>{{ $pool['proses_dokumen'] }}</td>
            <td>{{ $pool['proses_inisiatif'] }}</td>
            <td>{{ $pool['proses_polapikir'] }}</td>
            <td>{{ $pool['sum_nilai'] }}</td>
            <td>{{ $pool['relasi'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>