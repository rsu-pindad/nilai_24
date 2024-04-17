@extends('templates.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Tabel Rekap DP3' }}</h1>
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
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-file-export px-1"></i>Export
                                            </button>
                                            <div class="dropdown-menu">
                                                <span class="dropdown-item-text">Raw Bobot</span>
                                                <form action="{{ route('penilai-rekap-export-raw-xlsx') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.xlsx)
                                                    </button>
                                                </form>
                                                <form action="{{ route('penilai-rekap-export-raw-csv') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.csv)
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <span class="dropdown-item-text">Group Bobot</span>
                                                <form action="{{ route('penilai-rekap-export-xlsx') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.xlsx)
                                                    </button>
                                                </form>
                                                <form action="{{ route('penilai-rekap-export-csv') }}" method="post"
                                                    class="dropdown-item btn btn-outline-info"
                                                    enctype="multipart/form-data"
                                                    target="_blank">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">format (.csv)
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="p-2 bd-highlight">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">B-A (Bobot Aspek)</li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesRekap2">
                                    <thead>
                                        <tr>
                                            <th colspan='4'>Identitas Dinilai</th>
                                            <th colspan='3'>Aspek</th>
                                            <th rowspan='2'>Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Kepemimpinan</th>
                                            <th>Perilaku</th>
                                            <th>Sasaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_dinilai as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->identitas_dinilai->npp_karyawan }}</td>
                                                <td>{{ $p->identitas_dinilai->nama_karyawan }}</td>
                                                <td>{{ $p->identitas_dinilai->level_jabatan }}</td>
                                                <td>{{ round($p->sum_k1 * 100, 3) }}</td>
                                                <td>{{ round($p->sum_k2 * 100, 3) }}</td>
                                                <td>{{ round($p->sum_k3 * 100, 3) }}</td>
                                                <td>
                                                    <div class="btn-toolbar d-flex justify-content-center" role="toolbar"
                                                        aria-label="Toolbar with button groups">
                                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                                            <a href="/penilai-rekap/detail?dinilai={{ $p->npp_dinilai }}&relasi=self&penilai={{ $p->identitas_penilai->id }}"
                                                                target="_blank" class="btn btn-sm btn-info">
                                                                <i class="far fa-eye px-1"></i>Self
                                                            </a>
                                                        </div>
                                                        <div class="btn-group mr-2" role="group"
                                                            aria-label="Second group">
                                                            <a href="/penilai-rekap/detail?dinilai={{ $p->npp_dinilai }}&relasi=atasan&penilai={{ $p->identitas_penilai->id }}"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="far fa-eye px-1"></i>Atasan
                                                            </a>
                                                        </div>
                                                        <div class="btn-group mr-2" role="group" aria-label="Third group">
                                                            {{-- <a href="/penilai-rekap/detail?dinilai={{ $p->npp_dinilai }}&relasi=rekanan&penilai={{ $p->identitas_penilai->id }}"
                                                                target="_blank" class="btn btn-sm btn-success">
                                                                <i class="far fa-eye px-1"></i>Rekanan
                                                            </a> --}}
                                                            <button type="button"
                                                                class="btn btn-success btn-sm btnInfoRekanan"
                                                                data-toggle="modal" data-target="#rekananModal"
                                                                data-id-dinilai='{{ $p->identitas_dinilai->id }}'
                                                                data-npp-dinilai='{{ $p->identitas_dinilai->npp_karyawan }}'
                                                                data-rekap-id="{{ $p->id }}">
                                                                <i class="far fa-eye px-1"></i>Rekanan
                                                            </button>
                                                        </div>
                                                        <!-- <a href="/penilai-rekap/detail/staff?dinilai={{ $p->npp_dinilai }}" target="_blank" class="btn btn-sm btn-warning">
                                                            <i class="far fa-eye px-1"></i>
                                                        </a> -->
                                                        <div class="btn-group mr-2" role="group" aria-label="Third group">
                                                            <button type="button"
                                                                class="btn btn-warning btn-sm btnInfoStaff"
                                                                data-toggle="modal" data-target="#staffModal"
                                                                data-id-dinilai='{{ $p->identitas_dinilai->id }}'
                                                                data-npp-dinilai='{{ $p->identitas_dinilai->npp_karyawan }}'
                                                                data-rekap-id="{{ $p->id }}">
                                                                <i class="far fa-eye px-1"></i>Staff
                                                            </button>
                                                        </div>
                                                    </div>
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
                <div class="modal-body">
                    <div class="staffModalBody">
                        <p class="text-center"><em>tunggu...</em></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('modals')
    <!-- Modal -->
    <div class="modal fade" id="rekananModal" tabindex="-1" aria-labelledby="rekananModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rekananModalLabel">List Rekanan</h5>
                </div>
                <div class="modal-body">
                    <div class="rekananModalBody">
                        <p class="text-center"><em>tunggu...</em></p>
                    </div>
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
        var request_follow_up_staff = null;

        var request_rekanan = null;
        var request_follow_up_rekanan = null;
        $('.btnInfoStaff').on('click', function(e) {
            e.preventDefault();
            // alert('ok hooked');
            let id = $(this).attr('data-npp-dinilai')
            let rekapId = $(this).attr('data-rekap-id')
            let npp_penilai = $(this).attr('data-id-penilai')
            // console.log(id);
            const uri = `/penilai-rekap/detail/staff?dinilai=${id}`
            // const urlFollowUp = '/rekap/hasil-personal/follow-up?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.npp_karyawan;
            $('#staffModal').on('shown.bs.modal', function(e) {
                e.preventDefault();
                if (request_staff && request_staff.readyState != 2) {
                    request_staff.abort();
                }
                request_staff = $.ajax({
                    url: uri,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        const local_uri = `/penilai-rekap/detail/staff/detail?dinilai=`;
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }
                        var head = `<ul class="list-group listStaff">`;
                        $('.staffModalBody').empty();
                        $('.staffModalBody').prepend(head);
                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var ids = response['data'][i].id;
                                var identitasNamaStaff = response['data'][i].identitas_staff
                                    .nama_karyawan;
                                var identitasNppStaff = response['data'][i].identitas_staff
                                    .npp_karyawan;
                                var identitasIdStaff = response['data'][i].identitas_staff.id;
                                var parentStaff = response['data'][i].parent_staff.npp_karyawan;
                                // var nppStaff = response['data'][i].npp_staff;
                                var option = `
                            <li class="list-group-item listStaffWa" data-id-penilai="${identitasIdStaff}">
                                <a href="${local_uri+parentStaff+'&penilai='+identitasIdStaff+'&relasi=staff'}" 
                                    class="list-group-item list-group-item-action listFollowUpStaff" 
                                    target="_blank"
                                    data-parent-npp=${parentStaff}
                                    data-staff-id=${identitasIdStaff}>${identitasNppStaff} - ${identitasNamaStaff}
                                    <i class="fas fa-hand-point-left px-2"></i>
                                </a>
                            </li>`;
                                $('.listStaff').append(option);
                            }
                        } else {
                            let content =
                                `<p class="text-center"><em>tidak memiliki staff</em></p>`;
                            $('.staffModalBody').html(content);
                        }
                        var tail = `</ul>`;
                    }
                })
                $('.staffModalBody').on('change', function(e) {
                    e.preventDefault()
                    alert('changed')
                })
                // $('.staffModalBody').each(function(index, value){
                //     // console.log(this.href);
                //     console.log(value);
                // });
                // if(request_follow_up_staff && request_follow_up_staff.readyState != 2){
                //     request_follow_up_staff.abort();
                // }
                // request_follow_up_staff = $.ajax({
                //     url : uri,
                //     type : 'get',
                //     dataType: 'json',
                //     success : function (response){
                //         const status = '/rekap/hasil-personal/status?dinilai='+id+'&penilai='+;
                //         const local_uri = `/penilai-rekap/detail/staff/followup?dinilai=`;
                //         var len = 0;
                //         if(response['data'] != null){
                //             len = response['data'].length;
                //         }
                //         if(len > 0){
                //             for(var i=0; i<len;i++){
                //                 var id = response['data'][i].id;
                //                 var identitasNamaStaff = response['data'][i].identitas_staff.nama_karyawan;
                //                 var identitasNppStaff = response['data'][i].identitas_staff.npp_karyawan;
                //                 var identitaIdStaff = response['data'][i].identitas_staff.id;
                //                 var parentStaff = response['data'][i].parent_staff.npp_karyawan;
                //                 // var nppStaff = response['data'][i].npp_staff;
                //                 var option = `
            //                     <li class="list-group-item listStaffWa${id}">
            //                     <a href="${local_uri+parentStaff+'&penilai='+identitaIdStaff+'&relasi=staff'}" 
            //                     class="list-group-item list-group-item-action" 
            //                     target="_blank"
            //                     data-parent-npp=${parentStaff}
            //                     data-staff-id=${identitaIdStaff}>${identitasNppStaff} - ${identitasNamaStaff}
            //                     <i class="fas fa-hand-point-left px-2"></i>
            //                     </a>
            //                     </li>`;
                //                 $(`.listStaffWa${id}`).append(option);
                //             }
                //         }else{
                //             let content = `<p class="text-center">sudah follow up</em></p>`;
                //             // $(`.listStaffWa${id}`).html(content);
                //         }
                //     }
                // })
            })
        })

        $('.btnInfoRekanan').on('click', function(e) {
            e.preventDefault();
            // alert('ok hooked');
            let id = $(this).attr('data-npp-dinilai')
            let rekapId = $(this).attr('data-rekap-id')
            let npp_penilai = $(this).attr('data-id-penilai')
            // console.log(id);
            const uri = `/penilai-rekap/detail/rekanan?dinilai=${id}`
            // const urlFollowUp = '/rekap/hasil-personal/follow-up?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.npp_karyawan;
            $('#rekananModal').on('shown.bs.modal', function(e) {
                e.preventDefault();
                if (request_rekanan && request_rekanan.readyState != 2) {
                    request_rekanan.abort();
                }
                request_rekanan = $.ajax({
                    url: uri,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        const local_uri = `/penilai-rekap/detail/rekanan/detail?dinilai=`;
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }
                        console.log(response);
                        var head = `<ul class="list-group listRekanan">`;
                        $('.rekananModalBody').empty();
                        $('.rekananModalBody').prepend(head);
                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var ids = response['data'][i].id;
                                var identitasNamaRekanan = response['data'][i].parent_selevel
                                    .nama_karyawan;
                                var identitasNppRekanan = response['data'][i].parent_selevel
                                    .npp_karyawan;
                                var identitasIdRekanan = response['data'][i].parent_selevel.id;
                                var parentRekanan = response['data'][i].identitas_selevel.npp_karyawan;
                                // var nppStaff = response['data'][i].npp_staff;
                                var option = `
                            <li class="list-group-item listRekananWa" data-id-penilai="${identitasIdRekanan}">
                                <a href="${local_uri+parentRekanan+'&penilai='+identitasIdRekanan+'&relasi=rekanan'}" 
                                    class="list-group-item list-group-item-action listFollowUpRekanan" 
                                    target="_blank"
                                    data-parent-npp=${parentRekanan}
                                    data-selevel-id=${identitasIdRekanan}>${identitasNppRekanan} - ${identitasNamaRekanan}
                                    <i class="fas fa-hand-point-left px-2"></i>
                                </a>
                            </li>`;
                                $('.listRekanan').append(option);
                            }
                        } else {
                            let content =
                                `<p class="text-center"><em>tidak memiliki rekanan</em></p>`;
                            $('.rekananModalBody').html(content);
                        }
                        var tail = `</ul>`;
                    }
                })
                $('.rekananModalBody').on('change', function(e) {
                    e.preventDefault()
                    alert('changed')
                })
            })
        })

        $('#staffModal').on('hidden.bs.modal', function(e) {
            e.preventDefault();
            // alert('modal closed')
            let content = `<p class="text-center"><em>tunggu...</em></p>`;
            $('.staffModalBody').empty();
            $('.staffModalBody').html(content);
        })

        $('#rekananModal').on('hidden.bs.modal', function(e) {
            e.preventDefault();
            // alert('modal closed')
            let content = `<p class="text-center"><em>tunggu...</em></p>`;
            $('.rekananModalBody').empty();
            $('.rekananModalBody').html(content);
        })

        var table = $("#dataTablesRekap2").DataTable({
            ordering: false,
            scrollCollapse: true,
            searching: true,
            scrollX: false,
            scrollY: '50vh',
        });
    </script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(e) {
            async function swalAjax() {
                const uri = '/penilai-rekap/calculate-new?relasi=all';
                $.ajax({
                    url: uri,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        let msg = response.text;
                        var messages = msg.success;
                        swalOk(response.title, messages+' data berhasil dihitung', response.icon);
                        setTimeout(() => {
                            location.reload()
                        }, 10000);
                    },
                    error: function(response) {
                        // console.log(response);
                        let msg = response.text;
                        var messages = msg.error;
                        swalOk(response.title, messages+' data gagal dihitung', response.icon);
                        setTimeout(() => {
                            location.reload()
                        }, 10000);
                    }
                });
            }

            async function swalOk(title, text, icon) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                });
            }

            async function alertswal(title, text, icon, confirmButtonText) {
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
                    } else {
                        $('#btnRekapPenilaiModal').prop("disabled", false);
                    }
                });
            }

            $('#btnRekapPenilaiModal').on('click', function(ev) {
                ev.preventDefault();
                $(this).prop("disabled", true);
                alertswal(
                    'anda yakin',
                    'anda melakukan rekap semua nilai dp3',
                    'warning',
                    'Iya'
                );
            });
        });
    </script>
@endpush
