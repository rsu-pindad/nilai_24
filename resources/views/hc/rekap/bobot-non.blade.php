@extends('templates.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title ?? 'Rekap Non Bobot Kepemimpinan' }}</h1>
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
                            <button type="button" class="btn btn-secondary mb-4" id="btnRekapKepemimpinanModal">
                                <i class="far fa-plus-square"></i> Rekap Kepemimpinan
                            </button>
                            <ul class="list-inline">
                                <li class="list-inline-item">SE (Self)</li>
                                <li class="list-inline-item">AT (Atasan)</li>
                                <li class="list-inline-item">RE (Rekanan / Selevel)</li>
                                <li class="list-inline-item">ST (Staff)</li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-bordered" id="dataTablesRekap1">
                                <thead>
                                    <tr>
                                        <th colspan='3'>Identitas</th>
                                        <th colspan='4'>Perencanaan</th>
                                        <th colspan='4'>Pengawasan</th>
                                        <th colspan='4'>Inovasi</th>
                                        <th colspan='4'>Kepemimpinan</th>
                                        <th colspan='4'>Membangun</th>
                                        <th colspan='4'>Keputusan</th>
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Npp Dinilai</th>
                                        <th>Jabatan Dinilai</th>
                                        <th>SE</th>
                                        <th>AT</th>
                                        <th>RE</th>
                                        <th>ST</th>
                                        <th>SE</th>
                                        <th>AT</th>
                                        <th>RE</th>
                                        <th>ST</th>
                                        <th>SE</th>
                                        <th>AT</th>
                                        <th>RE</th>
                                        <th>ST</th>
                                        <th>SE</th>
                                        <th>AT</th>
                                        <th>RE</th>
                                        <th>ST</th>
                                        <th>SE</th>
                                        <th>AT</th>
                                        <th>RE</th>
                                        <th>ST</th>
                                        <th>SE</th>
                                        <th>AT</th>
                                        <th>RE</th>
                                        <th>ST</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($non_bobot_data as $non)
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>{{$non->relasi_karyawan->npp_karyawan}}</td>
                                        <td>{{$non->jabatan_dinilai}}</td>
                                        <td>{{$non->k_1_self}}</td>
                                        <td>{{$non->k_1_atasan}}</td>
                                        <td>{{$non->k_1_rekan}}</td>
                                        <td>{{$non->k_1_staff}}</td>
                                        <td>{{$non->k_2_self}}</td>
                                        <td>{{$non->k_2_atasan}}</td>
                                        <td>{{$non->k_2_rekan}}</td>
                                        <td>{{$non->k_2_staff}}</td>
                                        <td>{{$non->k_3_self}}</td>
                                        <td>{{$non->k_3_atasan}}</td>
                                        <td>{{$non->k_3_rekan}}</td>
                                        <td>{{$non->k_3_staff}}</td>
                                        <td>{{$non->k_4_self}}</td>
                                        <td>{{$non->k_4_atasan}}</td>
                                        <td>{{$non->k_4_rekan}}</td>
                                        <td>{{$non->k_4_staff}}</td>
                                        <td>{{$non->k_5_self}}</td>
                                        <td>{{$non->k_5_atasan}}</td>
                                        <td>{{$non->k_5_rekan}}</td>
                                        <td>{{$non->k_5_staff}}</td>
                                        <td>{{$non->k_6_self}}</td>
                                        <td>{{$non->k_6_atasan}}</td>
                                        <td>{{$non->k_6_rekan}}</td>
                                        <td>{{$non->k_6_staff}}</td>
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
        $("#dataTablesRekap1").DataTable({
            /**
            fixedColumns: {
                left: 1,
                right: 1
            },
            fixedHeader: {
                header: true,
                footer: true
            },
            **/
            /** 
            scrollY: '50vh',
            responsive: true,
            **/
            autoWidth : false,
            ordering: false,
            paging: true,
            // scrollCollapse: true,
            // lengthChange : false,
            searching : true,
            scrollX: true
            
        });
    </script>
@endpush

@push('scripts')
<script>
   $(document).ready(function(e){

    async function swalAjax()
    {
        let clears = true;
        $.ajax({
            // url : '/skor-pool-staff?refresh='+clears,
            url : '/rekap/get-kepemimpinan?refresh='+clears,
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

    $('#btnRekapKepemimpinanModal').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan rekap kepimpinan tanpa bobot data pada database',
            'warning',
            'Pool saja'
            );
    });

});
</script>
@endpush