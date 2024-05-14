<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Npp</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Kepemimpinan</th>
            <th>Sasaran</th>
            <th>Perilaku</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->identitas_dinilai->npp_karyawan }}</td>
                <td>{{ $p->identitas_dinilai->nama_karyawan }}</td>
                <td>{{ $p->identitas_dinilai->level_jabatan }}</td>
                <td>{{ round($p->sum_k1 * 100, 2) }}</td>
                <td>{{ round($p->sum_k2 * 100, 2) }}</td>
                <td>{{ round($p->sum_k3 * 100, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
