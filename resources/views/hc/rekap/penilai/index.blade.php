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
                                <div class="d-flex flex-row bd-highlight">
                                    <div class="px-2 bd-highlight">        
                                        <button type="button" class="btn btn-info" id="btnRekapPenilaiModal">
                                            <i class="fas fa-calculator px-2"></i>Rekap Nilai DP3
                                        </button>
                                    </div>
                                    <div class="px-2 bd-highlight">
                                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-file-export px-1"></i>Export
                                            </button>
                                            <div class="dropdown-menu">
                                                <span class="dropdown-item-text">Raw Bobot</span>
                                                <form action="{{route('penilai-rekap-export-raw-xlsx')}}" 
                                                    method="post" 
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">xlsx
                                                    </button>
                                                </form>
                                                <form action="{{route('penilai-rekap-export-raw-csv')}}" 
                                                    method="post" 
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">csv
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <span class="dropdown-item-text">Group Bobot</span>
                                                <form action="{{route('penilai-rekap-export-xlsx')}}" 
                                                    method="post" 
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">xlsx
                                                    </button>
                                                </form>
                                                <form action="{{route('penilai-rekap-export-csv')}}" 
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
                                    <div class="p-2 bd-highlight">        
                                        <ul class="list-inline">
                                            <li class="list-inline-item">B-A (Bobot Aspek)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap2">
                                    <thead>
                                        <tr>
                                            <th colspan='3'>Identitas</th>
                                            <th colspan='3'>Aspek</th>
                                            <th rowspan='2'>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp</th>
                                            <th>Jabatan</th>
                                            <th>Kepemimpinan</th>
                                            <th>Perilaku</th>
                                            <th>Sasaran</th>
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
                                            <div class="btn-toolbar d-flex justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=self" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="far fa-eye px-1"></i>Self
                                                    </a>
                                                </div>
                                                <div class="btn-group mr-2" role="group" aria-label="Second group">
                                                <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=atasan" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="far fa-eye px-1"></i>Atasan
                                                </a>
                                                </div>
                                                <div class="btn-group mr-2" role="group" aria-label="Third group">
                                                    <a href="/penilai-rekap/detail?dinilai={{$p->npp_dinilai}}&relasi=rekanan" target="_blank" class="btn btn-sm btn-success">
                                                        <i class="far fa-eye px-1"></i>Rekanan
                                                    </a>
                                                </div>
                                                <!-- <a href="/penilai-rekap/detail/staff?dinilai={{$p->npp_dinilai}}" target="_blank" class="btn btn-sm btn-warning">
                                                    <i class="far fa-eye px-1"></i>
                                                </a> -->
                                                <div class="btn-group mr-2" role="group" aria-label="Third group">
                                                    <button type="button" class="btn btn-warning btn-sm btnInfoStaff" data-toggle="modal" data-target="#staffModal" data-npp-dinilai='{{$p->npp_dinilai}}' data-rekap-id="{{$p->id}}">
                                                        <i class="far fa-eye px-1"></i>Staff
                                                    </button>
                                                </div>
                                            </td>
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

@push('modals')
<!-- Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staffModalLabel">List Staff</h5>
      </div>
      <div class="modal-body staffModalBody">
        <p class="text-center"><em>tunggu...</em></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
<script>
var request_staff = null;
$('.btnInfoStaff').on('click', function()
{
    // alert('ok hooked');
    let id = $(this).attr('data-npp-dinilai')
    let rekapId = $(this).attr('data-rekap-id')
    // console.log(id);
    const uri = `/penilai-rekap/detail/staff?dinilai=${id}`
    if(request_staff && request_staff.readyState != 2){
        request_staff.abort();
    }
    request_staff = $.ajax({
        url : uri,
        type : 'get',
        dataType: 'json',
        success : function (response){
            const local_uri = `/penilai-rekap/detail/staff/detail?dinilai=`;
            var len = 0;
            if(response['data'] != null){
                len = response['data'].length;
            }
            var head = `<div class="list-group">`;
                $('.staffModalBody').empty();
                $('.staffModalBody').prepend(head);
            if(len > 0){
                for(var i=0; i<len;i++){
                    var id = response['data'][i].id;
                    var identitasNamaStaff = response['data'][i].identitas_staff.nama_karyawan;
                    var identitasNppStaff = response['data'][i].identitas_staff.npp_karyawan;
                    var identitaIdStaff = response['data'][i].identitas_staff.id;
                    var parentStaff = response['data'][i].parent_staff.npp_karyawan;
                    // var nppStaff = response['data'][i].npp_staff;
                    var option = `<a href="${local_uri+parentStaff+'&penilai='+identitaIdStaff+'&relasi=staff'}" 
                        class="list-group-item list-group-item-action" 
                        target="_blank"
                        data-parent-npp=${parentStaff}
                        data-staff-id=${identitaIdStaff}>${identitasNppStaff} - ${identitasNamaStaff}
                        <i class="fas fa-hand-point-left px-2"></i>
                        </a>`;
                    $('.staffModalBody').append(option);
                }
            }else{
                let content = `<p class="text-center"><em>tidak memiliki staff</em></p>`;
                $('.staffModalBody').html(content);
            }
            var tail = `</div>`;
        }
    })
})

$('#staffModal').on('hidden.bs.modal', function(e){
    e.preventDefault();
    // alert('modal closed')
    let content = `<p class="text-center"><em>tunggu...</em></p>`;
    $('.staffModalBody').empty();
    $('.staffModalBody').html(content);
})

var table = $("#dataTablesRekap2").DataTable({
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
        const uri = '/penilai-rekap/calculate?relasi=all';
        $.ajax({
            url :uri,
            type : 'get',
            dataType: 'json',
            success : function (response){
                // console.log(response);
                let msg = JSON.stringify(response.text.message);
                swalOk(response.title, msg, response.icon);
                setTimeout(() => {
                    location.reload()
                }, 10000);
            },
            error : function (response){
                swalOk(response.title, JSON.stringify(response.text.message), response.icon);
                setTimeout(() => {
                    location.reload()
                }, 10000);
            }
        });
    }

    async function swalOk(title,text,icon)
    {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
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
                setTimeout(() => {
                    swalAjax();
                }, 1000);
            }
        });
    }

    $('#btnRekapPenilaiModal').on('click', function(ev){
        ev.preventDefault();
        alertswal(
            'anda yakin',
            'anda melakukan rekap semua penilai',
            'warning',
            'Iya'
        );
    });
});
</script>
@endpush