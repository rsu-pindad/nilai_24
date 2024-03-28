@extends('templates.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Tabel Perhitungan Skor Karyawan' }}</h1>
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
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-warning" id="btnSkorPoolModal">
                                            <i class="fas fa-calculator px-1"></i>Hitung
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-file-export px-1"></i>Export
                                        </button>
                                        <div class="dropdown-menu">
                                            <form action="{{route('skor-export')}}" 
                                                method="post" 
                                                class="dropdown-item btn btn-outline-info"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-sm">xlsx
                                                </button>
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{route('skor-export-csv')}}" 
                                                method="post" 
                                                class="dropdown-item btn btn-outline-info"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn btn-sm">csv
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="px-4">
                                <table class="table table-striped table-hover table-bordered table-responsive" id="dataTablesPoolSkor">
                                    <thead> 
                                        <tr>
                                            <th>No</th>
                                            <th>Penilai</th>
                                            <th>Dinilai</th>
                                            <th>Jabatan Dinilai</th>
                                            <th>K1</th>
                                            <th>K2</th>
                                            <th>K3</th>
                                            <th>K4</th>
                                            <th>K5</th>
                                            <th>K6</th>
                                            <th>P1</th>
                                            <th>P2</th>
                                            <th>P3</th>
                                            <th>P4</th>
                                            <th>P5</th>
                                            <th>S1</th>
                                            <th>S2</th>
                                            <th>S3</th>
                                            <th>S4</th>
                                            <th>S5</th>
                                            <th>Sum</th>
                                            <th>Relasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_pool_skor as $pool)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pool->karyawan->npp_karyawan }}</td>
                                            <td>{{ $pool['npp_dinilai'] }}</td>
                                            <td>{{ $pool['jabatan_dinilai'] }}</td>
                                            <td>{{ $pool['strategi_perencanaan'] }}</td>
                                            <td>{{ $pool['strategi_pengawasan'] }}</td>
                                            <td>{{ $pool['strategi_inovasi'] }}</td>
                                            <td>{{ $pool['kepemimpinan'] }}</td>
                                            <td>{{ $pool['membimbing_membangun'] }}</td>
                                            <td>{{ $pool['pengambilan_keputusan'] }}</td>
                                            <td>{{ $pool['kerjasama'] }}</td>
                                            <td>{{ $pool['komunikasi'] }}</td>
                                            <td>{{ $pool['absensi'] }}</td>
                                            <td>{{ $pool['integritas'] }}</td>
                                            <td>{{ $pool['etika'] }}</td>
                                            <td>{{ $pool['goal_kinerja'] }}</td>
                                            <td>{{ $pool['error_kinerja'] }}</td>
                                            <td>{{ $pool['proses_dokumen'] }}</td>
                                            <td>{{ $pool['proses_inisiatif'] }}</td>
                                            <td>{{ $pool['proses_polapikir'] }}</td>
                                            <td>{{ $pool['sum_nilai'] }}</td>
                                            <td>{{ $pool['relasi'] }}</td>
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
var table = $("#dataTablesPoolSkor").DataTable({
    ordering: false,
    scrollCollapse: false,
    responsive: true,
    searching : true,
    // scrollX: false,
    scrollY: '50vh',
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function(e){

    async function swalAjax()
    {
        const clears = true;
        const uri = '/skor-pool-all?refresh=';
        $.ajax({
            url : uri+clears,
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

    $('#btnSkorPoolModal').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda akan melakukan kalkulasi data pada form response',
            'warning',
            'Hitung saja'
            );
    });

});
</script>
@endpush