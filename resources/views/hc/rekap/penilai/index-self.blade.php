@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Penilai' }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-secondary mb-4" id="btnRekapPerilakuModal">
                                    <i class="far fa-plus-square"></i> Rekap Penilai Self
                                </button>
                                <ul class="list-inline">
                                    <li class="list-inline-item">B-A (Aspek)</li>
                                    <li class="list-inline-item">&sum; (Total Dp3)</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap2">
                                    <thead>
                                        <tr>
                                            <th colspan='5'>Identitas</th>
                                            <th>Kepemimpinan</th>
                                            <th>Perilaku</th>
                                            <th>Sasaran</th>
                                            <th>Total DP3</th>
                                            <th rowspan='2'>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp Penilai</th>
                                            <th>Jabatan Penilai</th>
                                            <th>Npp Dinilai</th>
                                            <th>Jabatan Dinilai</th>
                                            <th>B-A</th>
                                            <th>B-A</th>
                                            <th>B-A</th>
                                            <th>&sum; DP3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_penilai as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->relasi_karyawan->npp_karyawan}}</td>
                                        <td>{{$p->relasi_karyawan->level_jabatan}}</td>
                                        <td>{{$p->npp_dinilai}}</td>
                                        <td>{{$p->jabatan_dinilai}}</td>
                                        <td>{{$p->sum_nilai_k_bobot_aspek}}</td>
                                        <td>{{$p->sum_nilai_p_bobot_aspek}}</td>
                                        <td>{{$p->sum_nilai_s_bobot_aspek}}</td>
                                        <td>{{$p->sum_nilai_dp3}}</td>
                                        <td>
                                            <a href="/penilai-rekap/penilai?id={{$p->id}}" target="_blank" class="btn btn-sm btn-warning">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
    <script>
        $("#dataTablesRekap2").DataTable({
            ordering: false,
            scrollCollapse: true,
            searching : true,
            scrollX: false,
            scrollY: '50vh',
        });
    </script>
@endpush

@push('scripts')
<script>
$(document).ready(function(e){
    async function swalAjax()
    {
        // let clears = true;
        const uri = '/penilai-rekap/calculate?relasi=self';
        $.ajax({
            // url : '/skor-pool-staff?refresh='+clears,
            url :uri,
            type : 'get',
            dataType: 'json',
            success : function (response){
                console.log(response)
            }
        });
    }

    async function swalOk()
    {
        Swal.fire({
            title: "success",
            text: "anda menarik data dari database, muat ulang halaman",
            icon: "success"
        });
    }

    async function alertswal(title, text, icon, confirmButtonText)
    {
        Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmButtonText,
        cancelButtonText: "batal"
        }).then((result) => {
            if (result.isConfirmed) {
                swalAjax();
                swalOk();
            }
        });
    }

    $('#btnRekapPerilakuModal').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan rekap perilaku tanpa bobot data pada database',
            'warning',
            'Pool saja'
            );
    });
});
</script>
@endpush