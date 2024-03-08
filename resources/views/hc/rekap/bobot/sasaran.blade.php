@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Bobot Sasaran' }}</h1>
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
                                <button type="button" class="btn btn-secondary mb-4" id="btnRekapSasaranModal">
                                    <i class="far fa-plus-square"></i> Rekap Bobot Sasaran
                                </button>
                                <ul class="list-inline">
                                    <li class="list-inline-item">SE (Self)</li>
                                    <li class="list-inline-item">AT (Atasan)</li>
                                    <li class="list-inline-item">RE (Rekanan / Selevel)</li>
                                    <li class="list-inline-item">ST (Staff)</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="px-4">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap1">
                                    <thead>
                                        <tr>
                                            <th colspan='2' rowspan='2'>Identitas</th>
                                            <th colspan='27'>Sasaran ([1|25%] [2|30%] [3|35%] [4A|60%] [4B/5|65%])</th>
                                        </tr>
                                        <tr>
                                            <th colspan='5'>Goal</th>
                                            <th colspan='5'>Error</th>
                                            <th colspan='5'>Dokumen</th>
                                            <th colspan='5'>Inisiatif</th>
                                            <th colspan='5'>Polapikir</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp Dinilai</th>
                                            <th>SE</th>
                                            <th>AT</th>
                                            <th>RE</th>
                                            <th>ST</th>
                                            <th>S1</th>
                                            <th>SE</th>
                                            <th>AT</th>
                                            <th>RE</th>
                                            <th>ST</th>
                                            <th>S2</th>
                                            <th>SE</th>
                                            <th>AT</th>
                                            <th>RE</th>
                                            <th>ST</th>
                                            <th>S3</th>
                                            <th>SE</th>
                                            <th>AT</th>
                                            <th>RE</th>
                                            <th>ST</th>
                                            <th>S4</th>
                                            <th>SE</th>
                                            <th>AT</th>
                                            <th>RE</th>
                                            <th>ST</th>
                                            <th>S5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bobot_sasaran_data as $bs)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$bs->relasi_karyawan->npp_karyawan}}</td>
                                            <td>{{$bs->sb_1_self}}</td>
                                            <td>{{$bs->sb_1_atasan}}</td>
                                            <td>{{$bs->sb_1_rekan}}</td>
                                            <td>{{$bs->sb_1_staff}}</td>
                                            <td>{{$bs->sum_sb_1}}</td>
                                            <td>{{$bs->sb_2_self}}</td>
                                            <td>{{$bs->sb_2_atasan}}</td>
                                            <td>{{$bs->sb_2_rekan}}</td>
                                            <td>{{$bs->sb_2_staff}}</td>
                                            <td>{{$bs->sum_sb_2}}</td>
                                            <td>{{$bs->sb_3_self}}</td>
                                            <td>{{$bs->sb_3_atasan}}</td>
                                            <td>{{$bs->sb_3_rekan}}</td>
                                            <td>{{$bs->sb_3_staff}}</td>
                                            <td>{{$bs->sum_sb_3}}</td>
                                            <td>{{$bs->sb_4_self}}</td>
                                            <td>{{$bs->sb_4_atasan}}</td>
                                            <td>{{$bs->sb_4_rekan}}</td>
                                            <td>{{$bs->sb_4_staff}}</td>
                                            <td>{{$bs->sum_sb_4}}</td>
                                            <td>{{$bs->sb_5_self}}</td>
                                            <td>{{$bs->sb_5_atasan}}</td>
                                            <td>{{$bs->sb_5_rekan}}</td>
                                            <td>{{$bs->sb_5_staff}}</td>
                                            <td>{{$bs->sum_sb_5}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                </div>
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
    paging: false,
    scrollCollapse: true,
    lengthChange : false,
    searching : false,
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
            url : '/rekap/get-bobot-sasaran?refresh='+clears,
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

    $('#btnRekapSasaranModal').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan rekap sasaran bobot data pada database',
            'warning',
            'Pool saja'
            );
    });

});
</script>
@endpush