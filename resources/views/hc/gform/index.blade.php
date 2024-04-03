@extends('templates.main')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Google Form Response' }}</h1>
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
                                <div class="d-flex flex-row bd-highlight">
                                    <div class="p-2 bd-highlight">
                                        <button type="button" class="btn btn-secondary btn-sm" id="btnPullResponse">
                                        <i class="fas fa-arrow-down px-2"></i>Tarik Response Form
                                        </button>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        <form action="{{ route('skor-reset') }}" method="Post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('ANDA YAKIN INGIN MENGKOSONGKAN TABEL')">
                                                <i class="fas fa-trash-alt px-2"></i>Kosongkan Table
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="dataTablesPull">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th colspan="2">Penilai</th>
                                            <th colspan="2">Dinilai</th>
                                            <th>Hari</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>NPP</th>
                                            <th>Nama</th>
                                            <th>NPP</th>
                                            <th>Nama</th>
                                            <th>Data Masuk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($grespon_data as $gres)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="javascript:void(0)" 
                                                    class="text-decoration-none lihatProfilePenilai"
                                                    data-penilai-id="{{$gres->relasi_penilai->id ?? ''}}"
                                                    data-penilai-npp="{{$gres->relasi_penilai->npp_karyawan ?? ''}}"
                                                    data-penilai-nama="{{$gres->relasi_penilai->nama_karyawan ?? ''}}"
                                                    data-penilai-level="{{$gres->relasi_penilai->level_jabatan ?? ''}}"
                                                    data-penilai-unit="{{$gres->relasi_penilai->unit_jabatan ?? ''}}"
                                                    >
                                                    {{ $gres->npp_penilai }}
                                                </a>
                                            </td>
                                            <td>{{ $gres->nama_penilai }}</td>
                                            <td><a href="javascript:void(0)" 
                                                    class="text-decoration-none lihatProfileDinilai"
                                                    data-penilai-id="{{$gres->relasi_dinilai->id ?? ''}}"
                                                    data-penilai-npp="{{$gres->relasi_dinilai->npp_karyawan ?? ''}}"
                                                    data-penilai-nama="{{$gres->relasi_dinilai->nama_karyawan ?? ''}}"
                                                    data-penilai-level="{{$gres->relasi_dinilai->level_jabatan ?? ''}}"
                                                    data-penilai-unit="{{$gres->relasi_dinilai->unit_jabatan ?? ''}}"
                                                    >
                                                    {{ $gres->npp_dinilai }}
                                                </a>
                                            </td>
                                            <td>{{ $gres->nama_dinilai }}</td>
                                            <td>{{ $gres->timestamp }}</td>
                                            <td class="px-2">
                                                <div class="btn-toolbar d-flex justify-content-center" role="toolbar" aria-label="group aksi">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <button 
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-sm lihatResponse"
                                                            data-id="{{ $gres->id }}"
                                                            >
                                                            <i class="fas fa-eye p-1"></i>Lihat
                                                        </button>
                                                    </div>
                                                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                                                        <form action="{{route('gform-destroy', $gres->id)}}" method="Post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-warning btn-sm"
                                                                onclick="return confirm('Yakin akan menghapus data ini?')">
                                                                <i class="fas fa-trash-alt p-1"></i>Hapus
                                                            </button>
                                                        </form>
                                                    </td>
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
<div class="modal fade" id="lihatProfileModal" tabindex="-1" aria-labelledby="lihatProfileModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title h4" id="lihatProfileModalLabel"></p>
      </div>
      <div class="modal-body" id="setProfile">
        <p class="text-center"><em>tunggu...</em></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="exitProfilePenilaiModal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endpush

@push('modals')
<!-- Modal -->
<div class="modal fade" id="lihatResponseModal" tabindex="-1" aria-labelledby="lihatResponseModal" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title h4" id="lihatResponseModalLabel"></p>
      </div>
      <div class="modal-body" id="setResponse">
        <p class="text-center"><em>tunggu...</em></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="exitProfilePenilaiModal" data-dismiss="modal">Close</button>
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
var request_response = null;
$('.lihatResponse').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');
    $('#lihatResponseModal').modal('show');
    $('#lihatResponseModal').on('shown.bs.modal', function(e){
        e.preventDefault();
        const uri = '/gform/getDetail/' + id;
        if(request_response && request_response.readyState != 4){
            request_response.abort();
        }
        request_response = $.ajax({
            url : uri,
            type : 'get',
            dataType: 'json',
            success : function (response){
                $('#lihatResponseModalLabel').text(`Penilai ${response.data.npp_penilai} - Dinilai ${response.data.npp_dinilai}`)
                let content = `<dl class='row'>
                    <dt class="col-sm-2 text-uppercase">Nilai-Nilai Perusahaan Dan Perilaku</dt>
                    <dd class="col-sm-10">
                        <dl class="row">
                            <dt class="col-sm-2">Kerjasama</dt>
                            <dd class="col-sm-10">${response.data.kerjasama}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Komunikasi</dt>
                            <dd class="col-sm-10">${response.data.komunikasi}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Kedisiplinan</dt>
                            <dd class="col-sm-10">${response.data.absensi}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Dedikasi & Integritas</dt>
                            <dd class="col-sm-10">${response.data.integritas}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Etika</dt>
                            <dd class="col-sm-10">${response.data.etika}</dd>
                        </dl>
                    </dd>
                    <dt class="col-sm-2 text-uppercase">Sasaran Kinerja Dan Proses Pencapaian</dt>
                    <dd class="col-sm-10">
                        <dl class="row">
                            <dt class="col-sm-2">Goal</dt>
                            <dd class="col-sm-10">${response.data.goal_kinerja}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Error</dt>
                            <dd class="col-sm-10">${response.data.error_kinerja}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Dokumentasi</dt>
                            <dd class="col-sm-10">${response.data.proses_dokumen}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Inisiatif</dt>
                            <dd class="col-sm-10">${response.data.proses_inisiatif}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Pola Pikir</dt>
                            <dd class="col-sm-10">${response.data.proses_polapikir}</dd>
                        </dl>
                    </dd>
                    <dt class="col-sm-2 text-uppercase">Leadership</dt>
                    <dd class="col-sm-10">
                        <dl class="row">
                            <dt class="col-sm-2">Strategi Perencanaan</dt>
                            <dd class="col-sm-10">${response.data.strategi_perencanaan}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Strategi Pengawasan</dt>
                            <dd class="col-sm-10">${response.data.strategi_pengawasan}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Strategi Inovasi</dt>
                            <dd class="col-sm-10">${response.data.strategi_inovasi}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Kepemimpinan</dt>
                            <dd class="col-sm-10">${response.data.kepemimpinan}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Membimbing dan Membangun</dt>
                            <dd class="col-sm-10">${response.data.membimbing_membangun}</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-2">Pengambilan Keputusan</dt>
                            <dd class="col-sm-10">${response.data.pengambilan_keputusan}</dd>
                        </dl>
                    </dd>
                    
                </dl>`;
                $('#setResponse').empty()
                $('#setResponse').html(content)
            },
            error: function(response){
                console.log(response);
            }
        });
        return false;
    });
});

$('.lihatProfileDinilai').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-penilai-id');
    let npp = $(this).attr('data-penilai-npp');
    let nama = $(this).attr('data-penilai-nama');
    let level = $(this).attr('data-penilai-level');
    let unit = $(this).attr('data-penilai-unit');
    let content = `<dl class="row">
                    <dt class="col-sm-3">NPP</dt>
                    <dd class="col-sm-9">${npp}</dd>

                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-9">${nama}</dd>

                    <dt class="col-sm-3">Level</dt>
                    <dd class="col-sm-9">${level}</dd>

                    <dt class="col-sm-3">Unit</dt>
                    <dd class="col-sm-9">${unit}</dd>
                </dl>`;
    $('#lihatProfileModal').modal('show');
    $('#lihatProfileModal').on('shown.bs.modal', function(e){
        e.preventDefault();
        $('#lihatProfileModalLabel').text(`${npp} - ${nama}`)
        $('#setProfile').html(content);
    });
});

$('#lihatResponseModal').on('hidden.bs.modal', function(e){
    // alert('modal closed')
    let content = `<p class="text-center"><em>tunggu...</em></p>`;
    $('#setResponse').html(content)
    $('#lihatResponseModalLabel').empty()
})

$('.lihatProfilePenilai').on('click', function(e){
    e.preventDefault();
    // console.log('ok opened');
    let id = $(this).attr('data-penilai-id');
    let npp = $(this).attr('data-penilai-npp');
    let nama = $(this).attr('data-penilai-nama');
    let level = $(this).attr('data-penilai-level');
    let unit = $(this).attr('data-penilai-unit');
    let content = `<dl class="row">
                    <dt class="col-sm-3">NPP</dt>
                    <dd class="col-sm-9">${npp}</dd>

                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-9">${nama}</dd>

                    <dt class="col-sm-3">Level</dt>
                    <dd class="col-sm-9">${level}</dd>

                    <dt class="col-sm-3">Unit</dt>
                    <dd class="col-sm-9">${unit}</dd>
                </dl>`;
    $('#lihatProfileModal').modal('show');
    $('#lihatProfileModal').on('shown.bs.modal', function(e){
        e.preventDefault();
        $('#lihatProfileModalLabel').text(`${npp} - ${nama}`)
        $('#setProfile').html(content)
    })
})

$('#lihatProfileModal').on('hidden.bs.modal', function(e){
    // alert('modal closed')
    let content = `<p class="text-center"><em>tunggu...</em></p>`;
    $('#setProfile').html(content)
    $('#lihatProfileModalLabel').empty()
})

var table = $('#dataTablesPull').DataTable({
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
        const uri = '/gform/pull';
        await $.ajax({
            url : uri,
            type : 'get',
            dataType: 'json',
            success : function(response){
                // return response;
                swalOk(response.info,response.data_sama,'data baru '+response.data_baru,'success');
                setTimeout(() => {
                    location.reload();
                }, 3100);
            },
            error: function(response){
                swalOk(response.info,response.data_sama,'data gagal '+response.data_gagal,'warning');
                // setTimeout(() => {
                    // location.reload();
                // }, 3100);
            }
        });
    }

    async function swalOk(title, text1, text2, icon)
    {
        Swal.fire({
            title: title,
            text: `data sama ${text1} `+text2,
            icon: icon
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
            }
        });
    }

    $('#btnPullResponse').on('click', function(ev){
        ev.preventDefault();
        // $(this).prop('disabled',true);
        alertswal(
            'anda yakin',
            'anda melakukan penarikan data pada sheet google form response',
            'info',
            'Iya'
        );
    });

});
</script>
@endpush