@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Skor Akhir DP3' }}</h1>
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
                                    <i class="far fa-plus-square"></i> Hitung Skor Akhir DP3
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp Dinilai</th>
                                            <th>Jabatan Dinilai</th>
                                            <th>&sum; Skor Akhir DP3</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($personal as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->relasi_karyawan->npp_karyawan}}</td>
                                        <td>{{$p->relasi_karyawan->level_jabatan}}</td>
                                        <td>{{round($p->total)}}</td>
                                        <td class="p-2">
                                            <a href="/penilai-rekap/report?id={{$p->relasi_karyawan->id}}&npp={{$p->relasi_karyawan->npp_karyawan}}" target="_blank" class="btn btn-sm btn-danger">
                                                <i class="far fa-file-pdf"></i>
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
        });
    </script>
@endpush

@push('scripts')
<script>
$(document).ready(function(e){
    async function swalAjax()
    {
        const uri = '/penilai-rekap/calculate-dp3';
        $.ajax({
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