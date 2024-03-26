@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap DP3' }}</h1>
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
                                <button type="button" class="btn btn-info mb-4" id="btnRekapPenilaiModal">
                                <i class="fas fa-calculator px-2"></i>Rekap Nilai DP3
                                </button>
                                <ul class="list-inline">
                                    <li class="list-inline-item">B-A (Bobot Aspek)</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap2">
                                    <thead>
                                        <tr>
                                            <th rowspan='2' colspan='3'>Identitas Dinilai</th>
                                            <th colspan='4'>Aspek</th>
                                            <th rowspan='2' colspan='4'>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>Kepemimpinan</th>
                                            <th>Perilaku</th>
                                            <th>Sasaran</th>
                                            <th>DP3</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp</th>
                                            <th>Jabatan</th>
                                            <th>B-A</th>
                                            <th>B-A</th>
                                            <th>B-A</th>
                                            <th>Self</th>
                                            <th>Atasan</th>
                                            <th>Rekan</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_penilai as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->npp_dinilai}}</td>
                                        <td>{{$p->jabatan_dinilai}}</td>
                                        <td>{{round($p->sum_k1 * 100,3)}}</td>
                                        <td>{{round($p->sum_k2 * 100,3)}}</td>
                                        <td>{{round($p->sum_k3 * 100,3)}}</td>
                                        <td>
                                            <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=self" target="_blank" class="btn btn-sm btn-warning">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=atasan" target="_blank" class="btn btn-sm btn-warning">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=rekanan" target="_blank" class="btn btn-sm btn-warning">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=staff" target="_blank" class="btn btn-sm btn-warning">
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
        const uri = '/penilai-rekap/calculate?relasi=all';
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

    $('#btnRekapPenilaiModal').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan rekap semua penilai',
            'warning',
            'Pool saja'
            );
    });
});
</script>
@endpush