@extends('templates.main')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Google Form Tarik Response' }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-secondary" id="btnPullResponse">
                                <i class="fas fa-arrow-down px-2"></i>Tarik Response Form
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="dataTablesPull">
                                    <thead>
                                        <th>No</th>
                                        <th>NPP Penilai</th>
                                        <th>Nama Penilai</th>
                                        <th>NPP Dinilai</th>
                                        <th>Nama Dinilai</th>
                                        <th>Jabatan Dinilai</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($grespon_data as $gres)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gres->npp_penilai }}</td>
                                            <td>{{ $gres->nama_penilai }}</td>
                                            <td>{{ $gres->npp_dinilai }}</td>
                                            <td>{{ $gres->nama_dinilai }}</td>
                                            <td>{{ $gres->jabatan_dinilai }}</td>
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
$('#dataTablesPull').DataTable({
    responsive: true,
    ordering: false,
    scrollX: false,
    scrollY: '25vh',
    searching : false,
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function(e){

    async function swalAjax()
    {
        const uri = '/gform/pull';
        $.ajax({
            url : uri,
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
            text: "anda menarik data dari form google sheet, muat ulang halaman",
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

    $('#btnPullResponse').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan pull(tarik) data pada sheet google response',
            'warning',
            'Pull saja'
            );
    });

});
</script>
@endpush