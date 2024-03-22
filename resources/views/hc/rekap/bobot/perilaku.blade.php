@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Bobot Perilaku' }}</h1>
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
                                    <i class="far fa-plus-square"></i> Rekap Bobot Perilaku
                                </button>
                                <ul class="list-inline">
                                    <li class="list-inline-item">SE (Self)</li>
                                    <li class="list-inline-item">AT (Atasan)</li>
                                    <li class="list-inline-item">RE (Rekanan / Selevel)</li>
                                    <li class="list-inline-item">ST (Staff)</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap1">
                                    <thead>
                                        <tr>
                                            <th colspan='2' rowspan='2'>Identitas</th>
                                            <th colspan='26'>Perilaku ([1|25%] [2|25%] [3|25%] [4A|30%] [4B/5|35%])</th>
                                        </tr>
                                        <tr>
                                            <th colspan='4'>Kerjasama</th>
                                            <th colspan='4'>Komunikasi</th>
                                            <th colspan='4'>Absensi</th>
                                            <th colspan='4'>Integritas</th>
                                            <th colspan='4'>Etika</th>
                                            <th colspan='4'>Summary</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp Dinilai</th>
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
                                            <th>&sum;SE</th>
                                            <th>&sum;AT</th>
                                            <th>&sum;RE</th>
                                            <th>&sum;ST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bobot_perilaku_data as $bp)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$bp->relasi_karyawan->npp_karyawan}}</td>
                                            <td>{{round($bp->pb_1_self,2)}}</td>
                                            <td>{{round($bp->pb_1_atasan,2)}}</td>
                                            <td>{{round($bp->pb_1_rekan,2)}}</td>
                                            <td>{{round($bp->pb_1_staff,2)}}</td>
                                            <td>{{round($bp->pb_2_self,2)}}</td>
                                            <td>{{round($bp->pb_2_atasan,2)}}</td>
                                            <td>{{round($bp->pb_2_rekan,2)}}</td>
                                            <td>{{round($bp->pb_2_staff,2)}}</td>
                                            <td>{{round($bp->pb_3_self,2)}}</td>
                                            <td>{{round($bp->pb_3_atasan,2)}}</td>
                                            <td>{{round($bp->pb_3_rekan,2)}}</td>
                                            <td>{{round($bp->pb_3_staff,2)}}</td>
                                            <td>{{round($bp->pb_4_self,2)}}</td>
                                            <td>{{round($bp->pb_4_atasan,2)}}</td>
                                            <td>{{round($bp->pb_4_rekan,2)}}</td>
                                            <td>{{round($bp->pb_4_staff,2)}}</td>
                                            <td>{{round($bp->pb_5_self,2)}}</td>
                                            <td>{{round($bp->pb_5_atasan,2)}}</td>
                                            <td>{{round($bp->pb_5_rekan,2)}}</td>
                                            <td>{{round($bp->pb_5_staff,2)}}</td>
                                            <td>{{round($bp->sum_pb_1_self,2)}}</td>
                                            <td>{{round($bp->sum_pb_1_atasan,2)}}</td>
                                            <td>{{round($bp->sum_pb_1_rekan,2)}}</td>
                                            <td>{{round($bp->sum_pb_1_staff,2)}}</td>
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
    ordering: false,
    scrollCollapse: true,
    searching : true,
    scrollX: true,
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
            url : '/rekap/get-bobot-perilaku?refresh='+clears,
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
            'anda melakukan rekap perilaku bobot data pada database',
            'warning',
            'Pool saja'
            );
    });

});
</script>
@endpush