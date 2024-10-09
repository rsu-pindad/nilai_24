<table>
  <thead>
    <tr>
      <th>No</th>
      <th>NPP</th>
      <th>Nama</th>
      <th>Level</th>
      <th>Unit</th>  
      <th>strategi_perencanaan</th>
      <th>strategi_pengawasan</th>
      <th>strategi_inovasi</th>
      <th>kepemimpinan</th>
      <th>membimbing_membangun</th>
      <th>pengambilan_keputusan</th>
      <th>kerjasama</th>
      <th>komunikasi</th>
      <th>absensi</th>
      <th>integritas</th>
      <th>etika</th>
      <th>goal_kinerja</th>
      <th>error_kinerja</th>
      <th>proses_dokumen</th>
      <th>proses_inisiatif</th>
      <th>proses_polapikir</th>
      <th>sum_nilai_k</th>
      <th>sum_nilai_s</th>
      <th>sum_nilai_p</th>
      <th>sum_nilai_dp3</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rekap as $r)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $r['npp_karyawan'] }}</td>
        <td>{{ $r['nama_karyawan'] }}</td>
        <td>{{ $r['level_jabatan'] }}</td>
        <td>{{ $r['unit_jabatan'] }}</td>

        <td>{{ $r['strategi_perencanaan_konversi_aspek'] }}</td>
        <td>{{ $r['strategi_pengawasan_konversi_aspek'] }}</td>
        <td>{{ $r['strategi_inovasi_konversi_aspek'] }}</td>
        <td>{{ $r['kepemimpinan_konversi_aspek'] }}</td>
        <td>{{ $r['membimbing_membangun_konversi_aspek'] }}</td>
        <td>{{ $r['pengambilan_keputusan_konversi_aspek'] }}</td>

        <td>{{ $r['kerjasama_konversi_aspek'] }}</td>
        <td>{{ $r['komunikasi_konversi_aspek'] }}</td>
        <td>{{ $r['absensi_konversi_aspek'] }}</td>
        <td>{{ $r['integritas_konversi_aspek'] }}</td>
        <td>{{ $r['etika_konversi_aspek'] }}</td>

        <td>{{ $r['goal_kinerja_konversi_aspek'] }}</td>
        <td>{{ $r['error_kinerja_konversi_aspek'] }}</td>
        <td>{{ $r['proses_dokumen_konversi_aspek'] }}</td>
        <td>{{ $r['proses_inisiatif_konversi_aspek'] }}</td>
        <td>{{ $r['proses_polapikir_konversi_aspek'] }}</td>

        <td>{{ $r['sum_nilai_k_konversi_aspek'] }}</td>
        <td>{{ $r['sum_nilai_s_konversi_aspek'] }}</td>
        <td>{{ $r['sum_nilai_p_konversi_aspek'] }}</td>
        <td>{{ $r['sum_nilai_dp3'] }}</td>

      </tr>
    @endforeach
  </tbody>
</table>
