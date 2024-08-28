@extends('templates.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title ?? 'Relasi Karyawan' }}</h1>
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
                                <i class="fas fa-arrow-down px-2"></i>Tarik Relasi Karyawan
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
                                    @foreach ($karyawan_data as $karyawan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $karyawan->npp_karyawan }}</td>
                                        <td>{{ $karyawan->nama_karyawan }}</td>
                                        <td>{{ $karyawan->level_jabatan }}</td>
                                        <td>
                                            @forelse($karyawan->karyawan_atasan as $k_atasan)
                                            {{ $k_atasan->npp_atasan }}
                                            @empty
                                            -
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($karyawan->karyawan_selevel as $k_selevel)
                                            {{ $k_selevel->npp_selevel }}
                                            @empty
                                            -
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($karyawan->karyawan_staff as $k_staff)
                                            {{ $loop->iteration }}.{{ $k_staff->npp_staff }}<br>
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

@pushOnce('styles')
<link rel="stylesheet" href="{{asset('vendor/datatables/datatables.min.css')}}">
@endPushOnce

@pushOnce('scripts')
<script src="{{asset('vendor/datatables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var table = $('#tabelKaryawan').DataTable({
        responsive: true
        , ordering: false
        , scrollX: false
        , scrollY: '50vh'
        , searching: true
    , });

</script>

<script>
    $(document).ready(function(e) {

        async function swalAjax() {
            const uri = '/relasi-karyawan/pull-level';
            return await $.ajax({
                url: uri
                , type: 'get'
                , dataType: 'json'
                , success: function(response) {
                    swalOk(response.title, response.text, 'success');
                    setTimeout(() => {
                        location.reload()
                    }, 3100);
                }
                , error: function(response) {
                    swalOk(response.title, response.text, 'danger');
                    setTimeout(() => {
                        location.reload()
                    }, 10000)
                }
            });
        }

        async function swalOk(title, text, icon) {
            Swal.fire({
                title: title
                , text: text
                , icon: icon
            });
        }

        async function alertswal(title, text, icon, confirmButtonText) {
            Swal.fire({
                title: title
                , text: text
                , icon: icon
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: confirmButtonText
                , cancelButtonText: "batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    swalAjax();
                } else {
                    $('#btnPullRelasiKaryawan').prop("disabled", false);
                }
            }).catch((result) => {
                console.log(result);
            });
        }

        $('#btnPullRelasiKaryawan').on('click', function(ev) {
            ev.preventDefault();
            $(this).prop("disabled", true);
            alertswal(
                'anda yakin'
                , 'anda melakukan penarikan data pada sheet karyawan'
                , 'info'
                , 'Iya'
            );
        });
    });

</script>
@endPushOnce
