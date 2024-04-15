<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Npp</th>
            <th>Jabatan</th>
            <th>B-A</th>
            <th>B-A</th>
            <th>B-A</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->npp_dinilai }}</td>
                <td>{{ $p->jabatan_dinilai }}</td>
                <td>{{ round($p->sum_k1 * 100, 3) }}</td>
                <td>{{ round($p->sum_k2 * 100, 3) }}</td>
                <td>{{ round($p->sum_k3 * 100, 3) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
