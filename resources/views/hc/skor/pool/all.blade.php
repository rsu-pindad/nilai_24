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
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-file-export px-1"></i>Export
                                        </button>
                                        <div class="dropdown-menu">
                                            <form action="{{ route('skor-export') }}" method="post"
                                                class="dropdown-item btn btn-outline-info" enctype="multipart/form-data" target="_blank">
                                                @csrf
                                                <button type="submit" class="btn btn-sm">format (.xlsx)
                                                </button>
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('skor-export-csv') }}" method="post"
                                                class="dropdown-item btn btn-outline-info" enctype="multipart/form-data" target="_blank">
                                                @csrf
                                                <button type="submit" class="btn btn-sm">format (.csv)
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="px-4">
                                    <table class="table table-striped table-hover table-bordered table-responsive"
                                        id="dataTablesPoolSkor">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th colspan="3">Penilai</th>
                                                <th colspan="5">Dinilai</th>
                                                <th colspan="16"></th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Npp</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Npp</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Relasi</th>
                                                <th>Jumlah</th>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_pool_skor as $pool)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pool->karyawan->npp_karyawan }}</td>
                                                    <td>{{ $pool->karyawan->nama_karyawan }}</td>
                                                    <td>{{ $pool->karyawan->level_jabatan}}</td>
                                                    <td>
                                                        {{ $pool->karyawan_dinilai->nama_karyawan ?? 'mohon tarik relasi karyawan' }}
                                                    </td>
                                                    <td>
                                                        {{ $pool->karyawan_dinilai->npp_karyawan ?? 'mohon tarik relasi karyawan' }}
                                                    </td>
                                                    <td>{{ $pool['jabatan_dinilai'] }}</td>
                                                    <td>
                                                        @if ($pool['relasi'] == 'self')
                                                            <p>
                                                                <span class="badge badge-warning">
                                                                    {{ $pool['relasi'] }}
                                                                </span>
                                                            </p>
                                                        @elseif($pool['relasi'] == 'atasan')
                                                            <p>
                                                                <span class="badge badge-primary">
                                                                    {{ $pool['relasi'] }}
                                                                </span>
                                                            </p>
                                                        @elseif($pool['relasi'] == 'rekanan')
                                                            <p>
                                                                <span class="badge badge-secondary">
                                                                    {{ $pool['relasi'] }}
                                                                </span>
                                                            </p>
                                                        @else
                                                            <p>
                                                                <span class="badge badge-success">
                                                                    {{ $pool['relasi'] }}
                                                                </span>
                                                            </p>
                                                        @endif
                                                    </td>
                                                    <td>{{ $pool['sum_nilai'] }}</td>
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
            // searching: true,
            // scrollX: false,
            scrollY: '60vh',
            searchable: false,
            columnDefs: [
                // { searchable: false, targets: '_all' },
                { searchable: true, targets: 2 },
                { searchable: false, targets: 1 },
            ],
            order: [
                [7, 'asc'],
                [8, 'desc'],
            ]
        });
    </script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(e) {

            async function swalAjax() {
                const clears = true;
                const uri = '/skor-pool-all?refresh=';
                $.ajax({
                    url: uri + clears,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response)
                        swalOk(response.title, response.text, response.icon);
                        setTimeout(() => {
                            location.reload();
                        }, 3100);
                    },
                    error: function(response) {
                        swalOk(response.title, response.text, response.icon);
                        setTimeout(() => {
                            location.reload();
                        }, 10000);
                    }
                });
            }

            async function swalOk(title, text, icon) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon
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
                        }, 3000);
                    } else {
                        $('#btnSkorPoolModal').prop("disabled", false);
                    }
                });
            }

            $('#btnSkorPoolModal').on('click', function(ev) {
                ev.preventDefault();
                $(this).prop("disabled", true);
                alertswal(
                    'anda yakin ?',
                    'anda akan melakukan kalkulasi skor',
                    'info',
                    'iya'
                );
            });

        });
    </script>
@endpush
