@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'GForm Relasi Karyawan' }}</h1>
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
                                <button type="button" class="btn btn-secondary" id="btnPullRelasiKaryawan">
                                    <i class="far fa-plus-square"></i> Pull Relasi Karyawan
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabelKaryawan">
                                    <thead>
                                        <th>No</th>
                                        <th>NPP</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th>Atasan</th>
                                        <th>Selevel</th>
                                        <th>Staff</th>
                                    </thead>
                                    <tbody>
                                        @foreach($karyawan_data as $karyawan)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$karyawan->npp_karyawan}}</td>
                                                <td>{{$karyawan->nama_karyawan}}</td>
                                                <td>{{$karyawan->level_jabatan}}</td>
                                                <td>
                                                    @forelse($karyawan->karyawan_atasan as $k_atasan)
                                                        {{$k_atasan->npp_atasan}}
                                                    @empty
                                                        -
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @forelse($karyawan->karyawan_selevel as $k_selevel)
                                                        {{$k_selevel->npp_selevel}}
                                                    @empty
                                                        -
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @forelse($karyawan->karyawan_staff as $k_staff)
                                                        {{$loop->iteration}}.{{$k_staff->npp_staff}}<br>
                                                    @empty
                                                        -
                                                    @endforelse
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @forelse()
                                        @empty
                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        @endforelse --}}
                                    <tbody>
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
$('#tabelKaryawan').DataTable({
    responsive: true,
    ordering: false,
    scrollX: false,
    scrollY: '50vh',
    searching : true,
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function(e){

    async function swalAjax()
    {
        return await $.ajax({
            url : '/relasi-karyawan/pull-level',
            type : 'get',
            dataType: 'json',
            success : function (response)
            {
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
            const results = swalAjax();
            console.log(results);
            if(results.status == true)
            {
                swalOk();
            }
        }
        }).catch((result) => {
            swalOk();
        });
    }

    $('#btnPullRelasiKaryawan').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan pool(kalkulasi) data pada database',
            'warning',
            'Pool saja'
            );
    });
});
</script>
@endpush